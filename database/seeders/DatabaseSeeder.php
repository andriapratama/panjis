<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "test",
            'email' => 'test@mail.com',
            'password' => Hash::make('12345678'),
            'level' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('members')->insert([
            'nik'   => "1234567890123456",
            'full_name' => "wowok",
            'address'   => 'klungkung',
            'phone_number'  => '123456789012',
            'gender'    => 'laki-laki',
            'created_at' => Carbon::now()->format('Y-m-d'),
            'updated_at' => Carbon::now()->format('Y-m-d'),
        ]);

        DB::table('members')->insert([
            'nik'   => "1234567890123456",
            'full_name' => "bagus",
            'address'   => 'klungkung',
            'phone_number'  => '123456789012',
            'gender'    => 'laki-laki',
            'created_at' => Carbon::now()->format('Y-m-d'),
            'updated_at' => Carbon::now()->format('Y-m-d'),
        ]);
    }
}
