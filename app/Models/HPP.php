<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\AutoIdGenerator;

class HPP extends Model
{
    protected $table = 'hpp';

    protected $primaryKey = 'hpp_id'; 
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

    public function scopeTotalForCompany($query, $company_id, $period_id)
    {
        return $query->where('company_id', $company_id)
                    ->where('period_id', $period_id)
                    ->sum('jumlah');
    }

    // PENYESUAIAN: Helper untuk mendapatkan Primary Key secara dinamis di Controller
    public static function getPK($type = 'hpp')
    {
        // $type diabaikan karena ini adalah Model spesifik
        return 'hpp_id';
    }

    use AutoIdGenerator;
    public $autoIdField = 'hpp_id';
    public $autoIdPrefix = 'HPP';
}