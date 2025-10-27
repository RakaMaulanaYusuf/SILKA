<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BiayaOperasional extends Model
{
    protected $table = 'biaya_operasional';
    
    protected $fillable = [
        'company_id',
        'company_period_id',
        'kode_akun',
        'nama',
        'jumlah'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(CompanyPeriod::class, 'company_period_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun', 'kode_akun');
    }

    public function scopeTotalForCompany($query, $company_id, $period_id)
    {
        return $query->where('company_id', $company_id)
                    ->where('company_period_id', $period_id)
                    ->sum('jumlah');
    }
}