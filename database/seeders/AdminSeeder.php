<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'username' => 'Super Admin',
            'email'    => 'admin@tadreeb.com',
            'password' => Hash::make('admin'), // تشفير كلمة السر ضروري جداً
            'role'     => 'admin', // الرول التي ستستخدمها في الـ Switch
        ]);
    }
}
