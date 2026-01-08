<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CompanyPeriod;
use App\Models\Company;
use App\Models\KodeAkun;
use App\Models\KodeBantu;
use App\Models\JurnalUmum;

class FinancialReportSeeder extends Seeder
{
    private $companyId = 'CMP00001';
    private $periodNovember = 'PRD251100001';
    private $periodDesember = 'PRD251200001';

    public function run(): void
    {
        // Seed Kode Akun untuk November
        $this->seedKodeAkun($this->periodNovember);
        
        // Seed Kode Akun untuk Desember
        $this->seedKodeAkun($this->periodDesember);
        
        // Seed Kode Bantu untuk November
        $this->seedKodeBantu($this->periodNovember);
        
        // Seed Kode Bantu untuk Desember
        $this->seedKodeBantu($this->periodDesember);
        
        // Seed Jurnal Umum November
        $this->seedJurnalUmumNovember();
        
        // Seed Jurnal Umum Desember
        $this->seedJurnalUmumDesember();
    }

    private function generateId($prefix)
    {
        return $prefix . date('ymd') . Str::random(8);
    }

    private function seedKodeAkun($periodId)
    {
        $kodeAkun = [
            // ASET LANCAR
            [
                'kode_akun' => '1-1100',
                'nama_akun' => 'Kas',
                'tabel_bantuan' => '1-1100',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 125000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-1110',
                'nama_akun' => 'Bank BCA',
                'tabel_bantuan' => '1-1110',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 450000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-1120',
                'nama_akun' => 'Bank Mandiri',
                'tabel_bantuan' => '1-1120',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 280000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-1200',
                'nama_akun' => 'Piutang Usaha',
                'tabel_bantuan' => '1-1200',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 95000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-1210',
                'nama_akun' => 'Piutang Karyawan',
                'tabel_bantuan' => '1-1210',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-1300',
                'nama_akun' => 'Persediaan Barang Dagangan',
                'tabel_bantuan' => '1-1300',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 185000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-1400',
                'nama_akun' => 'Biaya Dibayar Dimuka',
                'tabel_bantuan' => '1-1400',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 0.00,
                'credit' => null,
            ],
            
            // ASET TETAP
            [
                'kode_akun' => '1-2100',
                'nama_akun' => 'Tanah',
                'tabel_bantuan' => '1-2100',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 800000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-2200',
                'nama_akun' => 'Gedung',
                'tabel_bantuan' => '1-2200',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 1200000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-2210',
                'nama_akun' => 'Akumulasi Penyusutan Gedung',
                'tabel_bantuan' => '1-2210',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 250000000.00,
            ],
            [
                'kode_akun' => '1-2300',
                'nama_akun' => 'Kendaraan',
                'tabel_bantuan' => '1-2300',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 450000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-2310',
                'nama_akun' => 'Akumulasi Penyusutan Kendaraan',
                'tabel_bantuan' => '1-2310',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 180000000.00,
            ],
            [
                'kode_akun' => '1-2400',
                'nama_akun' => 'Peralatan Kantor',
                'tabel_bantuan' => '1-2400',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'NERACA',
                'debit' => 120000000.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '1-2410',
                'nama_akun' => 'Akumulasi Penyusutan Peralatan',
                'tabel_bantuan' => '1-2410',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 48000000.00,
            ],
            
            // KEWAJIBAN LANCAR
            [
                'kode_akun' => '2-1100',
                'nama_akun' => 'Hutang Usaha',
                'tabel_bantuan' => '2-1100',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 125000000.00,
            ],
            [
                'kode_akun' => '2-1200',
                'nama_akun' => 'Hutang Gaji',
                'tabel_bantuan' => '2-1200',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 0.00,
            ],
            [
                'kode_akun' => '2-1300',
                'nama_akun' => 'Hutang Pajak',
                'tabel_bantuan' => '2-1300',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 0.00,
            ],
            
            // KEWAJIBAN JANGKA PANJANG
            [
                'kode_akun' => '2-2100',
                'nama_akun' => 'Hutang Bank Jangka Panjang',
                'tabel_bantuan' => '2-2100',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 600000000.00,
            ],
            
            // EKUITAS
            [
                'kode_akun' => '3-1000',
                'nama_akun' => 'Modal Saham',
                'tabel_bantuan' => '3-1000',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 1500000000.00,
            ],
            [
                'kode_akun' => '3-2000',
                'nama_akun' => 'Laba Ditahan',
                'tabel_bantuan' => '3-2000',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 502000000.00,
            ],
            [
                'kode_akun' => '3-3000',
                'nama_akun' => 'Laba Tahun Berjalan',
                'tabel_bantuan' => '3-3000',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'NERACA',
                'debit' => null,
                'credit' => 0.00,
            ],
            
            // PENDAPATAN
            [
                'kode_akun' => '4-1000',
                'nama_akun' => 'Pendapatan Penjualan',
                'tabel_bantuan' => '4-1000',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => null,
                'credit' => 0.00,
            ],
            [
                'kode_akun' => '4-2000',
                'nama_akun' => 'Pendapatan Jasa',
                'tabel_bantuan' => '4-2000',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => null,
                'credit' => 0.00,
            ],
            [
                'kode_akun' => '4-3000',
                'nama_akun' => 'Pendapatan Lain-lain',
                'tabel_bantuan' => '4-3000',
                'pos_saldo' => 'CREDIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => null,
                'credit' => 0.00,
            ],
            
            // BEBAN POKOK PENJUALAN
            [
                'kode_akun' => '5-1000',
                'nama_akun' => 'Harga Pokok Penjualan',
                'tabel_bantuan' => '5-1000',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            
            // BEBAN OPERASIONAL
            [
                'kode_akun' => '6-1000',
                'nama_akun' => 'Beban Gaji',
                'tabel_bantuan' => '6-1000',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1100',
                'nama_akun' => 'Beban Sewa',
                'tabel_bantuan' => '6-1100',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1200',
                'nama_akun' => 'Beban Listrik',
                'tabel_bantuan' => '6-1200',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1300',
                'nama_akun' => 'Beban Telepon & Internet',
                'tabel_bantuan' => '6-1300',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1400',
                'nama_akun' => 'Beban Perlengkapan',
                'tabel_bantuan' => '6-1400',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1500',
                'nama_akun' => 'Beban Penyusutan Gedung',
                'tabel_bantuan' => '6-1500',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1600',
                'nama_akun' => 'Beban Penyusutan Kendaraan',
                'tabel_bantuan' => '6-1600',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1700',
                'nama_akun' => 'Beban Penyusutan Peralatan',
                'tabel_bantuan' => '6-1700',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1800',
                'nama_akun' => 'Beban Administrasi',
                'tabel_bantuan' => '6-1800',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
            [
                'kode_akun' => '6-1900',
                'nama_akun' => 'Beban Pemasaran',
                'tabel_bantuan' => '6-1900',
                'pos_saldo' => 'DEBIT',
                'pos_laporan' => 'LABARUGI',
                'debit' => 0.00,
                'credit' => null,
            ],
        ];

        foreach ($kodeAkun as $data) {
            KodeAkun::create([
                'kode_akun' => $data['kode_akun'],
                'nama_akun' => $data['nama_akun'],
                'tabel_bantuan' => $data['tabel_bantuan'],
                'pos_saldo' => $data['pos_saldo'],
                'pos_laporan' => $data['pos_laporan'],
                'debit' => $data['debit'],
                'credit' => $data['credit'],
                'company_id' => $this->companyId,
                'period_id' => $periodId,
            ]);
        }
    }

    private function seedKodeBantu($periodId)
    {
        $kodeBantu = [
            // KAS & BANK
            ['kode_bantu' => '1-1100', 'nama_bantu' => 'Kas Utama', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-1110', 'nama_bantu' => 'Bank BCA Rekening Operasional', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-1120', 'nama_bantu' => 'Bank Mandiri Rekening Giro', 'status' => 'PIUTANG', 'balance' => 0.00],
            
            // PIUTANG
            ['kode_bantu' => '1-1200', 'nama_bantu' => 'Piutang Dagang', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-1210', 'nama_bantu' => 'Piutang Pegawai', 'status' => 'PIUTANG', 'balance' => 0.00],
            
            // PERSEDIAAN
            ['kode_bantu' => '1-1300', 'nama_bantu' => 'Persediaan Barang Jadi', 'status' => 'PIUTANG', 'balance' => 0.00],
            
            // BIAYA DIBAYAR DIMUKA
            ['kode_bantu' => '1-1400', 'nama_bantu' => 'Biaya Sewa Dibayar Dimuka', 'status' => 'PIUTANG', 'balance' => 0.00],
            
            // ASET TETAP
            ['kode_bantu' => '1-2100', 'nama_bantu' => 'Tanah Lokasi Pabrik', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-2200', 'nama_bantu' => 'Gedung Kantor dan Pabrik', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-2210', 'nama_bantu' => 'Akumulasi Penyusutan Gedung', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-2300', 'nama_bantu' => 'Kendaraan Operasional', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-2310', 'nama_bantu' => 'Akumulasi Penyusutan Kendaraan', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-2400', 'nama_bantu' => 'Peralatan Komputer dan Kantor', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '1-2410', 'nama_bantu' => 'Akumulasi Penyusutan Peralatan', 'status' => 'HUTANG', 'balance' => 0.00],
            
            // HUTANG
            ['kode_bantu' => '2-1100', 'nama_bantu' => 'Hutang Supplier', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '2-1200', 'nama_bantu' => 'Hutang Gaji Karyawan', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '2-1300', 'nama_bantu' => 'Hutang Pajak PPh 21/23', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '2-2100', 'nama_bantu' => 'Hutang Bank BRI KUR', 'status' => 'HUTANG', 'balance' => 0.00],
            
            // MODAL
            ['kode_bantu' => '3-1000', 'nama_bantu' => 'Modal Disetor Pemegang Saham', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '3-2000', 'nama_bantu' => 'Laba Ditahan Tahun Lalu', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '3-3000', 'nama_bantu' => 'Laba Rugi Tahun Berjalan', 'status' => 'HUTANG', 'balance' => 0.00],
            
            // PENDAPATAN
            ['kode_bantu' => '4-1000', 'nama_bantu' => 'Penjualan Produk', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '4-2000', 'nama_bantu' => 'Pendapatan Jasa Konsultasi', 'status' => 'HUTANG', 'balance' => 0.00],
            ['kode_bantu' => '4-3000', 'nama_bantu' => 'Pendapatan Bunga dan Lainnya', 'status' => 'HUTANG', 'balance' => 0.00],
            
            // HPP & BEBAN
            ['kode_bantu' => '5-1000', 'nama_bantu' => 'Harga Pokok Penjualan Produk', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1000', 'nama_bantu' => 'Gaji Karyawan Tetap dan Kontrak', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1100', 'nama_bantu' => 'Sewa Gedung Kantor', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1200', 'nama_bantu' => 'Listrik PLN', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1300', 'nama_bantu' => 'Telepon dan Internet', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1400', 'nama_bantu' => 'Perlengkapan Kantor', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1500', 'nama_bantu' => 'Penyusutan Gedung Metode Garis Lurus', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1600', 'nama_bantu' => 'Penyusutan Kendaraan Metode Garis Lurus', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1700', 'nama_bantu' => 'Penyusutan Peralatan Metode Garis Lurus', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1800', 'nama_bantu' => 'Biaya Administrasi Umum', 'status' => 'PIUTANG', 'balance' => 0.00],
            ['kode_bantu' => '6-1900', 'nama_bantu' => 'Biaya Iklan dan Promosi', 'status' => 'PIUTANG', 'balance' => 0.00],
        ];

        foreach ($kodeBantu as $bantu) {
            KodeBantu::create([
                'kode_bantu' => $bantu['kode_bantu'],
                'nama_bantu' => $bantu['nama_bantu'],
                'status' => $bantu['status'],
                'balance' => $bantu['balance'],
                'company_id' => $this->companyId,
                'period_id' => $periodId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedJurnalUmumNovember()
    {
        $journalNov = [
            // 1 Nov - Penjualan tunai
            ['tanggal' => '2025-11-01', 'bukti' => 'JU-1101', 'ket' => 'Penjualan tunai', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => 45000000.00, 'credit' => null],
            ['tanggal' => '2025-11-01', 'bukti' => 'JU-1101', 'ket' => 'Penjualan tunai', 'kode_akun' => '4-1000', 'kode_bantu' => '4-1000', 'debit' => null, 'credit' => 45000000.00],
            
            ['tanggal' => '2025-11-01', 'bukti' => 'JU-1102', 'ket' => 'Pencatatan HPP', 'kode_akun' => '5-1000', 'kode_bantu' => '5-1000', 'debit' => 27000000.00, 'credit' => null],
            ['tanggal' => '2025-11-01', 'bukti' => 'JU-1102', 'ket' => 'Pencatatan HPP', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => null, 'credit' => 27000000.00],
            
            // 3 Nov - Penjualan kredit
            ['tanggal' => '2025-11-03', 'bukti' => 'JU-1103', 'ket' => 'Penjualan kredit ke PT ABC', 'kode_akun' => '1-1200', 'kode_bantu' => '1-1200', 'debit' => 65000000.00, 'credit' => null],
            ['tanggal' => '2025-11-03', 'bukti' => 'JU-1103', 'ket' => 'Penjualan kredit ke PT ABC', 'kode_akun' => '4-1000', 'kode_bantu' => '4-1000', 'debit' => null, 'credit' => 65000000.00],
            
            ['tanggal' => '2025-11-03', 'bukti' => 'JU-1104', 'ket' => 'Pencatatan HPP', 'kode_akun' => '5-1000', 'kode_bantu' => '5-1000', 'debit' => 39000000.00, 'credit' => null],
            ['tanggal' => '2025-11-03', 'bukti' => 'JU-1104', 'ket' => 'Pencatatan HPP', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => null, 'credit' => 39000000.00],
            
            // 5 Nov - Pembelian persediaan
            ['tanggal' => '2025-11-05', 'bukti' => 'JU-1105', 'ket' => 'Pembelian persediaan tunai', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => 55000000.00, 'credit' => null],
            ['tanggal' => '2025-11-05', 'bukti' => 'JU-1105', 'ket' => 'Pembelian persediaan tunai', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 55000000.00],
            
            // 7 Nov - Pembayaran gaji
            ['tanggal' => '2025-11-07', 'bukti' => 'JU-1106', 'ket' => 'Pembayaran gaji karyawan', 'kode_akun' => '6-1000', 'kode_bantu' => '6-1000', 'debit' => 28000000.00, 'credit' => null],
            ['tanggal' => '2025-11-07', 'bukti' => 'JU-1106', 'ket' => 'Pembayaran gaji karyawan', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 28000000.00],
            
            // 10 Nov - Penerimaan piutang
            ['tanggal' => '2025-11-10', 'bukti' => 'JU-1107', 'ket' => 'Penerimaan dari PT ABC', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => 32500000.00, 'credit' => null],
            ['tanggal' => '2025-11-10', 'bukti' => 'JU-1107', 'ket' => 'Penerimaan dari PT ABC', 'kode_akun' => '1-1200', 'kode_bantu' => '1-1200', 'debit' => null, 'credit' => 32500000.00],
            
            // 12 Nov - Pendapatan jasa
            ['tanggal' => '2025-11-12', 'bukti' => 'JU-1108', 'ket' => 'Penjualan jasa konsultasi', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => 18000000.00, 'credit' => null],
            ['tanggal' => '2025-11-12', 'bukti' => 'JU-1108', 'ket' => 'Penjualan jasa konsultasi', 'kode_akun' => '4-2000', 'kode_bantu' => '4-2000', 'debit' => null, 'credit' => 18000000.00],
            
            // 15 Nov - Pembelian kredit
            ['tanggal' => '2025-11-15', 'bukti' => 'JU-1109', 'ket' => 'Pembelian kredit dari CV XYZ', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => 42000000.00, 'credit' => null],
            ['tanggal' => '2025-11-15', 'bukti' => 'JU-1109', 'ket' => 'Pembelian kredit dari CV XYZ', 'kode_akun' => '2-1100', 'kode_bantu' => '2-1100', 'debit' => null, 'credit' => 42000000.00],
            
            // 18 Nov - Pembayaran sewa
            ['tanggal' => '2025-11-18', 'bukti' => 'JU-1110', 'ket' => 'Pembayaran sewa gedung', 'kode_akun' => '6-1100', 'kode_bantu' => '6-1100', 'debit' => 15000000.00, 'credit' => null],
            ['tanggal' => '2025-11-18', 'bukti' => 'JU-1110', 'ket' => 'Pembayaran sewa gedung', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 15000000.00],
            
            // 20 Nov - Penjualan tunai
            ['tanggal' => '2025-11-20', 'bukti' => 'JU-1111', 'ket' => 'Penjualan tunai', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => 52000000.00, 'credit' => null],
            ['tanggal' => '2025-11-20', 'bukti' => 'JU-1111', 'ket' => 'Penjualan tunai', 'kode_akun' => '4-1000', 'kode_bantu' => '4-1000', 'debit' => null, 'credit' => 52000000.00],
            
            ['tanggal' => '2025-11-20', 'bukti' => 'JU-1112', 'ket' => 'Pencatatan HPP', 'kode_akun' => '5-1000', 'kode_bantu' => '5-1000', 'debit' => 31200000.00, 'credit' => null],
            ['tanggal' => '2025-11-20', 'bukti' => 'JU-1112', 'ket' => 'Pencatatan HPP', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => null, 'credit' => 31200000.00],
            
            // 22 Nov - Pembayaran hutang
            ['tanggal' => '2025-11-22', 'bukti' => 'JU-1113', 'ket' => 'Pembayaran hutang ke CV XYZ', 'kode_akun' => '2-1100', 'kode_bantu' => '2-1100', 'debit' => 21000000.00, 'credit' => null],
            ['tanggal' => '2025-11-22', 'bukti' => 'JU-1113', 'ket' => 'Pembayaran hutang ke CV XYZ', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 21000000.00],
            
            // 25 Nov - Pembayaran listrik
            ['tanggal' => '2025-11-25', 'bukti' => 'JU-1114', 'ket' => 'Pembayaran listrik', 'kode_akun' => '6-1200', 'kode_bantu' => '6-1200', 'debit' => 3500000.00, 'credit' => null],
            ['tanggal' => '2025-11-25', 'bukti' => 'JU-1114', 'ket' => 'Pembayaran listrik', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => null, 'credit' => 3500000.00],
            
            // 26 Nov - Pembayaran telepon & internet
            ['tanggal' => '2025-11-26', 'bukti' => 'JU-1115', 'ket' => 'Pembayaran telepon & internet', 'kode_akun' => '6-1300', 'kode_bantu' => '6-1300', 'debit' => 2200000.00, 'credit' => null],
            ['tanggal' => '2025-11-26', 'bukti' => 'JU-1115', 'ket' => 'Pembayaran telepon & internet', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => null, 'credit' => 2200000.00],
            
            // 28 Nov - Beban pemasaran
            ['tanggal' => '2025-11-28', 'bukti' => 'JU-1116', 'ket' => 'Beban pemasaran', 'kode_akun' => '6-1900', 'kode_bantu' => '6-1900', 'debit' => 8500000.00, 'credit' => null],
            ['tanggal' => '2025-11-28', 'bukti' => 'JU-1116', 'ket' => 'Beban pemasaran', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 8500000.00],
            
            // 30 Nov - Penyesuaian penyusutan gedung
            ['tanggal' => '2025-11-30', 'bukti' => 'JU-1117', 'ket' => 'Penyesuaian: Beban penyusutan gedung', 'kode_akun' => '6-1500', 'kode_bantu' => '6-1500', 'debit' => 4166667.00, 'credit' => null],
            ['tanggal' => '2025-11-30', 'bukti' => 'JU-1117', 'ket' => 'Penyesuaian: Beban penyusutan gedung', 'kode_akun' => '1-2210', 'kode_bantu' => '1-2210', 'debit' => null, 'credit' => 4166667.00],
            
            // 30 Nov - Penyesuaian penyusutan kendaraan
            ['tanggal' => '2025-11-30', 'bukti' => 'JU-1118', 'ket' => 'Penyesuaian: Beban penyusutan kendaraan', 'kode_akun' => '6-1600', 'kode_bantu' => '6-1600', 'debit' => 2500000.00, 'credit' => null],
            ['tanggal' => '2025-11-30', 'bukti' => 'JU-1118', 'ket' => 'Penyesuaian: Beban penyusutan kendaraan', 'kode_akun' => '1-2310', 'kode_bantu' => '1-2310', 'debit' => null, 'credit' => 2500000.00],
            
            // 30 Nov - Penyesuaian penyusutan peralatan
            ['tanggal' => '2025-11-30', 'bukti' => 'JU-1119', 'ket' => 'Penyesuaian: Beban penyusutan peralatan', 'kode_akun' => '6-1700', 'kode_bantu' => '6-1700', 'debit' => 833333.00, 'credit' => null],
            ['tanggal' => '2025-11-30', 'bukti' => 'JU-1119', 'ket' => 'Penyesuaian: Beban penyusutan peralatan', 'kode_akun' => '1-2410', 'kode_bantu' => '1-2410', 'debit' => null, 'credit' => 833333.00],
        ];

        foreach ($journalNov as $journal) {
            JurnalUmum::create([
                'tanggal' => $journal['tanggal'],
                'bukti_transaksi' => $journal['bukti'],
                'keterangan' => $journal['ket'],
                'kode_akun' => $journal['kode_akun'],
                'kode_bantu' => $journal['kode_bantu'],
                'debit' => $journal['debit'],
                'credit' => $journal['credit'],
                'company_id' => $this->companyId,
                'period_id' => $this->periodNovember,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function seedJurnalUmumDesember()
    {
        $journalDes = [
            // 2 Des - Penjualan tunai
            ['tanggal' => '2025-12-02', 'bukti' => 'JU-1201', 'ket' => 'Penjualan tunai', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => 58000000.00, 'credit' => null],
            ['tanggal' => '2025-12-02', 'bukti' => 'JU-1201', 'ket' => 'Penjualan tunai', 'kode_akun' => '4-1000', 'kode_bantu' => '4-1000', 'debit' => null, 'credit' => 58000000.00],
            
            ['tanggal' => '2025-12-02', 'bukti' => 'JU-1202', 'ket' => 'Pencatatan HPP', 'kode_akun' => '5-1000', 'kode_bantu' => '5-1000', 'debit' => 34800000.00, 'credit' => null],
            ['tanggal' => '2025-12-02', 'bukti' => 'JU-1202', 'ket' => 'Pencatatan HPP', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => null, 'credit' => 34800000.00],
            
            // 4 Des - Penjualan kredit
            ['tanggal' => '2025-12-04', 'bukti' => 'JU-1203', 'ket' => 'Penjualan kredit ke PT DEF', 'kode_akun' => '1-1200', 'kode_bantu' => '1-1200', 'debit' => 72000000.00, 'credit' => null],
            ['tanggal' => '2025-12-04', 'bukti' => 'JU-1203', 'ket' => 'Penjualan kredit ke PT DEF', 'kode_akun' => '4-1000', 'kode_bantu' => '4-1000', 'debit' => null, 'credit' => 72000000.00],
            
            ['tanggal' => '2025-12-04', 'bukti' => 'JU-1204', 'ket' => 'Pencatatan HPP', 'kode_akun' => '5-1000', 'kode_bantu' => '5-1000', 'debit' => 43200000.00, 'credit' => null],
            ['tanggal' => '2025-12-04', 'bukti' => 'JU-1204', 'ket' => 'Pencatatan HPP', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => null, 'credit' => 43200000.00],
            
            // 6 Des - Pembelian persediaan
            ['tanggal' => '2025-12-06', 'bukti' => 'JU-1205', 'ket' => 'Pembelian persediaan tunai', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => 68000000.00, 'credit' => null],
            ['tanggal' => '2025-12-06', 'bukti' => 'JU-1205', 'ket' => 'Pembelian persediaan tunai', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 68000000.00],
            
            // 7 Des - Pembayaran gaji
            ['tanggal' => '2025-12-07', 'bukti' => 'JU-1206', 'ket' => 'Pembayaran gaji karyawan', 'kode_akun' => '6-1000', 'kode_bantu' => '6-1000', 'debit' => 28000000.00, 'credit' => null],
            ['tanggal' => '2025-12-07', 'bukti' => 'JU-1206', 'ket' => 'Pembayaran gaji karyawan', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 28000000.00],
            
            // 9 Des - Penerimaan piutang
            ['tanggal' => '2025-12-09', 'bukti' => 'JU-1207', 'ket' => 'Penerimaan dari PT ABC (sisa)', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => 32500000.00, 'credit' => null],
            ['tanggal' => '2025-12-09', 'bukti' => 'JU-1207', 'ket' => 'Penerimaan dari PT ABC (sisa)', 'kode_akun' => '1-1200', 'kode_bantu' => '1-1200', 'debit' => null, 'credit' => 32500000.00],
            
            // 11 Des - Pendapatan jasa
            ['tanggal' => '2025-12-11', 'bukti' => 'JU-1208', 'ket' => 'Penjualan jasa konsultasi', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => 22000000.00, 'credit' => null],
            ['tanggal' => '2025-12-11', 'bukti' => 'JU-1208', 'ket' => 'Penjualan jasa konsultasi', 'kode_akun' => '4-2000', 'kode_bantu' => '4-2000', 'debit' => null, 'credit' => 22000000.00],
            
            // 13 Des - Pembelian kredit
            ['tanggal' => '2025-12-13', 'bukti' => 'JU-1209', 'ket' => 'Pembelian kredit dari PT Supplier', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => 48000000.00, 'credit' => null],
            ['tanggal' => '2025-12-13', 'bukti' => 'JU-1209', 'ket' => 'Pembelian kredit dari PT Supplier', 'kode_akun' => '2-1100', 'kode_bantu' => '2-1100', 'debit' => null, 'credit' => 48000000.00],
            
            // 15 Des - Pembayaran sewa
            ['tanggal' => '2025-12-15', 'bukti' => 'JU-1210', 'ket' => 'Pembayaran sewa gedung', 'kode_akun' => '6-1100', 'kode_bantu' => '6-1100', 'debit' => 15000000.00, 'credit' => null],
            ['tanggal' => '2025-12-15', 'bukti' => 'JU-1210', 'ket' => 'Pembayaran sewa gedung', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 15000000.00],
            
            // 17 Des - Penjualan tunai
            ['tanggal' => '2025-12-17', 'bukti' => 'JU-1211', 'ket' => 'Penjualan tunai', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => 63000000.00, 'credit' => null],
            ['tanggal' => '2025-12-17', 'bukti' => 'JU-1211', 'ket' => 'Penjualan tunai', 'kode_akun' => '4-1000', 'kode_bantu' => '4-1000', 'debit' => null, 'credit' => 63000000.00],
            
            ['tanggal' => '2025-12-17', 'bukti' => 'JU-1212', 'ket' => 'Pencatatan HPP', 'kode_akun' => '5-1000', 'kode_bantu' => '5-1000', 'debit' => 37800000.00, 'credit' => null],
            ['tanggal' => '2025-12-17', 'bukti' => 'JU-1212', 'ket' => 'Pencatatan HPP', 'kode_akun' => '1-1300', 'kode_bantu' => '1-1300', 'debit' => null, 'credit' => 37800000.00],
            
            // 19 Des - Pembayaran hutang
            ['tanggal' => '2025-12-19', 'bukti' => 'JU-1213', 'ket' => 'Pembayaran hutang ke CV XYZ', 'kode_akun' => '2-1100', 'kode_bantu' => '2-1100', 'debit' => 21000000.00, 'credit' => null],
            ['tanggal' => '2025-12-19', 'bukti' => 'JU-1213', 'ket' => 'Pembayaran hutang ke CV XYZ', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 21000000.00],
            
            // 20 Des - Penerimaan piutang
            ['tanggal' => '2025-12-20', 'bukti' => 'JU-1214', 'ket' => 'Penerimaan dari PT DEF', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => 36000000.00, 'credit' => null],
            ['tanggal' => '2025-12-20', 'bukti' => 'JU-1214', 'ket' => 'Penerimaan dari PT DEF', 'kode_akun' => '1-1200', 'kode_bantu' => '1-1200', 'debit' => null, 'credit' => 36000000.00],
            
            // 23 Des - Pembayaran listrik
            ['tanggal' => '2025-12-23', 'bukti' => 'JU-1215', 'ket' => 'Pembayaran listrik', 'kode_akun' => '6-1200', 'kode_bantu' => '6-1200', 'debit' => 4200000.00, 'credit' => null],
            ['tanggal' => '2025-12-23', 'bukti' => 'JU-1215', 'ket' => 'Pembayaran listrik', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => null, 'credit' => 4200000.00],
            
            // 24 Des - Pembayaran telepon & internet
            ['tanggal' => '2025-12-24', 'bukti' => 'JU-1216', 'ket' => 'Pembayaran telepon & internet', 'kode_akun' => '6-1300', 'kode_bantu' => '6-1300', 'debit' => 2400000.00, 'credit' => null],
            ['tanggal' => '2025-12-24', 'bukti' => 'JU-1216', 'ket' => 'Pembayaran telepon & internet', 'kode_akun' => '1-1100', 'kode_bantu' => '1-1100', 'debit' => null, 'credit' => 2400000.00],
            
            // 26 Des - Beban administrasi
            ['tanggal' => '2025-12-26', 'bukti' => 'JU-1217', 'ket' => 'Beban administrasi', 'kode_akun' => '6-1800', 'kode_bantu' => '6-1800', 'debit' => 5500000.00, 'credit' => null],
            ['tanggal' => '2025-12-26', 'bukti' => 'JU-1217', 'ket' => 'Beban administrasi', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 5500000.00],
            
            // 28 Des - Beban pemasaran
            ['tanggal' => '2025-12-28', 'bukti' => 'JU-1218', 'ket' => 'Beban pemasaran', 'kode_akun' => '6-1900', 'kode_bantu' => '6-1900', 'debit' => 12000000.00, 'credit' => null],
            ['tanggal' => '2025-12-28', 'bukti' => 'JU-1218', 'ket' => 'Beban pemasaran', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => null, 'credit' => 12000000.00],
            
            // 30 Des - Pendapatan bunga bank
            ['tanggal' => '2025-12-30', 'bukti' => 'JU-1219', 'ket' => 'Pendapatan bunga bank', 'kode_akun' => '1-1110', 'kode_bantu' => '1-1110', 'debit' => 1250000.00, 'credit' => null],
            ['tanggal' => '2025-12-30', 'bukti' => 'JU-1219', 'ket' => 'Pendapatan bunga bank', 'kode_akun' => '4-3000', 'kode_bantu' => '4-3000', 'debit' => null, 'credit' => 1250000.00],
            
            // 31 Des - Penyesuaian penyusutan gedung
            ['tanggal' => '2025-12-31', 'bukti' => 'JU-1220', 'ket' => 'Penyesuaian: Beban penyusutan gedung', 'kode_akun' => '6-1500', 'kode_bantu' => '6-1500', 'debit' => 4166667.00, 'credit' => null],
            ['tanggal' => '2025-12-31', 'bukti' => 'JU-1220', 'ket' => 'Penyesuaian: Beban penyusutan gedung', 'kode_akun' => '1-2210', 'kode_bantu' => '1-2210', 'debit' => null, 'credit' => 4166667.00],
            
            // 31 Des - Penyesuaian penyusutan kendaraan
            ['tanggal' => '2025-12-31', 'bukti' => 'JU-1221', 'ket' => 'Penyesuaian: Beban penyusutan kendaraan', 'kode_akun' => '6-1600', 'kode_bantu' => '6-1600', 'debit' => 2500000.00, 'credit' => null],
            ['tanggal' => '2025-12-31', 'bukti' => 'JU-1221', 'ket' => 'Penyesuaian: Beban penyusutan kendaraan', 'kode_akun' => '1-2310', 'kode_bantu' => '1-2310', 'debit' => null, 'credit' => 2500000.00],
            
            // 31 Des - Penyesuaian penyusutan peralatan
            ['tanggal' => '2025-12-31', 'bukti' => 'JU-1222', 'ket' => 'Penyesuaian: Beban penyusutan peralatan', 'kode_akun' => '6-1700', 'kode_bantu' => '6-1700', 'debit' => 833333.00, 'credit' => null],
            ['tanggal' => '2025-12-31', 'bukti' => 'JU-1222', 'ket' => 'Penyesuaian: Beban penyusutan peralatan', 'kode_akun' => '1-2410', 'kode_bantu' => '1-2410', 'debit' => null, 'credit' => 833333.00],
        ];

        foreach ($journalDes as $journal) {
            JurnalUmum::create([
                'tanggal' => $journal['tanggal'],
                'bukti_transaksi' => $journal['bukti'],
                'keterangan' => $journal['ket'],
                'kode_akun' => $journal['kode_akun'],
                'kode_bantu' => $journal['kode_bantu'],
                'debit' => $journal['debit'],
                'credit' => $journal['credit'],
                'company_id' => $this->companyId,
                'period_id' => $this->periodDesember,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}