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
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Pyaesone Khant',
            'email' => 'pyaepsk@gmail.com',
            'password' => Hash::make('asdfghjkl'),
            'role' => 'admin'
        ]);
        User::factory(10)->create();
        User::factory()->create([
            'name' => 'Wooki Dooki',
            'email' => 'wookiDk2240@gmail.com',
            'password' => Hash::make('asdfghjkl')
        ]);

    }
}
