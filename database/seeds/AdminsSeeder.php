<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = Carbon::now();

    	$admins = [
            [
                'name' => 'moderator',
                'email' => 'moderator@moderator.com',
                'role' => 'moderator',
                'created_at' => $now,
                'updated_at' => $now,
                'remember_token' => Str::random(10),
                'email_verified_at' => $now,
                'password' => 
                    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
                'remember_token' => 
                    'bgWwVrmL51NJb0X1UEzAlV3ZGHEFKIjhWipv2hin7soQppx2SSPBHkYDblXQ',
                'email_verified_at' => $now,
                'password' => 
                    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
    	];

        \DB::table('users')->insert($admins);
    }
}
