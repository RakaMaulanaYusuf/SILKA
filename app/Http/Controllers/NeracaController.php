<?php

namespace App\Http\Controllers;

use App\Models\AktivaLancar;
use App\Models\AktivaTetap;
use App\Models\Kewajiban;
use App\Models\Ekuitas;
use App\Models\KodeAkun;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NeracaController extends Controller
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
            return view('staff.neraca', [
                'aktivalancar' => collect(),
                'aktivatetap' => collect(),
                'kewajiban' => collect(),
                'ekuitas' => collect(),
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
            // PERBAIKAN: Mengganti report_type (asumsi pos_laporan di KodeAkun)
            ->where('pos_laporan', 'NERACA')
            ->get()
            ->map(function($account) {
                // PERBAIKAN: Mengganti account_id dan name
                // KE: kode_akun dan nama_akun
                $balance = $this->getBukuBesarBalance($account->kode_akun);
                return [
                    'kode_akun' => $account->kode_akun, 
                    'nama_akun' => $account->nama_akun,
                    'balance' => $balance
                ];
            });
    
        $aktivalancar = AktivaLancar::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id, account_id, name, jumlah
                    'id' => $item->aktivalancar_id,
                    'kode_akun' => $item->kode_akun,
                    'nama_akun' => $item->nama_akun,
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });
    
        $aktivatetap = AktivaTetap::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account') 
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id, account_id, name, jumlah
                    'id' => $item->aktivatetap_id,
                    'kode_akun' => $item->kode_akun,
                    'nama_akun' => $item->nama_akun,
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });
    
        $kewajiban = Kewajiban::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id, account_id, name, jumlah
                    'id' => $item->kewajiban_id,
                    'kode_akun' => $item->kode_akun,
                    'nama_akun' => $item->nama_akun,
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });

        $ekuitas = Ekuitas::where('company_id', $company_id)
            // PERBAIKAN: Mengganti company_period_id
            ->where('period_id', $period_id)
            ->with('account')
            ->get()
            ->map(function($item) {
                // PERBAIKAN: Mengganti account_id
                $balance = $this->getBukuBesarBalance($item->kode_akun);
                return [
                    // PERBAIKAN: Mengganti id, account_id, name, jumlah
                    'id' => $item->ekuitas_id,
                    'kode_akun' => $item->kode_akun,
                    'nama_akun' => $item->nama_akun,
                    'jumlah' => $item->jumlah,
                    'balance' => $balance
                ];
            });
    
        return view('staff.neraca', compact('aktivalancar', 'aktivatetap', 'kewajiban', 'ekuitas', 'availableAccounts'));
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
        if (AktivaLancar::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'aktivalancar';
        } 
        // PERBAIKAN: Mengganti company_period_id dan account_id
        // KE: period_id dan kode_akun
        elseif (AktivaTetap::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'aktivatetap';
        } 
        // PERBAIKAN: Mengganti company_period_id dan account_id
        // KE: period_id dan kode_akun
        elseif (Kewajiban::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'kewajiban';
        } 
        // PERBAIKAN: Mengganti company_period_id dan account_id
        // KE: period_id dan kode_akun
        elseif (Ekuitas::where('company_id', $company_id)
            ->where('period_id', $period_id)
            ->where('kode_akun', $account_id)
            ->exists()) {
            return 'ekuitas';
        }
        return null;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:aktivalancar,aktivatetap,kewajiban,ekuitas',
                // PERBAIKAN: Mengganti account_id menjadi kode_akun
                'kode_akun' => 'required|string',
                // PERBAIKAN: Mengganti name menjadi nama_akun
                'nama_akun' => 'required|string',
                // PERBAIKAN: Mengganti jumlah menjadi jumlah
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
                'aktivalancar' => AktivaLancar::class,
                'aktivatetap' => AktivaTetap::class,
                'kewajiban' => Kewajiban::class,
                'ekuitas' => Ekuitas::class,
                default => throw new \Exception('Invalid type')
            };

            // PERBAIKAN: Mengganti company_period_id, account_id, name, jumlah
            // KE: period_id, kode_akun, nama_akun, jumlah
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
                    // PERBAIKAN: Mengganti id, account_id, name, jumlah
                    'id' => $record->{$model::getPK($validated['type'])},
                    'kode_akun' => $record->kode_akun,
                    'nama_akun' => $record->nama_akun,
                    'jumlah' => $balance,
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
    //             // PERBAIKAN: Mengganti jumlah menjadi jumlah
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
    //             'aktivalancar' => AktivaLancar::class,
    //             'aktivatetap' => AktivaTetap::class,
    //             'kewajiban' => Kewajiban::class,
    //             'ekuitas' => Ekuitas::class,
    //             default => throw new \Exception('Invalid type')
    //         };

    //         // PERBAIKAN: Mengganti company_period_id
    //         $item = $model::where('company_id', $company_id)
    //             ->where('period_id', $period_id)
    //             ->findOrFail($id);
            
    //         // PERBAIKAN: Mengganti account_id
    //         if ($item->kode_akun !== $validated['kode_akun']) {
    //             $currentPosition = $this->getAccountCurrentPosition($validated['kode_akun']);
    //             if ($currentPosition && $currentPosition !== $type) {
    //                 throw new \Exception('Akun ini sudah digunakan di kategori ' . ucfirst($currentPosition));
    //             }
    //         }
            
    //         // PERBAIKAN: Mengganti account_id, name, jumlah
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
    //                 // PERBAIKAN: Mengganti id, account_id, name, jumlah
    //                 'id' => $item->{$model::getPK($type)},
    //                 'kode_akun' => $item->kode_akun,
    //                 'nama_akun' => $item->nama_akun,
    //                 'jumlah' => $balance,
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
                'aktivalancar' => AktivaLancar::class,
                'aktivatetap' => AktivaTetap::class,
                'kewajiban' => Kewajiban::class,
                'ekuitas' => Ekuitas::class,
                default => throw new \Exception('Invalid type')
            };

            // PERBAIKAN: Mengganti company_period_id
            $item = $model::where('company_id', $company_id)
                ->where('period_id', $period_id)
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
        $data = [
            'aktivalancar' => AktivaLancar::where('company_id', $company_id)
                // PERBAIKAN: Mengganti company_period_id
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) {
                    // PERBAIKAN: Mengganti account_id, name, jumlah
                    // KE: kode_akun, nama_akun, jumlah
                    $balance = $this->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->nama_akun,
                        'jumlah' => $item->jumlah,
                        'balance' => $balance
                    ];
                }),

            'aktivatetap' => AktivaTetap::where('company_id', $company_id)
                // PERBAIKAN: Mengganti company_period_id
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) {
                    // PERBAIKAN: Mengganti account_id, name, jumlah
                    // KE: kode_akun, nama_akun, jumlah
                    $balance = $this->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->nama_akun,
                        'jumlah' => $item->jumlah,
                        'balance' => $balance
                    ];
                }),

            'kewajiban' => Kewajiban::where('company_id', $company_id)
                // PERBAIKAN: Mengganti company_period_id
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) {
                    // PERBAIKAN: Mengganti account_id, name, jumlah
                    // KE: kode_akun, nama_akun, jumlah
                    $balance = $this->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->nama_akun,
                        'jumlah' => $item->jumlah,
                        'balance' => $balance
                    ];
                }),

            'ekuitas' => Ekuitas::where('company_id', $company_id)
                // PERBAIKAN: Mengganti company_period_id
                ->where('period_id', $period_id)
                ->with('account')
                ->get()
                ->map(function($item) {
                    // PERBAIKAN: Mengganti account_id, name, jumlah
                    // KE: kode_akun, nama_akun, jumlah
                    $balance = $this->getBukuBesarBalance($item->kode_akun);
                    return [
                        'kode_akun' => $item->kode_akun,
                        'nama_akun' => $item->nama_akun,
                        'jumlah' => $item->jumlah,
                        'balance' => $balance
                    ];
                })
        ];
    
        return $data;
    }
}