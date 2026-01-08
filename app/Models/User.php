<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\AutoIdGenerator;

class User extends Authenticatable 
{
    use AutoIdGenerator;
    use HasFactory, Notifiable;
    protected $table = 'users';

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $autoIdField = 'user_id';
    public $autoIdPrefix = 'USR';
    protected $autoIdIncrementLength = 5;

    protected $fillable = [
        'nama', 'email', 'password', 'role',
        'company_id', 
        // 'assigned_company_id',
        'period_id', 
        // 'assigned_company_period_id'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole($roleName): bool
    {
        return $this->role === $roleName;
    }
    
    public function activeCompany() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // public function assignedCompany() {
    //     return $this->belongsTo(Company::class, 'assigned_company_id');
    // }

    public function activePeriod() {
        return $this->belongsTo(CompanyPeriod::class, 'period_id');
    }

    // public function assignedPeriod() {
    //     return $this->belongsTo(CompanyPeriod::class, 'assigned_company_period_id');
    // }
}