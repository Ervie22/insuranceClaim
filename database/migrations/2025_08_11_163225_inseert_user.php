<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->insert([
            [

                'first_name' => 'admin',
                'last_name' => null,
                'email' => 'admin@medaeye.com',
                'email_verified_at' => null,
                'password' => '$2y$12$w6N6yOI2oRVeUVfJugJP.uRM5LAN6xjIWUo7LaIPczIgrgrBimb0G', // bcrypt('your_password')
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

    public function down(): void
    {
        // DB::table('users')->where('id', 5)->delete();
    }
};
