<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VisitorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visitors')->insert([
            ['name' => 'Maul', 'visit_date' => '2024-11-08', 'contact' => '081234567890'],
            ['name' => 'Capunk', 'visit_date' => '2024-11-18', 'contact' => '089876543210'],
        ]);
    }
}
