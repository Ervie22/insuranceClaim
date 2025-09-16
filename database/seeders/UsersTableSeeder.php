<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 3,
                'first_name' => 'vijay',
                'last_name' => 'range',
                'email' => 'ecvijay08@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$67szG.u2C/rH3gTOTlvvJOzITrHN7A/XZRlK2dc8z2o5WcqOTNf9K',
                'roles' => 'consumers',
                'remember_token' => null,
                'mobile' => '9176066556',
                'address1' => 'sddaf',
                'address2' => 'r',
                'city' => 'ELIMBAH',
                'state' => 'Tamil Nadu',
                'zip' => '612901',
                'country' => 'India',
                'profile_image_path' => null,
                'active' => '1',
                'created_at' => Carbon::parse('2025-05-08 09:16:12'),
                'updated_at' => Carbon::parse('2025-05-08 09:16:12'),
            ],
            [
                'id' => 5,
                'first_name' => 'admin',
                'last_name' => null,
                'email' => 'admin@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$K.cXChFjrlPLGokB/EtyS.TqYSIqw/A7s3ERLAt6ZqdlisE234zvu',
                'roles' => 'admin',
                'remember_token' => null,
                'mobile' => null,
                'address1' => null,
                'address2' => null,
                'city' => null,
                'state' => null,
                'zip' => null,
                'country' => null,
                'profile_image_path' => null,
                'active' => '1',
                'created_at' => Carbon::parse('2025-05-08 19:09:27'),
                'updated_at' => Carbon::parse('2025-05-08 19:09:27'),
            ]
        ]);
    }
}
