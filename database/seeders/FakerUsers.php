<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakerUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // FAKER Buat beberapa data dummy untuk tabel users
        $faker = Faker::create();
        $totalRecords = 1000;
        for ($i = 0; $i < $totalRecords; $i++) {
            try {
                User::create([
                    'id' => Str::uuid(),
                    'name' => $faker->name,
                    'username' => $faker->userName,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('user'),
                    'role' => 'user',
                    'profile_photo_path' => '/assets/img/profile/user.png',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }
}
