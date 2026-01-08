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
        $usersData = [
            [
                'email'      => 'yusuf@gmail.com',
                'nama'       => 'Yusuf',
                'role'       => 'admin',
                'company_email' => 'majumundur@gmail.com',
                'period_month' => 'Juli',
                'period_year'  => 2025,
            ],
            [
                'email'      => 'rakamaulanayusuf@gmail.com',
                'nama'       => 'Raka Maulana Yusuf',
                'role'       => 'staff',
                'company_email' => 'majumundur@gmail.com',
                'period_month' => 'Juli',
                'period_year'  => 2025,
            ],
        ];

        foreach ($usersData as $data) {
            $company = Company::where('email', $data['company_email'])->first();
            if (!$company) continue;

            $period = CompanyPeriod::where('company_id', $company->company_id)
                        ->where('period_month', $data['period_month'])
                        ->where('period_year', $data['period_year'])
                        ->first();

            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'nama'       => $data['nama'],
                    'password'   => Hash::make('password'),
                    'role'       => $data['role'],
                    'company_id' => $company->company_id,
                    'period_id'  => $period?->period_id,
                ]
            );
        }
    }
}
