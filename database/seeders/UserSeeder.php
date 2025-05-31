<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nik' => '123456789',
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '2000-01-01',
            'no_hp' => '081234567890',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(60),
        ]);
    }
}
