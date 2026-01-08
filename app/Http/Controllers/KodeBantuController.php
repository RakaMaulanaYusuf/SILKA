<?php

namespace App\Http\Controllers;

use App\Models\KodeBantu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KodeBantuController extends Controller
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

    public function index()
    {
        if (!auth()->user()->company_id || !auth()->user()->period_id) {
            return view('staff.kodebantu', ['accounts' => collect()]);
        }

        $accounts = KodeBantu::where('company_id', auth()->user()->company_id)
            ->where('period_id', auth()->user()->period_id)
            ->orderBy('kode_bantu')
            ->get();
            
        return view('staff.kodebantu', compact('accounts'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_bantu' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        $exists = KodeBantu::where('company_id', auth()->user()->company_id)
                            ->where('period_id', auth()->user()->period_id)
                            ->where('kode_bantu', $value)
                            ->exists();
                        
                        if ($exists) {
                            $fail('Kode bantu sudah digunakan dalam periode ini.');
                        }
                    },
                ],
                'nama_bantu' => 'required|string',
                'status' => 'required|in:PIUTANG,HUTANG',
                'balance' => 'nullable|numeric|min:0'
            ]);

            $validated['company_id'] = auth()->user()->company_id;
            $validated['period_id'] = auth()->user()->period_id;
            
            // Set default value 0 if balance is empty
            $validated['balance'] = $validated['balance'] ?? 0;
            
            $kodeBantu = KodeBantu::create($validated);
            
            return response()->json([
                'success' => true,
                'account' => $kodeBantu
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving kode bantu: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, KodeBantu $kodeBantu)
{
    // 1. Otorisasi: Pastikan data milik perusahaan dan periode yang aktif
    if ($kodeBantu->company_id !== auth()->user()->company_id || 
        $kodeBantu->period_id !== auth()->user()->period_id) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    // 2. Validasi
    $validated = $request->validate([
        'kode_bantu' => [
            'required',
            'string',
            function ($attribute, $value, $fail) use ($kodeBantu) {
                // Cek keunikan kode_bantu dalam lingkup company dan period yang sama
                $exists = KodeBantu::where('company_id', auth()->user()->company_id)
                    ->where('period_id', auth()->user()->period_id)
                    ->where('kode_bantu', $value)
                    ->where('kodebantu_id', '!=', $kodeBantu->kodebantu_id) // Pastikan ID primary key benar
                    ->exists();
                
                if ($exists) {
                    $fail('Kode bantu sudah digunakan dalam periode ini.');
                }
            },
        ],
        'nama_bantu' => 'required|string|max:255',
        'status'     => 'required|in:PIUTANG,HUTANG',
        'balance'    => 'nullable|numeric|min:0'
    ]);

    // 3. Sinkronisasi Data (Clean up)
    // Pastikan balance selalu angka (0 jika kosong)
    $validated['balance'] = $validated['balance'] ?? 0;

    // Tambahan Keamanan: Pastikan data tidak pindah company/period saat update
    $validated['company_id'] = auth()->user()->company_id;
    $validated['period_id'] = auth()->user()->period_id;

    // 4. Eksekusi Update
    $kodeBantu->update($validated);
    
    return response()->json([
        'success' => true,
        'message' => 'Kode Bantu berhasil diperbarui',
        'account' => $kodeBantu->fresh() // Mengambil data terbaru dari database
    ]);
}

    public function destroy(KodeBantu $kodeBantu)
    {
        if ($kodeBantu->company_id !== auth()->user()->company_id || 
            $kodeBantu->period_id !== auth()->user()->period_id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $kodeBantu->delete();
        
        return response()->json(['success' => true]);
    }

    public function downloadPDF()
    {
        $accounts = KodeBantu::where('company_id', auth()->user()->company_id)
            ->where('period_id', auth()->user()->period_id)
            ->orderBy('kode_bantu')
            ->get();

        $data = [
            'title' => 'Daftar Kode Bantu',
            'companyName' => auth()->user()->company->nama ?? 'Perusahaan',
            'headers' => [
                'Kode Bantu',
                'Nama',
                'Status',
                'Saldo Awal'
            ],
            'data' => $accounts->map(function($account) {
                return [
                    $account->kode_bantu,
                    $account->nama_bantu,
                    $account->status,
                    number_format($account->balance, 2)
                ];
            }),
            'totals' => [
                number_format($accounts->sum('balance'), 2)
            ]
        ];

        $pdf = PDF::loadView('pdf_template', $data);

        return $pdf->download('Daftar_Kode_Bantu_' . date('YmdHis') . '.pdf');
    }
}