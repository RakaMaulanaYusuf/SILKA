<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeAkun extends Model
{
    protected $table = 'kode_akun';
    
    protected $fillable = [
        'company_id',
        'company_period_id',  
        'kode_akun',
        'nama_akun',
        'tabel_bantuan',
        'pos_saldo',
        'pos_laporan',
        'debit',
        'credit'
    ];

    protected $casts = [
        'pos_saldo' => 'string',
        'pos_laporan' => 'string',
        'debit' => 'decimal:2',
        'credit' => 'decimal:2'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function period()
    {
        return $this->belongsTo(CompanyPeriod::class, 'company_period_id');
    }

    public function journalEntries()
    {
        return $this->hasMany(JurnalUmum::class, 'kode_akun', 'kode_akun');
    }
}