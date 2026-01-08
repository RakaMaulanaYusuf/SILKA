<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyPeriod;
use App\Models\Company;

class CompanyPeriodSeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['email' => 'majumundur@gmail.com', 'period' => [
                ['month' => 'November', 'year' => 2025],
                ['month' => 'Desember', 'year' => 2025],
            ]],
        ];

        foreach ($companies as $companyData) {
            $company = Company::where('email', $companyData['email'])->first();
            if (!$company) continue; // safety check

            foreach ($companyData['period'] as $period) {
                CompanyPeriod::updateOrCreate(
                    [
                        'company_id'   => $company->company_id,
                        'period_month' => $period['month'],
                        'period_year'  => $period['year'],
                    ],
                    [] // data tambahan bisa kosong karena ID otomatis
                );
            }
        }
    }
}
