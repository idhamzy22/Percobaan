<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BorrowingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('borrowings')->insert([
            [
                'visitor_id' => 1, 
                'name' => 'Maul', 
                'book_id' => 1, 
                'borrow_date' => '2024-11-08', 
                'return_date' => '2024-11-20', 
                'late_fees' => 90000.00,
            ],
            [
                'visitor_id' => 2, 
                'name' => 'Capunk', 
                'book_id' => 2, 
                'borrow_date' => '2024-11-18', 
                'return_date' => '2024-11-19', 
                'late_fees' => 50000.00,
            ],
        ]);
    }
}
