<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@gmail.com')->first();
        if (empty($user)) {
            $user = new User();
        }
        $user->first_name = 'Super';
        $user->last_name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('123456');
        $user->contact_number = '+1234567890';
        $user->status = 1;
        $user->created_by = 0;
        $user->save();
        $user->assignRole('Admin');
    }
}
