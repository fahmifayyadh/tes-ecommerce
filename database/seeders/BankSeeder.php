<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create([
            'name' => 'BCA',
            'owner' => 'Saifudin Ghozali',
            'rekening' => '3546587934'
        ]);
        Bank::create([
            'name' => 'BNI',
            'owner' => 'Rozaq Komarudin',
            'rekening' => '23326923874'
        ]);
    }
}
