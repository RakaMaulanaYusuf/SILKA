<?php

namespace App\Http\Controllers;

use App\Models\KodeAkun;
use App\Models\KodeBantu;
use App\Models\JurnalUmum;
use App\Models\Company;
use App\Models\CompanyPeriod;
use App\Models\AktivaLancar;
use App\Models\AktivaTetap;
use App\Models\Kewajiban;
use App\Models\Ekuitas;
use App\Models\Pendapatan;
use App\Models\HPP;
use App\Models\BiayaOperasional;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfController extends Controller
{
    /**
     * PDF Kode Akun - FIXED
     */
    public function downloadKodeAkunPDF()
    {
        try {
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;
            
            if (!$company_id || !$period_id) {
                return back()->with('error', 'Silakan pilih perusahaan dan periode terlebih dahulu.');
            }

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);

            $accounts = KodeAkun::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->orderBy('kode_akun')
                ->get()
                ->map(fn($account) => [
                    'kode_akun' => $account->kode_akun,
                    'nama_akun' => $account->nama_akun, // FIXED: nama_akun bukan nama
                    'pos_saldo' => $account->pos_saldo ?? 'DEBIT',
                    'pos_laporan' => $account->pos_laporan ?? 'NERACA',
                    'debit' => $account->debit ?? 0,
                    'credit' => $account->credit ?? 0,
                ]);

            // Hitung total berdasarkan pos_saldo
            $totalDebit = $accounts->where('pos_saldo', 'DEBIT')->sum('debit');
            $totalCredit = $accounts->where('pos_saldo', 'CREDIT')->sum('credit');

            $data = [
                'title' => 'DAFTAR KODE AKUN',
                'companyName' => $company?->nama ?? 'Nama Perusahaan Tidak Ditemukan',
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'),
                'accounts' => $accounts,
                'totalDebit' => $totalDebit,
                'totalCredit' => $totalCredit,
            ];

            $pdf = PDF::loadView('pdf.kode-akun', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('Daftar_Kode_Akun_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Error generating Kode Akun PDF: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Gagal generate PDF Kode Akun: ' . $e->getMessage());
        }
    }

    /**
     * PDF Kode Bantu - FIXED
     */
    public function downloadKodeBantuPDF()
    {
        try {
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;
            
            if (!$company_id || !$period_id) {
                return back()->with('error', 'Silakan pilih perusahaan dan periode terlebih dahulu.');
            }

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);

            $kodeBantu = KodeBantu::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->orderBy('kodebantu_id')
                ->get()
                ->map(fn($k) => [
                    'kodebantu_id' => $k->kodebantu_id,
                    'kode_bantu' => $k->kode_bantu, // FIXED: tambahkan ini jika ada
                    'nama_bantu' => $k->nama_bantu ?? $k->nama, // FIXED: sesuaikan dengan field di tabel
                    'status' => $k->status ?? '-',
                    'saldo_awal' => $k->saldo_awal ?? 0,
                    'balance' => $k->balance ?? 0,
                ]);

            $totalBalance = $kodeBantu->sum('balance');

            $data = [
                'title' => 'DAFTAR KODE BANTU',
                'companyName' => $company?->nama ?? 'Nama Perusahaan Tidak Ditemukan',
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'),
                'kodeBantu' => $kodeBantu,
                'totalBalance' => $totalBalance,
                'totalRecords' => $kodeBantu->count(),
            ];

            $pdf = PDF::loadView('pdf.kode-bantu', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('Daftar_Kode_Bantu_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Error generating Kode Bantu PDF: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Gagal generate PDF Kode Bantu: ' . $e->getMessage());
        }
    }

    /**
     * 3. PDF Jurnal Umum
     */
    public function downloadJurnalUmumPDF(Request $request)
    {
        try {
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);

            // Arrow function version
            $journals = JurnalUmum::with(['account', 'helper'])
                ->where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->orderBy('tanggal')
                ->orderBy('bukti_transaksi')
                ->get()
                ->map(fn($journal) => [
                    'tanggal' => Carbon::parse($journal->tanggal)->format('Y-m-d'),
                    'bukti_transaksi' => $journal->bukti_transaksi,
                    'deskripsi' => $journal->keterangan,
                    'kode_akun' => $journal->kode_akun,
                    'kode_bantu' => $journal->kode_bantu ?? '-',
                    'debit' => $journal->debit ?? 0,
                    'credit' => $journal->credit ?? 0,
                ]);

            $totalDebit = $journals->sum('debit');
            $totalCredit = $journals->sum('credit');

            $data = [
                'title' => 'LAPORAN JURNAL UMUM',
                'companyName' => $company?->nama ?? 'Nama Perusahaan Tidak Ditemukan',
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'),
                'journals' => $journals,
                'totalDebit' => $totalDebit,
                'totalCredit' => $totalCredit,
                'isBalanced' => abs($totalDebit - $totalCredit) < 0.01,
            ];

            $pdf = PDF::loadView('pdf.jurnal-umum', $data);
            $pdf->setPaper('A4', 'landscape');

            return $pdf->download('Jurnal_Umum_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Error generating Jurnal Umum PDF: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Gagal generate PDF Jurnal Umum: ' . $e->getMessage());
        }
    }

    /**
     * 4. PDF Buku Besar
     */
    public function downloadBukuBesarPDF(Request $request)
    {
        try {
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            if (!$company_id || !$period_id) {
                return back()->with('error', 'Silakan pilih perusahaan dan periode terlebih dahulu.');
            }

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);

            // PERBAIKAN: Mengganti account_id
            $selected_account_id = $request->query('kode_akun');

            $query = KodeAkun::where('company_id', $company_id)
                // PERBAIKAN: Mengganti company_period_id
                ->where('period_id', $period_id)
                // PERBAIKAN: Mengganti account_id
                ->orderBy('kode_akun');

            // Jika ada selected_account_id, filter hanya akun tersebut
            if ($selected_account_id) {
                // PERBAIKAN: Mengganti account_id
                $query->where('kode_akun', $selected_account_id);
            }

            $accounts = $query->get();

            $bukuBesarData = [];
            $bukuBesarController = new \App\Http\Controllers\BukuBesarController();

            foreach ($accounts as $account) {
                // PERBAIKAN: Mengganti account_id
                $transactions = $bukuBesarController->getAccountTransactions($company_id, $period_id, $account->kode_akun);

                // Hanya tambahkan akun jika ada transaksi atau saldo awal yang signifikan
                // Ini opsional, bisa dihilangkan jika ingin menampilkan semua akun meskipun kosong transaksinya
                if ($transactions->isNotEmpty() || ($account->debit > 0 || $account->credit > 0)) {
                    $bukuBesarData[] = [
                        // PERBAIKAN: Mengganti account_id, account_name, balance_type
                        'account_id' => $account->kode_akun,
                        'account_name' => $account->nama_akun,
                        'balance_type' => $account->pos_saldo,
                        'initial_debit' => $account->debit,
                        'initial_credit' => $account->credit,
                        'transactions' => $transactions
                    ];
                }
            }

            // Jika tidak ada data buku besar setelah filter (misal account_id tidak valid atau tidak ada transaksi)
            if (empty($bukuBesarData) && $selected_account_id) {
                return back()->with('error', 'Tidak ada data transaksi untuk akun yang dipilih.');
            } elseif (empty($bukuBesarData) && !$selected_account_id) {
                return back()->with('error', 'Tidak ada data buku besar untuk periode ini.');
            }


            $data = [
                'title' => 'LAPORAN BUKU BESAR',
                // PERBAIKAN: Mengganti $company->name ke $company->nama
                'companyName' => $company ? $company->nama : 'Nama Perusahaan Tidak Ditemukan',
                // PERBAIKAN: Mengganti $companyPeriod->name
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'), // Tanggal cetak laporan
                'bukuBesarData' => $bukuBesarData
            ];

            $pdf = PDF::loadView('pdf.buku-besar', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('Buku_Besar_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Gagal generate PDF Buku Besar: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate PDF Buku Besar: ' . $e->getMessage());
        }
    }

    /**
     * 5. PDF Buku Besar Pembantu
     */
    public function downloadBukuBesarPembantuPDF(Request $request)
    {
        try {
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            if (!$company_id || !$period_id) {
                return back()->with('error', 'Silakan pilih perusahaan dan periode terlebih dahulu.');
            }

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);

            // PERBAIKAN: Mengganti helper_id
            $selected_helper_id = $request->query('kode_bantu');

            // Get all helper accounts that have transactions in the general journal
            $query = KodeBantu::where('company_id', $company_id)
                // PERBAIKAN: Mengganti company_period_id
                ->where('period_id', $period_id)
                // PERBAIKAN: Mengganti helper_id
                ->orderBy('kodebantu_id');

            // Jika ada selected_account_id, filter hanya akun tersebut
            if ($selected_helper_id) {
                // PERBAIKAN: Mengganti helper_id
                $query->where('kode_bantu', $selected_helper_id);
            }

            $helperAccounts = $query->get();

            $bukuBesarPembantuData = [];
            // Gunakan fully qualified namespace di sini:
            $bukuBesarPembantuController = new \App\Http\Controllers\BukuBesarPembantuController();

            foreach ($helperAccounts as $helper) {
                // PERBAIKAN: Mengganti helper_id
                $transactions = $bukuBesarPembantuController->getHelperTransactions($company_id, $period_id, $helper->kode_bantu);
                
                // Tambahkan data ke $bukuBesarPembantuData hanya jika ada transaksi atau saldo awal
                if ($transactions->isNotEmpty() || ($helper->balance > 0)) {
                    $bukuBesarPembantuData[] = [
                        // PERBAIKAN: Mengganti helper_id, helper_name
                        'helper_id' => $helper->kode_bantu,
                        'helper_name' => $helper->nama_bantu,
                        'status' => $helper->status, // 'PIUTANG' or 'HUTANG'
                        'initial_balance' => $helper->balance,
                        'transactions' => $transactions
                    ];
                }
            }

            // Tambahkan penanganan jika tidak ada data sama sekali setelah filter
            if (empty($bukuBesarPembantuData) && $selected_helper_id) {
                return back()->with('error', 'Tidak ada data Buku Besar Pembantu untuk kode bantu yang dipilih.');
            } elseif (empty($bukuBesarPembantuData) && !$selected_helper_id){
                return back()->with('error', 'Tidak ada data buku besar pembantu untuk periode ini.');
            }

            $data = [
                'title' => 'LAPORAN BUKU BESAR PEMBANTU',
                // PERBAIKAN: Mengganti $company->name ke $company->nama
                'companyName' => $company ? $company->nama : 'Nama Perusahaan Tidak Ditemukan',
                // PERBAIKAN: Mengganti $companyPeriod->name
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'),
                'bukuBesarPembantuData' => $bukuBesarPembantuData
            ];

            $pdf = PDF::loadView('pdf.buku-besar-pembantu', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('Buku_Besar_Pembantu_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Gagal generate PDF Buku Besar Pembantu: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate PDF Buku Besar Pembantu: ' . $e->getMessage());
        }
    }

    /**
     * 6. PDF Laba Rugi
     */
    public function downloadLabaRugiPDF(Request $request)
    {
        try {
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            if (!$company_id || !$period_id) {
                return back()->with('error', 'Silakan pilih perusahaan dan periode terlebih dahulu.');
            }

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);
            
            $labaRugiController = new \App\Http\Controllers\LabaRugiController(); 

            // PERBAIKAN: Hitung balance dengan benar
            $pendapatan = Pendapatan::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($labaRugiController) {
                    $balance = $labaRugiController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });
            
            $hpp = HPP::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($labaRugiController) {
                    $balance = $labaRugiController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });

            $biaya = BiayaOperasional::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($labaRugiController) {
                    $balance = $labaRugiController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });

            $totalPendapatan = $pendapatan->sum('jumlah');
            $totalHPP = $hpp->sum('jumlah');
            $totalBiayaOperasional = $biaya->sum('jumlah');

            // $labaKotor = $totalPendapatan - $totalHPP;
            $labaBersih = $totalPendapatan - ($totalBiayaOperasional + $totalHPP);

            $data = [
                'title' => 'LAPORAN LABA RUGI',
                'companyName' => $company ? $company->nama : 'Nama Perusahaan Tidak Ditemukan',
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'),
                'pendapatan' => $pendapatan,
                'hpp' => $hpp,
                'biaya' => $biaya, // PERBAIKAN: Ganti biayaoperasional jadi biaya
                'totalPendapatan' => $totalPendapatan,
                'totalHPP' => $totalHPP,
                'totalBiayaOperasional' => $totalBiayaOperasional,
                // 'labaKotor' => $labaKotor,
                'labaBersih' => $labaBersih,
            ];

            $pdf = PDF::loadView('pdf.laba-rugi', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('Laporan_Laba_Rugi_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Gagal generate PDF Laba Rugi: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate PDF Laba Rugi: ' . $e->getMessage());
        }
    }

    /**
     * 7. PDF Neraca
     */
    public function downloadNeracaPDF(Request $request)
    {
        try {
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            if (!$company_id || !$period_id) {
                return back()->with('error', 'Silakan pilih perusahaan dan periode terlebih dahulu.');
            }

            $company = Company::find($company_id);
            $companyPeriod = CompanyPeriod::find($period_id);
            
            $neracaController = new \App\Http\Controllers\NeracaController(); 
            $labaRugiController = new \App\Http\Controllers\LabaRugiController(); 

            $aktivaLancar = AktivaLancar::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($neracaController) {
                    $balance = $neracaController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });

            $aktivaTetap = AktivaTetap::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($neracaController) {
                    $balance = $neracaController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });
            
            $kewajiban = Kewajiban::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($neracaController) {
                    $balance = $neracaController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });

            $ekuitas = Ekuitas::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) use ($neracaController) {
                    $balance = $neracaController->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->account->nama_akun ?? 'N/A',
                        'jumlah' => $balance,
                    ];
                });

            $totalAktivaLancar = $aktivaLancar->sum('jumlah');
            $totalAktivaTetap = $aktivaTetap->sum('jumlah');
            $totalAktiva = $totalAktivaLancar + $totalAktivaTetap;

            $totalKewajiban = $kewajiban->sum('jumlah');
            $totalEkuitas = $ekuitas->sum('jumlah');
            $totalKewajibanDanEkuitas = $totalKewajiban + $totalEkuitas;
            
            // Calculate laba bersih
            $pendapatan_lr = Pendapatan::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->get()
                ->sum(function($item) use ($labaRugiController) {
                    return $labaRugiController->getBukuBesarBalance($item->kode_akun);
                });
            
            $hpp_lr = HPP::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->get()
                ->sum(function($item) use ($labaRugiController) {
                    return $labaRugiController->getBukuBesarBalance($item->kode_akun);
                });
            
            $biaya_lr = BiayaOperasional::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->get()
                ->sum(function($item) use ($labaRugiController) {
                    return $labaRugiController->getBukuBesarBalance($item->kode_akun);
                });
            
            $labaBersihTahunBerjalan = $pendapatan_lr - $hpp_lr - $biaya_lr;

            $data = [
                'title' => 'LAPORAN NERACA',
                'companyName' => $company ? $company->nama : 'Nama Perusahaan Tidak Ditemukan',
                'periodName' => $companyPeriod ? $companyPeriod->period_month . ' ' . $companyPeriod->period_year : 'Periode Tidak Ditemukan',
                'date' => now()->format('d F Y'),
                'aktivaLancar' => $aktivaLancar,
                'aktivaTetap' => $aktivaTetap,
                'totalAktivaLancar' => $totalAktivaLancar,
                'totalAktivaTetap' => $totalAktivaTetap,
                'totalAktiva' => $totalAktiva,
                'kewajiban' => $kewajiban,
                'ekuitas' => $ekuitas,
                'totalKewajiban' => $totalKewajiban,
                'totalEkuitas' => $totalEkuitas,
                'totalKewajibanDanEkuitas' => $totalKewajibanDanEkuitas,
                'labaBersihTahunBerjalan' => $labaBersihTahunBerjalan
            ];

            $pdf = PDF::loadView('pdf.neraca', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('Laporan_Neraca_' . date('YmdHis') . '.pdf');

        } catch (\Exception $e) {
            \Log::error('Gagal generate PDF Neraca: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate PDF Neraca: ' . $e->getMessage());
        }
    }
}