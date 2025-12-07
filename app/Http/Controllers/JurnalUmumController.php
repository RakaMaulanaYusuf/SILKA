<?php

namespace App\Http\Controllers;

use App\Models\JurnalUmum;
use App\Models\KodeAkun;
use App\Models\KodeBantu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalUmumController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->company_id || !auth()->user()->period_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan pilih perusahaan dan periode terlebih dahulu'
                ], 400);
            }
            return $next($request);
        })->except(['index']);
    }

    private function checkBalance($journals)
    {
        $totalDebit = $journals->sum('debit') ?? 0;
        $totalCredit = $journals->sum('credit') ?? 0;
        
        $status = [
            'is_balanced' => abs($totalDebit - $totalCredit) < 0.01,
            'total_debit' => $totalDebit,
            'total_credit' => $totalCredit,
            'message' => abs($totalDebit - $totalCredit) < 0.01 ? 
                'Total Debit dan Kredit sudah balance' : 
                'Total Debit dan Kredit belum balance'
        ];
        
        return $status;
    }

    public function index()
    {
        if (!auth()->user()->company_id || !auth()->user()->period_id) {
            return view('staff.jurnalumum', [
                'journals' => collect(),
                'accounts' => collect(),
                'helpers' => collect(),
                'balanceStatus' => null
            ]);
        }

        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
        
        $journals = JurnalUmum::with(['account', 'helper'])
            ->where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('bukti_transaksi')
            ->get()
            ->map(function($journal) {
                return [
                    'id' => $journal->jurnalumum_id,
                    'tanggal' => \Carbon\Carbon::parse($journal->tanggal)->format('Y-m-d'), //ini sebenarnya ->date->format('Y-m-d')
                    'bukti_transaksi' => $journal->bukti_transaksi,
                    'keterangan' => $journal->keterangan,
                    'kode_akun' => $journal->kode_akun,
                    'nama_akun' => $journal->account->nama_akun, 
                    'kode_bantu' => $journal->kode_bantu,
                    'nama_bantu' => $journal->helper?->nama_bantu,
                    'debit' => $journal->debit,
                    'credit' => $journal->credit,
                ];
            });

        $balanceStatus = $this->checkBalance(collect($journals));

        $accounts = KodeAkun::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->orderBy('kode_akun')
            ->get()
            ->map(function($account) {
                return [
                    'kode_akun' => $account->kode_akun,
                    'nama_akun' => $account->nama_akun
                ];
            });
            
        $helpers = KodeBantu::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->orderBy('kode_bantu')
            ->get()
            ->map(function($helper) {
                return [
                    'kode_bantu' => $helper->kode_bantu,
                    'nama_bantu' => $helper->nama_bantu
                ];
            });
            
        return view('staff.jurnalumum', compact('journals', 'accounts', 'helpers', 'balanceStatus'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'bukti_transaksi' => 'required|string',
                'keterangan' => 'required|string',
                'kode_akun' => 'required|exists:kode_akun,kode_akun',
                'kode_bantu' => 'nullable|exists:kode_bantu,kode_bantu',
                'debit' => 'required_without:credit|nullable|numeric|min:0',
                'credit' => 'required_without:debit|nullable|numeric|min:0',
            ]);

            DB::beginTransaction();
            try {
                $journal = JurnalUmum::create([
                    'company_id' => auth()->user()->company_id,
                    'period_id' => auth()->user()->period_id, 
                    'tanggal' => $validated['tanggal'],
                    'bukti_transaksi' => $validated['bukti_transaksi'],
                    'keterangan' => $validated['keterangan'],
                    'kode_akun' => $validated['kode_akun'],
                    'kode_bantu' => $validated['kode_bantu'],
                    'debit' => $validated['debit'],
                    'credit' => $validated['credit'],
                ]);

                $journal->load(['account', 'helper']);

                $responseData = [
                    'id' => $journal->jurnalumum_id,
                    'tanggal' => \Carbon\Carbon::parse($journal->tanggal)->format('Y-m-d'), //ini
                    'bukti_transaksi' => $journal->bukti_transaksi,
                    'keterangan' => $journal->keterangan,
                    'kode_akun' => $journal->kode_akun,
                    'nama_akun' => $journal->account->nama_akun,
                    'kode_bantu' => $journal->kode_bantu,
                    'nama_bantu' => $journal->helper?->nama_bantu,
                    'debit' => $journal->debit,
                    'credit' => $journal->credit,
                ];

                DB::commit();

                return response()->json([
                    'success' => true,
                    'journal' => $responseData,
                    'message' => 'Data berhasil disimpan'
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Log::error('Error saving journal entry: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, JurnalUmum $jurnalUmum)
    {
        try {
            if ($jurnalUmum->company_id !== auth()->user()->company_id || 
                $jurnalUmum->period_id !== auth()->user()->period_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $validated = $request->validate([
                'tanggal' => 'required|date',
                'bukti_transaksi' => 'required|string',
                'keterangan' => 'required|string',
                'kode_akun' => 'required|exists:kode_akun,kode_akun',
                'kode_bantu' => 'nullable|exists:kode_bantu,kode_bantu',
                'debit' => 'required_without:credit|nullable|numeric|min:0',
                'credit' => 'required_without:debit|nullable|numeric|min:0',
            ]);

            DB::beginTransaction();
            try {
                $jurnalUmum->update([
                    'tanggal' => $validated['tanggal'],
                    'bukti_transaksi' => $validated['bukti_transaksi'],
                    'keterangan' => $validated['keterangan'],
                    'kode_akun' => $validated['kode_akun'],
                    'kode_bantu' => $validated['kode_bantu'],
                    'debit' => $validated['debit'],
                    'credit' => $validated['credit'],
                ]);

                $jurnalUmum->load(['account', 'helper']);

                $responseData = [
                    'id' => $jurnalUmum->jurnalumum_id,
                    'tanggal' => \Carbon\Carbon::parse($jurnalUmum->tanggal)->format('Y-m-d'), //ini, //ini ->format('Y-m-d')
                    'bukti_transaksi' => $jurnalUmum->bukti_transaksi,
                    'keterangan' => $jurnalUmum->keterangan,
                    'kode_akun' => $jurnalUmum->kode_akun,
                    'nama_akun' => $jurnalUmum->account->nama_akun,
                    'kode_bantu' => $jurnalUmum->kode_bantu,
                    'nama_bantu' => $jurnalUmum->helper?->nama_bantu,
                    'debit' => $jurnalUmum->debit,
                    'credit' => $jurnalUmum->credit,
                ];

                DB::commit();

                return response()->json([
                    'success' => true,
                    'journal' => $responseData,
                    'message' => 'Data berhasil diupdate'
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Log::error('Error updating journal entry: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(JurnalUmum $jurnalUmum)
    {
        try {
            if ($jurnalUmum->company_id !== auth()->user()->company_id || 
                $jurnalUmum->period_id !== auth()->user()->period_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            DB::beginTransaction();
            try {
                $jurnalUmum->delete();
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting journal entry: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}