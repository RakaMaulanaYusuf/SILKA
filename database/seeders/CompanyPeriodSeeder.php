<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyPeriod;
use App\Models\Company;

class CompanyPeriodSeeder extends Seeder
{
    public function run(): void
    {
        $cmp1 = Company::where('email', 'majumundur@gmail.com')->first();
        $cmp2 = Company::where('email', 'jayaabadi@gmail.com')->first();

        $data = [
            [
                'company_id' => $cmp1->company_id,
                'period_month' => 'Juli',
                'period_year' => 2025,
            ],
            [
                'company_id' => $cmp2->company_id,
                'period_month' => 'Januari',
                'period_year' => 2025,
            ],
            [
                'company_id' => $cmp2->company_id,
                'period_month' => 'Februari',
                'period_year' => 2025,
            ],
        ];

        foreach ($data as $period) {
            CompanyPeriod::create($period);
        }
    }
}