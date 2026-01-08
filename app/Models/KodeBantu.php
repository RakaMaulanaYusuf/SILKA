<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoIdGenerator;

class KodeBantu extends Model
{
    use AutoIdGenerator;
    protected $table = 'kode_bantu';

    protected $primaryKey = 'kodebantu_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $autoIdField = 'kodebantu_id';
    protected $autoIdIncrementLength = 5; // 5 digit terakhir
    public function getAutoIdPrefix()
    {
        $period = $this->period;

        $year  = substr($period->period_year, -2);

        $monthIndex = array_search($period->period_month, [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ]) + 1;

        $month = str_pad($monthIndex, 2, '0', STR_PAD_LEFT);

        $companyNumber = substr($period->company_id, 3);

        return 'BNT' . $year . $month . $companyNumber;
    }
    
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
}