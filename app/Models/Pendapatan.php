<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendapatan extends Model
{
    protected $table = 'pendapatan';
    
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
}