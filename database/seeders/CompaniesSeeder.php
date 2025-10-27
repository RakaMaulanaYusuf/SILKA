<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesSeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'nama'   => 'PT MAJU MUNDUR',
                'tipe'   => 'Perdagangan Umum',
                'alamat' => 'Jl. Maju No. 123, Jakarta',
                'kontak' => '0215551234',
                'email'  => 'majumundur@gmail.com',
            ],
            [
                'nama'   => 'PT JAYA ABADI',
                'tipe'   => 'Perdagangan',
                'alamat' => 'Jl. Jaya No. 456, Jakarta',
                'kontak' => '0315555678',
                'email'  => 'jayaabadi@gmail.com',
            ],
        ];

        foreach ($companies as $data) {
            Company::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
