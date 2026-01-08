<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Traits\AutoIdGenerator;

class JurnalUmum extends Model
{
    use HasFactory;
    use AutoIdGenerator;
    protected $table = 'jurnal_umum';

    protected $primaryKey = 'jurnalumum_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $autoIdField = 'jurnalumum_id';
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

        return 'JUR' . $year . $month . $companyNumber;
    }
    protected $fillable = [
        'company_id',
        'period_id',
        'tanggal',
        'bukti_transaksi',
        'keterangan',
        'kode_akun',
        'kode_bantu',
        'debit',
        'credit'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
    ];

    protected $attributes = [
        'debit' => null,
        'credit' => null,
    ];

    protected $rules = [
        'tanggal' => 'required|date',
        'bukti_transaksi' => 'required|string',
        'keterangan' => 'required|string',
        'kode_akun' => 'required|string|exists:kode_akun,kode_akun',
        'kode_bantu' => 'nullable|string|exists:kode_bantu,kode_bantu',
        'debit' => 'required_without:credit|nullable|numeric|min:0',
        'credit' => 'required_without:debit|nullable|numeric|min:0',
    ];

    public function account()
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun', 'kode_akun');
    }

    public function helper()
    {
        return $this->belongsTo(KodeBantu::class, 'kode_bantu', 'kode_bantu');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function period()
    {
        return $this->belongsTo(CompanyPeriod::class, 'period_id');
    }

    protected function validateData($data)
    {
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}