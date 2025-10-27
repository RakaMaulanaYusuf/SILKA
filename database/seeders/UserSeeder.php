<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyPeriod;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $cmp1 = Company::where('email', 'majumundur@gmail.com')->first();
        $prd1 = CompanyPeriod::where('company_id', $cmp1->company_id)->first();

        User::updateOrCreate(
            ['email' => 'yusuf@gmail.com'],
            [
                'nama' => 'Yusuf',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'company_id' => $cmp1->company_id,
                'period_id' => $prd1?->period_id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'rakamaulanayusuf@gmail.com'],
            [
                'nama' => 'Raka Maulana Yusuf',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'company_id' => $cmp1->company_id,
                'period_id' => $prd1?->period_id,
            ]
        );
    }
}
