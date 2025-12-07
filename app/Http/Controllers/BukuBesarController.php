<?php

namespace App\Http\Controllers;

use App\Models\JurnalUmum;
use App\Models\KodeAkun;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Pengecekan sudah benar menggunakan company_id dan period_id
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
        // Pengecekan sudah benar menggunakan company_id dan period_id
        if (!auth()->user()->company_id || !auth()->user()->period_id) {
            return view('staff.bukubesar', [
                'accounts' => collect(),
                'transactions' => collect()
            ]);
        }

        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
        
        $accounts = KodeAkun::whereHas('journalEntries', function($query) use ($company_id, $period_id) {
                // PERBAIKAN: Mengganti company_period_id ke period_id
                $query->where('company_id', $company_id)
                      ->where('period_id', $period_id); 
            })
            ->where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id ke period_id
            ->where('period_id', $period_id)
            // PERBAIKAN: Mengganti account_id, name ke kode_akun, nama_akun
            ->orderBy('kode_akun')
            ->select('kode_akun', 'nama_akun')
            ->get()
            ->map(function($account) {
                // PERBAIKAN: Mengganti code, account_id, name
                // KE: code, kode_akun, nama_akun
                return [
                    'code' => $account->kode_akun,
                    'name' => $account->nama_akun
                ];
            });
            
        $transactions = collect();
        
        return view('staff.bukubesar', compact('accounts', 'transactions'));
    }
    
    public function getTransactions(Request $request)
    {
        $validated = $request->validate([
            // PERBAIKAN: Mengganti account_id ke kode_akun di exists
            'account_id' => 'required|exists:kode_akun,kode_akun'
        ]);

        // PERBAIKAN: Mengganti active_company_id dan company_period_id
        // KE: company_id dan period_id
        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
        $account_id = $validated['account_id'];
        
        $transactions = $this->getAccountTransactions($company_id, $period_id, $account_id);
        
        return response()->json($transactions);
    }

    public function getAccountTransactions($company_id, $period_id, $account_id) 
    {
        $account = KodeAkun::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id dan account_id
            // KE: period_id dan kode_akun
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->first();

        if (!$account) {
            return collect(); 
        }

        // PERBAIKAN: Mengganti balance_type ke pos_saldo (nama kolom di kode_akun)
        $running_balance = $account->pos_saldo === 'DEBIT' ? 
            ($account->debit ?? 0) : 
            ($account->credit ?? 0); 

        $transactions = JurnalUmum::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id dan account_id
            // KE: period_id dan kode_akun
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            // PERBAIKAN: Mengganti date ke tanggal
            ->orderBy('tanggal')
            // PERBAIKAN: Mengganti id ke jurnalumum_id (atau biarkan id jika Model dikonfigurasi)
            // Kita gunakan kolom PK yang benar
            ->orderBy('jurnalumum_id')
            ->get();
            
        return $transactions->map(function($transaction, $index) use (&$running_balance, $account) {
            // PERBAIKAN: Mengganti balance_type ke pos_saldo
            if ($account->pos_saldo === 'DEBIT') { 
                $running_balance += ($transaction->debit ?? 0) - ($transaction->credit ?? 0);
            } else { // CREDIT
                $running_balance += ($transaction->credit ?? 0) - ($transaction->debit ?? 0);
            }

            return [
                'no' => $index + 1,
                // PERBAIKAN: Mengganti date ke tanggal
                'date' => $transaction->tanggal->format('Y-m-d'),
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

    public function getAccountBalance($company_id, $period_id, $account_id)
    {
        $account = KodeAkun::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id dan account_id
            // KE: period_id dan kode_akun
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->first();
    
        if (!$account) {
            return 0;
        }
        
        // PERBAIKAN: Mengganti balance_type ke pos_saldo
        $pos_saldo = $account->pos_saldo;
        
        if ($pos_saldo === 'DEBIT') {
            $running_balance = ($account->debit ?? 0) - ($account->credit ?? 0); 
        } else {
            $running_balance = ($account->credit ?? 0) - ($account->debit ?? 0); 
        }
    
        $transactions = JurnalUmum::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id dan account_id
            // KE: period_id dan kode_akun
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            // PERBAIKAN: Mengganti date dan id
            ->orderBy('tanggal')
            ->orderBy('jurnalumum_id')
            ->get();
    
        foreach ($transactions as $transaction) {
            if ($pos_saldo === 'DEBIT') {
                $running_balance = $running_balance + ($transaction->debit ?? 0) - ($transaction->credit ?? 0);
            } else {
                $running_balance = $running_balance + ($transaction->credit ?? 0) - ($transaction->debit ?? 0);
            }
        }
    
        return $running_balance;
    }
}