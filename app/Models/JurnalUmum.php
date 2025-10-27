<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class JurnalUmum extends Model
{
    use HasFactory;

    protected $table = 'jurnal_umum';

    protected $fillable = [
        'company_id',
        'company_period_id',
        'tanggal',
        'bukti_transaksi',
        'keterangan',
        'kode_akun',
        'kode_bantu',
        'debit',
        'credit'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
    ];

    protected $attributes = [
        'debit' => null,
        'credit' => null,
    ];

    protected $rules = [
        'tanggal' => 'required|date',
        'bukti_transaksi' => 'required|string',
        'keterangan' => 'required|string',
        'kode_akun' => 'required|string|exists:kode_akun,kode_akun',
        'kode_bantu' => 'nullable|string|exists:kode_bantu,kode_bantu',
        'debit' => 'required_without:credit|nullable|numeric|min:0',
        'credit' => 'required_without:debit|nullable|numeric|min:0',
    ];

    public function account()
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun', 'kode_akun');
    }

    public function helper()
    {
        return $this->belongsTo(KodeBantu::class, 'kode_bantu', 'kode_bantu');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function period()
    {
        return $this->belongsTo(CompanyPeriod::class, 'company_period_id');
    }

    protected function validateData($data)
    {
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}