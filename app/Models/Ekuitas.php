<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\AutoIdGenerator;

class Ekuitas extends Model
{
    use AutoIdGenerator;
    protected $table = 'ekuitas';

    protected $primaryKey = 'ekuitas_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $autoIdField = 'ekuitas_id';
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

        return 'EKT' . $year . $month . $companyNumber;
    }
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

    public static function getPK($type = 'ekuitas')
    {
        return 'ekuitas_id';
    }
}