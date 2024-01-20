<?php

namespace Database\Seeders;

use App\Models\Kurir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kurir::insert([
            [
                'title' => 'JNE',
                'code' => 'jne',
            ],
            [
                'title' => 'POS Indonesia',
                'code' => 'pos',
            ],
            [
                'title' => 'TIKI',
                'code' => 'tiki',
            ],
        ]);
    }
}
