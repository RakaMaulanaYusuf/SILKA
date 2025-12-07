<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoIdGenerator;

class KodeAkun extends Model
{
    protected $table = 'kode_akun';
    protected $primaryKey = 'kodeakun_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'company_id',
        'period_id',  
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
        return $this->belongsTo(CompanyPeriod::class, 'period_id');
    }

    public function journalEntries()
    {
        return $this->hasMany(JurnalUmum::class, 'kode_akun', 'kode_akun');
    }

    use AutoIdGenerator;
    public $autoIdField = 'kodeakun_id';
    public $autoIdPrefix = 'AKN';
}