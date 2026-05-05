<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Member::updateOrCreate(
            ['email' => 'admin@tadreeb.com'], // البحث بهذا الإيميل
            [
                'username' => 'مدير النظام',
                'password' => Hash::make('admin123456'), // كلمة المرور
                'role' => 'admin', // تأكد من أن هذا العمود موجود في جدولك
            ]
        );
}
}
