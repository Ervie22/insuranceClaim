<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('file_types')->insert([

            [
                'id' => 1,
                'name' => 'H&E',
                'description' => "",
            ],
            [
                'id' => 2,
                'name' => 'HER2',
                'description' => "",
            ],
            [
                'id' => 3,
                'name' => 'Ki-67',
                'description' => "",
            ],
            [
                'id' => 4,
                'name' => 'ER',
                'description' => "",
            ],
            [
                'id' => 5,
                'name' => 'PGR',
                'description' => "",
            ]
        ]);
    }
}
