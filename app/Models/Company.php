<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoIdGenerator;

class Company extends Model
{
    //Generate costum id
    use AutoIdGenerator;
    protected $primaryKey = 'company_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'company';

    
    public $autoIdField = 'company_id';
    public $autoIdPrefix = 'CMP';
    protected $fillable = [
        'company_id',
        'nama',
        'tipe', 
        'alamat',
        'kontak',
        'email',
        'status'
    ];

    public function periods()
    {
        return $this->hasMany(CompanyPeriod::class, 'company_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    // Relasi untuk viewers yang di-assign ke company ini
    // public function assignedViewers()
    // {
    //     return $this->hasMany(User::class, 'assigned_company_id')->where('role', 'viewer');
    // }

    // Scope untuk mendapatkan companies dengan viewer yang sudah di-assign
    // public function scopeWithAssignedViewers($query)
    // {
    //     return $query->with('assignedViewers');
    // }

    // Accessor untuk mendapatkan jumlah viewer yang di-assign
    // public function getAssignedViewersCountAttribute()
    // {
    //     return $this->assignedViewers()->count();
    // }

    // Accessor untuk status yang lebih readable
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    
}