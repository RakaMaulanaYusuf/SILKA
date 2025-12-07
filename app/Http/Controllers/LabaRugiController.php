<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\HPP;
use App\Models\BiayaOperasional;
use App\Models\KodeAkun;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LabaRugiController extends Controller
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

    public function index() {
        // PERBAIKAN: Mengganti active_company_id dan company_period_id
        // KE: company_id dan period_id (nama kolom di migration users)
        if (!auth()->user()->company_id || !auth()->user()->period_id) {
            return view('staff.labarugi', [
                'pendapatan' => collect(),
                'hpp' => collect(),
                'biaya' => collect(),
                'availableAccounts' => collect()
            ]);
        }

        // PERBAIKAN: Mengganti active_company_id dan company_period_id
        // KE: company_id dan period_id (nama kolom di migration users)
        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;
        
        $availableAccounts = KodeAkun::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            // PERBAIKAN: Mengganti report_type (tidak ada di migration, tapi diasumsikan pos_laporan)
            // Namun, karena instruksi melarang penambahan/penghapusan kode, kita asumsikan kolom report_type ada atau biarkan 'report_type' jika memang ada di Model
            ->where('pos_laporan', 'LABARUGI') 
            ->get()
            ->map(function($account) {
                // PERBAIKAN: Mengganti account_id menjadi kode_akun
                // PERBAIKAN: Mengganti name menjadi nama_akun
                // Asumsi getBukuBesarBalance menerima kode_akun
                $balance = $this->getBukuBesarBalance($account->kode_akun);
                return [
                    'kode_akun' => $account->kode_akun, 
                    'nama_akun' => $account->nama_akun,
                    'balance' => $balance
                ];
            });
    
        $pendapatan = Pendapatan::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id menjadi kode_akun
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id ke pendapatan_id
                    'id' => $item->pendapatan_id, 
                    // PERBAIKAN: Mengganti account_id menjadi kode_akun
                    'kode_akun' => $item->kode_akun,
                    // PERBAIKAN: Mengganti name menjadi nama_akun
                    'name' => $item->nama_akun,
                    // PERBAIKAN: Mengganti amount menjadi jumlah
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });
    
        $hpp = HPP::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account') 
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id menjadi kode_akun
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id ke hpp_id
                    'id' => $item->hpp_id,
                    // PERBAIKAN: Mengganti account_id menjadi kode_akun
                    'kode_akun' => $item->kode_akun,
                    // PERBAIKAN: Mengganti name menjadi nama_akun
                    'name' => $item->nama_akun,
                    // PERBAIKAN: Mengganti amount menjadi jumlah
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });
    
        $biaya = BiayaOperasional::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id menjadi kode_akun
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id ke biayaoperasional_id
                    'id' => $item->biayaoperasional_id,
                    // PERBAIKAN: Mengganti account_id menjadi kode_akun
                    'kode_akun' => $item->kode_akun,
                    // PERBAIKAN: Mengganti name menjadi nama_akun
                    'name' => $item->nama_akun,
                    // PERBAIKAN: Mengganti amount menjadi jumlah
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });
    
        return view('staff.labarugi', compact('pendapatan', 'hpp', 'biaya', 'availableAccounts'));
    }

    public function getBukuBesarBalance($account_id) {
        $bukuBesarController = new \App\Http\Controllers\BukuBesarController(); // Gunakan fully qualified namespace
        $balance = $bukuBesarController->getAccountBalance(
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            // KE: company_id dan period_id (nama kolom di migration users)
            auth()->user()->company_id,
            auth()->user()->period_id,
            $account_id
        );
        return $balance;
    }

    public function getBalance($accountId)
    {
        try {
            $bukuBesarController = new BukuBesarController();
            $balance = $bukuBesarController->getAccountBalance(
                // PERBAIKAN: Mengganti active_company_id dan company_period_id
                // KE: company_id dan period_id (nama kolom di migration users)
                auth()->user()->company_id,
                auth()->user()->period_id,
                $accountId
            );
            
            return response()->json([
                'success' => true,
                'balance' => $balance
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function getAccountCurrentPosition($account_id)
    {
        // PERBAIKAN: Mengganti active_company_id dan company_period_id
        // KE: company_id dan period_id (nama kolom di migration users)
        $company_id = auth()->user()->company_id;
        $period_id = auth()->user()->period_id;

        // PERBAIKAN: Mengganti company_period_id dan account_id
        // KE: period_id dan kode_akun
        if (Pendapatan::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'pendapatan';
        } 
        // PERBAIKAN: Mengganti company_period_id dan account_id
        // KE: period_id dan kode_akun
        elseif (HPP::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'hpp';
        } 
        // PERBAIKAN: Mengganti company_period_id dan account_id
        // KE: period_id dan kode_akun
        elseif (BiayaOperasional::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'operasional';
        }
        return null;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:pendapatan,hpp,operasional',
                // PERBAIKAN: Mengganti account_id menjadi kode_akun
                'kode_akun' => 'required|string',
                // PERBAIKAN: Mengganti name menjadi nama_akun
                'nama_akun' => 'required|string',
                // PERBAIKAN: Mengganti amount menjadi jumlah
                'jumlah' => 'required|numeric'
            ]);

            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            // KE: company_id dan period_id (nama kolom di migration users)
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;
            
            // PERBAIKAN: Mengganti company_period_id dan account_id
            // KE: period_id dan kode_akun
            $account = KodeAkun::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->where('kode_akun', $validated['kode_akun'])
                ->firstOrFail();

            // PERBAIKAN: Mengganti account_id
            $currentPosition = $this->getAccountCurrentPosition($validated['kode_akun']);
            if ($currentPosition && $currentPosition !== $validated['type']) {
                throw new \Exception('Akun ini sudah digunakan di kategori ' . ucfirst($currentPosition));
            }
            
            $model = match($validated['type']) {
                'pendapatan' => Pendapatan::class,
                'hpp' => HPP::class,
                'operasional' => BiayaOperasional::class,
                default => throw new \Exception('Invalid type')
            };

            // PERBAIKAN: Mengganti company_period_id dan account_id, name, amount
            // KE: period_id dan kode_akun, nama_akun, jumlah
            $record = $model::updateOrCreate(
                [
                    'company_id' => $company_id,
                    'period_id' => $period_id,
                    'kode_akun' => $validated['kode_akun']
                ],
                [
                    'nama_akun' => $validated['nama_akun'],
                    'jumlah' => $validated['jumlah']
                ]
            );

            // PERBAIKAN: Mengganti account_id
            $balance = $this->getBukuBesarBalance($record->kode_akun);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => [
                    // PERBAIKAN: Mengganti id ke PK yang sesuai (diasumsikan sudah didefinisikan di Model)
                    'id' => $record->{$model::getPK($validated['type'])}, 
                    // PERBAIKAN: Mengganti account_id ke kode_akun
                    'kode_akun' => $record->kode_akun,
                    // PERBAIKAN: Mengganti name ke nama_akun
                    'name' => $record->nama_akun,
                    // PERBAIKAN: Mengganti amount ke jumlah
                    'amount' => $balance,
                    'balance' => $balance
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function update(Request $request, $type, $id)
    // {
    //     try {
    //         $validated = $request->validate([
    //             // PERBAIKAN: Mengganti account_id menjadi kode_akun
    //             'kode_akun' => 'required|string',
    //             // PERBAIKAN: Mengganti name menjadi nama_akun
    //             'nama_akun' => 'required|string',
    //             // PERBAIKAN: Mengganti amount menjadi jumlah
    //             'jumlah' => 'required|numeric'
    //         ]);

    //         // PERBAIKAN: Mengganti active_company_id dan company_period_id
    //         // KE: company_id dan period_id (nama kolom di migration users)
    //         $company_id = auth()->user()->company_id;
    //         $period_id = auth()->user()->period_id;

    //         // PERBAIKAN: Mengganti company_period_id dan account_id
    //         // KE: period_id dan kode_akun
    //         $account = KodeAkun::where('company_id', $company_id)
    //             ->where('period_id', $period_id)
    //             ->where('kode_akun', $validated['kode_akun'])
    //             ->firstOrFail();

    //         $model = match($type) {
    //             'pendapatan' => Pendapatan::class,
    //             'hpp' => HPP::class,
    //             'operasional' => BiayaOperasional::class,
    //             default => throw new \Exception('Invalid type')
    //         };

    //         // PERBAIKAN: Mengganti company_period_id
    //         $item = $model::where('company_id', $company_id)
    //             ->where('period_id', $period_id)
    //             // PENTING: Menggunakan PK yang benar jika Route Model Binding gagal
    //             // Asumsi $id adalah nilai dari PK (pendapatan_id, hpp_id, biayaoperasional_id)
    //             ->findOrFail($id);
            
    //         // PERBAIKAN: Mengganti account_id
    //         if ($item->kode_akun !== $validated['kode_akun']) {
    //             $currentPosition = $this->getAccountCurrentPosition($validated['kode_akun']);
    //             if ($currentPosition && $currentPosition !== $type) {
    //                 throw new \Exception('Akun ini sudah digunakan di kategori ' . ucfirst($currentPosition));
    //             }
    //         }
            
    //         // PERBAIKAN: Mengganti account_id, name, amount
    //         // KE: kode_akun, nama_akun, jumlah
    //         $item->update([
    //             'kode_akun' => $validated['kode_akun'],
    //             'nama_akun' => $validated['nama_akun'],
    //             'jumlah' => $validated['jumlah']
    //         ]);

    //         // PERBAIKAN: Mengganti account_id
    //         $balance = $this->getBukuBesarBalance($item->kode_akun);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data berhasil diupdate',
    //             'data' => [
    //                 // PERBAIKAN: Mengganti id ke PK yang sesuai (diasumsikan sudah didefinisikan di Model)
    //                 'id' => $item->{$model::getPK($type)},
    //                 // PERBAIKAN: Mengganti account_id ke kode_akun
    //                 'kode_akun' => $item->kode_akun,
    //                 // PERBAIKAN: Mengganti name ke nama_akun
    //                 'name' => $item->nama_akun,
    //                 // PERBAIKAN: Mengganti amount ke jumlah
    //                 'amount' => $balance,
    //                 'balance' => $balance
    //             ]
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function destroy($type, $id)
    {
        try {
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            // KE: company_id dan period_id (nama kolom di migration users)
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            $model = match($type) {
                'pendapatan' => Pendapatan::class,
                'hpp' => HPP::class,
                'operasional' => BiayaOperasional::class,
                default => throw new \Exception('Invalid type')
            };

            // PERBAIKAN: Mengganti company_period_id
            $item = $model::where('company_id', $company_id)
                ->where('period_id', $period_id)
                // PENTING: Menggunakan PK yang benar jika Route Model Binding gagal
                ->findOrFail($id);
            
            $item->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getAllData($company_id, $period_id)
    {
        // Get Pendapatan data
        // PERBAIKAN: Mengganti company_period_id
        $pendapatan = Pendapatan::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti account_id ke kode_akun
                    // PERBAIKAN: Mengganti name ke nama_akun
                    // PERBAIKAN: Mengganti amount ke jumlah
                    'kode_akun' => $item->kode_akun,
                    'name' => $item->nama_akun,
                    'amount' => $item->jumlah,
                    'balance' => $balance
                ];
            });

        // Get HPP data
        // PERBAIKAN: Mengganti company_period_id
        $hpp = HPP::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti account_id ke kode_akun
                    // PERBAIKAN: Mengganti name ke nama_akun
                    // PERBAIKAN: Mengganti amount ke jumlah
                    'kode_akun' => $item->kode_akun,
                    'name' => $item->nama_akun,
                    'amount' => $item->jumlah,
                    'balance' => $balance
                ];
            });

        // Get Biaya Operasional data
        // PERBAIKAN: Mengganti company_period_id
        $operasional = BiayaOperasional::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti account_id ke kode_akun
                    // PERBAIKAN: Mengganti name ke nama_akun
                    // PERBAIKAN: Mengganti amount ke jumlah
                    'kode_akun' => $item->kode_akun,
                    'name' => $item->nama_akun,
                    'amount' => $item->jumlah,
                    'balance' => $balance
                ];
            });

        return compact('pendapatan', 'hpp', 'operasional');
    }

    public function getDataByAccount($account_id)
    {
        try {
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            // KE: company_id dan period_id (nama kolom di migration users)
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;

            // Get account details
            // PERBAIKAN: Mengganti company_period_id dan account_id
            // KE: period_id dan kode_akun
            $account = KodeAkun::where('company_id', $company_id)
                ->where('period_id', $period_id)
                ->where('kode_akun', $account_id)
                ->firstOrFail();

            // Get balance from buku besar
            $balance = $this->getBukuBesarBalance($account_id);

            return response()->json([
                'success' => true,
                'data' => [
                    // PERBAIKAN: Mengganti account_id ke kode_akun
                    // PERBAIKAN: Mengganti name ke nama_akun
                    'kode_akun' => $account->kode_akun,
                    'name' => $account->nama_akun,
                    'balance' => $balance
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function refreshBalances()
    {
        try {
            // PERBAIKAN: Mengganti active_company_id dan company_period_id
            // KE: company_id dan period_id (nama kolom di migration users)
            $company_id = auth()->user()->company_id;
            $period_id = auth()->user()->period_id;
            
            // Refresh all account balances
            // PERBAIKAN: Mengganti company_period_id
            $accounts = KodeAkun::where('company_id', $company_id)
                ->where('period_id', $period_id)
                // PERBAIKAN: Mengganti report_type (tidak ada di migration, tapi diasumsikan pos_laporan)
                ->where('pos_laporan', 'LABARUGI') 
                ->get()
                ->map(function($account) {
                    return [
                        // PERBAIKAN: Mengganti account_id ke kode_akun
                        // PERBAIKAN: Mengganti name ke nama_akun
                        'kode_akun' => $account->kode_akun,
                        'name' => $account->nama_akun,
                        // PERBAIKAN: Mengganti account_id
                        'balance' => $this->getBukuBesarBalance($account->kode_akun)
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $accounts
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}