<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'email'=>'bayu@email.com',
            'nama'=>'Ananda Bayu',
            'password'=>Hash::make('password'),
            'npp'=>'12345',
            'npp_supervisor'=>'11111'
        ]);
        
        User::create([
            'email'=>'spv@email.com',
            'nama'=>'anto',
            'password'=>Hash::make('password'),
            'npp'=>'11111',
        ]);
    }
}
