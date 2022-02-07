<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     AdminUserSeeder::class,
        //     UserSeeder::class,
        //     RoleSeeder::class,
        //     DoctorSeeder::class,
        //     AppointmentSeeder::class
        // ]);

        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'patient']);

        $admin = new User([
            "name" => 'Admin',
            "email" => 'admin@gmail.com',
            "email_verified_at" => now(),
            'password' => Hash::make('password'),
            'role_id' => 2,
            'gender' => 'male',
            'remember_token' => Str::random('10'),
        ]);

        $admin->save();
    }
}
