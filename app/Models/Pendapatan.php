<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\AutoIdGenerator;

class Pendapatan extends Model
{
    protected $table = 'pendapatan';

    protected $primaryKey = 'pendapatan_id'; 
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'company_id',
        'period_id',
        'kode_akun',
        'nama_akun',
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
        return $this->belongsTo(CompanyPeriod::class, 'period_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun', 'kode_akun');
    }

    public static function getPK($type = 'pendapatan')
    {
        // $type diabaikan karena ini adalah Model spesifik
        return 'pendapatan_id';
    }
    use AutoIdGenerator;
    public $autoIdField = 'pendapatan_id';
    public $autoIdPrefix = 'PDT';
}