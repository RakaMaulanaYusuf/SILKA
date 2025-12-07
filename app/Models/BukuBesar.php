<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    protected $table = 'jurnal_umum';
    protected $guarded = [];
    protected $primaryKey = 'jurnalumum_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public function kodeAkun()
    {
        return $this->belongsTo(KodeAkun::class, 'kode_akun', 'kode_akun');
    }
}