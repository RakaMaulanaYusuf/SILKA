<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeBantu extends Model
{
    protected $table = 'kode_bantu';
    
    protected $fillable = [
        'company_id',
        'company_period_id',  
        'kode_bantu',
        'nama_bantu',
        'status',
        'balance'
    ];

    protected $casts = [
        'status' => 'string',    
        'balance' => 'decimal:2'
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
        return $this->hasMany(JurnalUmum::class, 'kode_bantu', 'kode_bantu');
    }
}