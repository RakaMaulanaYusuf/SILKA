<?php

namespace App\Http\Controllers;

use App\Models\JurnalUmum;
use App\Models\KodeBantu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuBesarPembantuController extends Controller 
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            // KE: company_id dan period_id (nama kolom di migration users)
            if (!auth()->user()->company_id || !auth()->user()->period_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan pilih perusahaan dan periode terlebih dahulu'
                ], 400);
            }
            return $next($request);
        })->except(['index']);
    }

    public function index()
    {
        // PERBAIKAN: Mengganti active_company_id dan company_period_id
        // KE: company_id dan period_id (nama kolom di migration users)
        if (!auth()->user()->company_id || !auth()->user()->period_id) {
            return view('staff.bukubesarpembantu', ['accounts' => collect(), 'transactions' => collect()]);
        }

        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
            
        $accounts = KodeBantu::whereHas('journalEntries', function($query) use ($company_id, $period_id) {
                $query->where('company_id', $company_id)
                      // PERBAIKAN: Mengganti company_period_id ke period_id
                      ->where('period_id', $period_id);
            })
            ->where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id ke period_id
            ->where('period_id', $period_id)
            // PERBAIKAN: Mengganti helper_id ke kodebantu_id atau kode_bantu
            // Kita gunakan kodebantu_id sebagai PK untuk ordering, dan select kolom kode_bantu dan nama_bantu
            ->orderBy('kode_bantu') 
            // PERBAIKAN: Mengganti helper_id dan name
            ->select('kode_bantu', 'nama_bantu') 
            ->get()
            ->map(function($account) {
                // PERBAIKAN: Mengganti code dan name
                return [
                    'code' => $account->kode_bantu,
                    'name' => $account->nama_bantu
                ];
            });
                
        $transactions = collect();
            
        return view('staff.bukubesarpembantu', compact('accounts', 'transactions'));
    }
    
    public function getTransactions(Request $request)
    {
        $validated = $request->validate([
            // PERBAIKAN: Mengganti helper_id ke kode_bantu
            'helper_id' => 'required|exists:kode_bantu,kode_bantu'
        ]);

        // PERBAIKAN: Mengganti active_company_id dan company_period_id
        // KE: company_id dan period_id
        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
        // PERBAIKAN: Mengganti helper_id
        $helper_id = $validated['helper_id']; 
        
        // PERBAIKAN: Mengganti getHelperTransactions
        $transactions = $this->getHelperTransactions($company_id, $period_id, $helper_id);
        
        return response()->json($transactions);
    }

    public function getHelperTransactions($company_id, $period_id, $helper_id) // PERBAIKAN: Mengganti helper_id
    {
        $helper = KodeBantu::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id dan helper_id
            ->where('period_id', $period_id)
            ->where('kode_bantu', $helper_id) // PERBAIKAN: Mengganti helper_id
            ->first();

        if (!$helper) {
            return collect();
        }

        $transactions = JurnalUmum::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id dan helper_id
            ->where('period_id', $period_id)
            ->where('kode_bantu', $helper_id) // PERBAIKAN: Mengganti helper_id
            // PERBAIKAN: Mengganti date dan id
            ->orderBy('tanggal')
            ->orderBy('jurnalumum_id')
            ->get();
            
        $running_balance = $helper->balance ?? 0; 

        return $transactions->map(function($transaction, $index) use (&$running_balance, $helper) {
            if ($helper->status === 'PIUTANG') {
                $running_balance += ($transaction->debit ?? 0) - ($transaction->credit ?? 0);
            } else { 
                $running_balance -= ($transaction->debit ?? 0); 
                $running_balance += ($transaction->credit ?? 0); 
            }

            return [
                'no' => $index + 1,
                // PERBAIKAN: Mengganti date ke tanggal
                'date' => \Carbon\Carbon::parse($transaction->tanggal)->format('Y-m-d'),
                // PERBAIKAN: Mengganti bukti ke bukti_transaksi
                'bukti' => $transaction->bukti_transaksi, 
                // PERBAIKAN: Mengganti description ke keterangan
                'description' => $transaction->keterangan,
                'debit' => $transaction->debit,
                'credit' => $transaction->credit,
                'balance' => $running_balance
            ];
        });
    }
}