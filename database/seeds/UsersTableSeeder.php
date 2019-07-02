<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::query()->truncate();

        User::query()->create([
            'name' => 'an5dy',
            'account' => 'andyZ5',
            'password' => Hash::make(123456),
        ]);
    }
}
