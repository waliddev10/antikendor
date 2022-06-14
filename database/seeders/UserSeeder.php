<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'nama' => 'Muhammad Fadjri',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('@dmin'),
            'nip' => '200008062022011001',
            'jabatan' => 'Pengelola Layanan Operasional',
            'email_verified_at' => Carbon::now()->format('Y-m-d'),
            'role' => 'admin',
            'remember_token' => null,
        ]);
    }
}
