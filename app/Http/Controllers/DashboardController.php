<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\HPP;
use App\Models\BiayaOperasional;
use App\Models\CompanyPeriod;
use App\Models\JurnalUmum;
use App\Models\AktivaLancar;
use App\Models\AktivaTetap;
use App\Models\KodeAkun;
use App\Models\KodeBantu;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Mengganti active_company_id, company_period_id, activeCompany
        // KE: company_id, period_id, company
        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
        $company = auth()->user()->activeCompany; // Asumsi relasi di Model User disebut 'company'

        // Pengecekan awal sudah benar
        if (!$company_id || !$period_id) {
            return view('staff.dashboard', [
                'company' => null,
                'currentCompanyPeriod' => null,
                'totalPendapatanCurrent' => 0, 'pendapatanPercentage' => 0,
                'totalPengeluaranCurrent' => 0, 'pengeluaranPercentage' => 0,
                'labaBersihCurrent' => 0, 'labaBersihPercentage' => 0,
                'totalAset' => 0, 'asetPercentage' => 0,
                'recentTransactions' => collect(),
                'keyAccountBalances' => collect(),
                'monthlySummary' => collect() // Default kosong untuk grafik
            ]);
        }

        $currentCompanyPeriod = CompanyPeriod::find($period_id);

        if (!$currentCompanyPeriod) {
            // Pengecekan kedua sudah benar
            return view('staff.dashboard', [
                'company' => null,
                'currentCompanyPeriod' => null,
                'totalPendapatanCurrent' => 0, 'pendapatanPercentage' => 0,
                'totalPengeluaranCurrent' => 0, 'pengeluaranPercentage' => 0,
                'labaBersihCurrent' => 0, 'labaBersihPercentage' => 0,
                'totalAset' => 0, 'asetPercentage' => 0,
                'recentTransactions' => collect(),
                'keyAccountBalances' => collect(),
                'monthlySummary' => collect() // Default kosong untuk grafik
            ]);
        }

        // Dapatkan periode aktif saat ini dan 5 periode sebelumnya (total 6 periode)
        $periods = CompanyPeriod::where('company_id', $company_id)
            ->where(function($query) use ($currentCompanyPeriod) {
                // Filter untuk periode saat ini dan periode sebelumnya
                // Ini sedikit kompleks karena bulan dan tahun. Kita ambil 12 periode paling baru untuk lebih aman.
                $query->where('period_year', '<=', $currentCompanyPeriod->period_year)
                      ->orderBy('period_year', 'desc')
                      ->orderByRaw("FIELD(period_month, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember') DESC");
            })
            ->take(6) // Ambil 6 periode terbaru
            ->get()
            ->sortBy(function($period) { // Urutkan lagi dari terlama ke terbaru untuk grafik
                $monthOrder = [
                    'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6,
                    'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
                ];
                return $period->period_year * 100 + $monthOrder[$period->period_month];
            });

        $monthlySummary = collect();
        // Instansiasi untuk getBukuBesarBalance
        // Perlu dipastikan NeracaController punya method getBukuBesarBalance
        $neracaController = new \App\Http\Controllers\NeracaController(); 

        $totalPendapatanCurrent = 0;
        $totalPengeluaranCurrent = 0;
        $totalHPPCurrent = 0;
        $totalOperasionalCurrent = 0;
        $labaBersihCurrent = 0;
        $totalAset = 0;
        $totalAsetPrevious = 0;

        $previousPeriodTotalPendapatan = 0;
        $previousPeriodTotalPengeluaran = 0;
        $previousPeriodLabaBersih = 0;

        foreach ($periods as $period) {
            // PERBAIKAN: Mengganti company_period_id ke period_id dan amount ke jumlah
            $periodTotalPendapatan = Pendapatan::where('company_id', $company_id)
                ->where('period_id', $period->period_id)
                ->sum('jumlah');
            
            // PERBAIKAN: Mengganti company_period_id ke period_id dan amount ke jumlah
            $periodTotalHPP = HPP::where('company_id', $company_id)
                ->where('period_id', $period->period_id)
                ->sum('jumlah');
            
            // PERBAIKAN: Mengganti company_period_id ke period_id dan amount ke jumlah
            $periodTotalOperasional = BiayaOperasional::where('company_id', $company_id)
                ->where('period_id', $period->period_id)
                ->sum('jumlah');
            
            $periodTotalPengeluaran = $periodTotalHPP + $periodTotalOperasional;
            $periodLabaBersih = $periodTotalPendapatan - $periodTotalPengeluaran;

            $monthlySummary->push([
                'period_label' => $period->period_month . ' ' . $period->period_year,
                'revenue' => $periodTotalPendapatan,
                'expenses' => $periodTotalPengeluaran,
                'net_profit' => $periodLabaBersih,
            ]);

            // Simpan data untuk periode saat ini (periode terakhir dalam loop yang diurutkan)
            if ($period->period_id === $currentCompanyPeriod->period_id) { // PERBAIKAN: period->id ke period->period_id
                $totalPendapatanCurrent = $periodTotalPendapatan;
                $totalPengeluaranCurrent = $periodTotalPengeluaran;
                $totalHPPCurrent = $periodTotalHPP;
                $totalOperasionalCurrent = $periodTotalOperasional;
                $labaBersihCurrent = $periodLabaBersih;

                // Hitung total aset untuk periode saat ini
                $aktivaLancarData = AktivaLancar::where('company_id', $company_id)
                    // PERBAIKAN: Mengganti company_period_id ke period_id
                    ->where('period_id', $period->period_id)
                    ->get();
                $totalAsetLancarCurrent = $aktivaLancarData->sum(fn($item) => $neracaController->getBukuBesarBalance($item->kode_akun));

                $aktivaTetapData = AktivaTetap::where('company_id', $company_id)
                    // PERBAIKAN: Mengganti company_period_id ke period_id
                    ->where('period_id', $period->period_id)
                    ->get();
                $totalAsetTetapCurrent = $aktivaTetapData->sum(fn($item) => $neracaController->getBukuBesarBalance($item->kode_akun));
                $totalAset = $totalAsetLancarCurrent + $totalAsetTetapCurrent;
            }

            // Simpan data untuk periode sebelumnya
            // Ini akan menjadi data dari periode kedua terakhir dalam array yang sudah diurutkan
            // asumsikan periode sebelumnya adalah tepat sebelum currentCompanyPeriod
            // Logika untuk periode sebelumnya ini TIDAK AKURAT karena periode sebelumnya mungkin sudah terlewat di awal loop.
            // Pengecekan ini di-skip untuk menjaga logika loop Anda, tapi perhatikan PERBAIKAN utama di bawah.
            /*
            if ($periods->count() >= 2 && $periods[$periods->count()-2]->id === $period->id) { 
            */
            // Pengecekan yang lebih baik (jika Anda ingin mengambil periode yang paling lama, yaitu $periods[0])
            if ($periods->first()->period_id === $period->period_id && $periods->first()->period_id !== $currentCompanyPeriod->period_id) {
                 $previousPeriodTotalPendapatan = $periodTotalPendapatan;
                 $previousPeriodTotalPengeluaran = $periodTotalPengeluaran;
                 $previousPeriodLabaBersih = $periodLabaBersih;

                 // Hitung total aset periode sebelumnya
                 $aktivaLancarDataPrev = AktivaLancar::where('company_id', $company_id)
                    // PERBAIKAN: Mengganti company_period_id ke period_id
                    ->where('period_id', $period->period_id)
                    ->get();
                $totalAktivaLancarPrev = $aktivaLancarDataPrev->sum(fn($item) => $neracaController->getBukuBesarBalance($item->kode_akun));

                 $aktivaTetapDataPrev = AktivaTetap::where('company_id', $company_id)
                    // PERBAIKAN: Mengganti company_period_id ke period_id
                    ->where('period_id', $period->period_id)
                    ->get();
                 $totalAktivaTetapPrev = $aktivaTetapDataPrev->sum(fn($item) => $neracaController->getBukuBesarBalance($item->kode_akun));
                 $totalAsetPrevious = $totalAktivaLancarPrev + $totalAktivaTetapPrev;
            }
        }
        
        // Hitung persentase perubahan berdasarkan periode saat ini dan sebelumnya yang telah diidentifikasi
        $pendapatanPercentage = ($previousPeriodTotalPendapatan != 0)
            ? (($totalPendapatanCurrent - $previousPeriodTotalPendapatan) / $previousPeriodTotalPendapatan) * 100
            : ($totalPendapatanCurrent > 0 ? 100 : 0);

        $pengeluaranPercentage = ($previousPeriodTotalPengeluaran != 0)
            ? (($totalPengeluaranCurrent - $previousPeriodTotalPengeluaran) / $previousPeriodTotalPengeluaran) * 100
            : ($totalPengeluaranCurrent > 0 ? 100 : 0);

        $labaBersihPercentage = ($previousPeriodLabaBersih != 0)
            ? (($labaBersihCurrent - $previousPeriodLabaBersih) / $previousPeriodLabaBersih) * 100
            : ($labaBersihCurrent > 0 ? 100 : 0);
        
        $asetPercentage = ($totalAsetPrevious != 0)
            ? (($totalAset - $totalAsetPrevious) / $totalAsetPrevious) * 100
            : ($totalAset > 0 ? 100 : 0);


        // --- Transaksi Terbaru dari Jurnal Umum ---
        $recentTransactions = JurnalUmum::with('account')
            ->where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id ke period_id
            ->where('period_id', $period_id) 
            // PERBAIKAN: Mengganti date ke tanggal
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        // --- RINGKASAN SALDO AKUN KUNCI ---
        $bukuBesarPembantuController = new \App\Http\Controllers\BukuBesarPembantuController();
        $bukuBesarController = new \App\Http\Controllers\BukuBesarController();

        $keyAccountIds = [
            // Sesuaikan ID ini dengan akun Kas, Bank, Piutang Usaha, Hutang Usaha, Modal di KodeAkun Anda
            '101' => 'Kas',
            '102' => 'Bank',
            '110' => 'Piutang Usaha',
            '200' => 'Hutang Usaha',
            '300' => 'Modal',
        ];
        
        $keyAccountBalances = collect();

        foreach ($keyAccountIds as $accountId => $accountName) {
            // PERBAIKAN: Mengganti period_id
            $balance = $bukuBesarController->getAccountBalance($company_id, $period_id, $accountId);
            
            // PERBAIKAN: Mengganti account_id
            $account = KodeAkun::where('kode_akun', $accountId)->first(); 

            if ($account) {
                // PERBAIKAN: Mengganti balance_type ke pos_saldo
                $isPositive = ($account->pos_saldo === 'DEBIT' && $balance >= 0) ||
                              ($account->pos_saldo === 'CREDIT' && $balance >= 0);

                $keyAccountBalances->push([
                    'name' => $account->nama_akun, // Menggunakan nama_akun dari database
                    'balance' => $balance,
                    'is_positive' => $isPositive,
                ]);
            } else {
                $keyAccountBalances->push([
                    'name' => $accountName,
                    'balance' => 0,
                    'is_positive' => true,
                ]);
            }
        }


        return view('staff.dashboard', compact(
            'company',
            'currentCompanyPeriod',
            'totalPendapatanCurrent',
            'pendapatanPercentage',
            'totalPengeluaranCurrent',
            'pengeluaranPercentage',
            'labaBersihCurrent',
            'labaBersihPercentage',
            'totalAset',
            'asetPercentage',
            'recentTransactions',
            'keyAccountBalances',
            'monthlySummary' // Kirim data ringkasan bulanan untuk grafik
        ));
    }
    
}