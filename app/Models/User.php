<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    use HasFactory, Notifiable;
    protected $fillable = [
        'nama', 'email', 'password', 'role',
        'active_company_id', 
        // 'assigned_company_id',
        'company_period_id', 'assigned_company_period_id'
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
        return $this->belongsTo(Company::class, 'active_company_id');
    }

    // public function assignedCompany() {
    //     return $this->belongsTo(Company::class, 'assigned_company_id');
    // }

    public function activePeriod() {
        return $this->belongsTo(CompanyPeriod::class, 'company_period_id');
    }

    public function assignedPeriod() {
        return $this->belongsTo(CompanyPeriod::class, 'assigned_company_period_id');
    }

    //Generate costum id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $lastUser = self::orderBy('user_id', 'desc')->first();
            $lastNumber = $lastUser ? (int) substr($lastUser->user_id, 3) : 0;
            $newNumber = $lastNumber + 1;

            $user->user_id = 'USR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }
}