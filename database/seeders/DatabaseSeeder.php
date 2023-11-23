<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $referal_code = "";
        for ($i=0; $i < 8; $i++) { 
            $referal_code .= random_int(0, 9);
        }
        User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123'),
            'referal_code' => $referal_code,
            'role' => 'superadmin'
        ]);
        $referal_code = "";
        for ($i=0; $i < 8; $i++) { 
            $referal_code .= random_int(0, 9);
        }
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'referal_code' => $referal_code,
            'role' => 'admin'
        ]);
        $referal_code = "";
        for ($i=0; $i < 8; $i++) { 
            $referal_code .= random_int(0, 9);
        }
        User::create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
            'referal_code' => $referal_code,
            'saldo' => 500000
        ]);
        Product::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => '1',
            'title' => 'berinvestasi No.01',
            'jumlah_proyek' => 15000000,
            'keuntungan_harian' => 10,
            'jumlah_pemasukan' => 270000000,
            'siklus' => 180,
            'price' => 100000
        ]);
        Setting::create([]);
    }
}
