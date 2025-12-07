<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoIdGenerator;

class KodeBantu extends Model
{
    protected $table = 'kode_bantu';
    protected $primaryKey = 'kodebantu_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'company_id',
        'period_id',  
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
        return $this->belongsTo(CompanyPeriod::class, 'period_id');
    }

    public function journalEntries()
    {
        return $this->hasMany(JurnalUmum::class, 'kode_bantu', 'kode_bantu');
    }

    use AutoIdGenerator;
    public $autoIdField = 'kodebantu_id';
    public $autoIdPrefix = 'BTN';
}