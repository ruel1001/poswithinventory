<?php

namespace Database\Seeders\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::UpdateorCreate([
            'uuid' => Str::orderedUuid(),
            'name' => 'Rohan Customer1',
            'email' => 'rohancustomer1@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rohan'), // rohan
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('customer');

        $user = User::UpdateorCreate([
            'uuid' => Str::orderedUuid(),
            'name' => 'Rohan Customer2',
            'email' => 'rohancustomer2@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rohan'), // rohan
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('customer');

        $user = User::UpdateorCreate([
            'uuid' => Str::orderedUuid(),
            'name' => 'Rohan Admin',
            'email' => 'rohanadmin@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rohan'), // rohan
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('admin');

        $user = User::UpdateorCreate([
            'uuid' => Str::orderedUuid(),
            'name' => 'Rohan SuperAdmin',
            'email' => 'rohansuperadmin@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rohan'), // rohan
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('super-admin');
    }
}
