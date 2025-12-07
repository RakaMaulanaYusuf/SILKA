<?php

namespace App\Http\Controllers;

use App\Models\KodeAkun;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KodeAkunController extends Controller
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
            return view('staff.kodeakun', ['accounts' => collect()]);
        }

        $accounts = KodeAkun::where('company_id', auth()->user()->company_id)
            ->where('period_id', auth()->user()->period_id)
            ->orderBy('kode_akun')
            ->get();
            
        return view('staff.kodeakun', compact('accounts'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_akun' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        $exists = KodeAkun::where('company_id', auth()->user()->company_id)
                            ->where('period_id', auth()->user()->period_id)
                            ->where('kode_akun', $value)
                            ->exists();
                        
                        if ($exists) {
                            $fail('Kode akun sudah digunakan dalam periode ini.');
                        }
                    },
                ],
                'nama_akun' => 'required|string',
                'tabel_bantuan' => 'nullable|string',
                'pos_saldo' => 'required|in:DEBIT,CREDIT',
                'pos_laporan' => 'required|in:NERACA,LABARUGI',
                'debit' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->pos_saldo === 'CREDIT' && !empty($value)) {
                            $fail('Kolom debit harus kosong ketika pos saldo CREDIT.');
                        }
                    },
                ],
                'credit' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->pos_saldo === 'DEBIT' && !empty($value)) {
                            $fail('Kolom kredit harus kosong ketika pos saldo DEBIT.');
                        }
                    },
                ],
            ]);

            $validated['company_id'] = auth()->user()->company_id;
            $validated['period_id'] = auth()->user()->period_id;
            
            // Set the unused field to null based on pos_saldo
            if ($validated['pos_saldo'] === 'DEBIT') {
                $validated['credit'] = null;
                $validated['debit'] = $validated['debit'] ?? 0;
            } else {
                $validated['debit'] = null;
                $validated['credit'] = $validated['credit'] ?? 0;
            }
            
            $kodeAkun = KodeAkun::create($validated);
            
            return response()->json([
                'success' => true,
                'account' => $kodeAkun
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving kode akun: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, KodeAkun $kodeAkun)
    {
        if ($kodeAkun->company_id !== auth()->user()->company_id || 
            $kodeAkun->period_id !== auth()->user()->period_id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // --- VALIDASI REMAINS THE SAME ---
        $validated = $request->validate([
            'kode_akun' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($kodeAkun) {
                    $exists = KodeAkun::where('company_id', auth()->user()->company_id)
                        ->where('period_id', auth()->user()->period_id)
                        ->where('kode_akun', $value)
                        ->where('kodeakun_id', '!=', $kodeAkun->kodeakun_id) 
                        ->exists();
                    
                    if ($exists) {
                        $fail('Kode akun sudah digunakan dalam periode ini.');
                    }
                },
            ],
            'nama_akun' => 'required|string',
            'tabel_bantuan' => 'nullable|string',
            'pos_saldo' => 'required|in:DEBIT,CREDIT',
            'pos_laporan' => 'required|in:NERACA,LABARUGI',
            'debit' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->pos_saldo === 'CREDIT' && !empty($value)) {
                        $fail('Kolom debit harus kosong ketika pos saldo CREDIT.');
                    }
                },
            ],
            'credit' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->pos_saldo === 'DEBIT' && !empty($value)) {
                        $fail('Kolom kredit harus kosong ketika pos saldo DEBIT.');
                    }
                },
            ],
        ]);
        // --- END VALIDASI ---

        if ($validated['pos_saldo'] === 'DEBIT') {
            $validated['credit'] = null;
            $validated['debit'] = $validated['debit'] ?? 0;
        } else {
            $validated['debit'] = null;
            $validated['credit'] = $validated['credit'] ?? 0;
        }

        $kodeAkun->update($validated);
        
        return response()->json([
            'success' => true,
            'account' => $kodeAkun
        ]);
    }

    public function destroy(KodeAkun $kodeAkun)
    {
        if ($kodeAkun->company_id !== auth()->user()->company_id || 
            $kodeAkun->period_id !== auth()->user()->period_id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $kodeAkun->delete();
        
        return response()->json(['success' => true]);
    }

    public function downloadPDF()
    {
        $accounts = KodeAkun::where('company_id', auth()->user()->company_id)
            ->where('period_id', auth()->user()->period_id)
            ->orderBy('kode_akun')
            ->get();

        $data = [
            'title' => 'Daftar Kode Akun',
            'companyName' => auth()->user()->company->nama ?? 'Perusahaan', 
            'headers' => [
                'Kode Akun', 
                'Nama Akun', 
                'Tabel Bantuan', 
                'Pos Saldo', 
                'Pos Laporan', 
                'Debet', 
                'Kredit'
            ],
            'data' => $accounts->map(function($account) {
                return [
                    $account->kode_akun,
                    $account->nama_akun,
                    $account->tabel_bantuan ?? '-',
                    $account->pos_saldo,
                    $account->pos_laporan,
                    $account->pos_saldo == 'DEBIT' ? number_format($account->debit, 2) : '-',
                    $account->pos_saldo == 'CREDIT' ? number_format($account->credit, 2) : '-'
                ];
            }),
            'totals' => [
                number_format($accounts->sum('debit'), 2),
                number_format($accounts->sum('credit'), 2)
            ]
        ];

        $pdf = PDF::loadView('pdf_template', $data);

        return $pdf->download('Daftar_Kode_Akun_' . date('YmdHis') . '.pdf');
    }
}