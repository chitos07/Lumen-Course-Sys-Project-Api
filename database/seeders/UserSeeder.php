<?php

namespace Database\Seeders;


use App\Models\Role;
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


        $roles  = Role::all();

        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'job_title' => 'Admin',
            'password' => Hash::make('admin'),

        ]);
        $admin->roles()->attach($roles);

        $TestUser = User::create([
            'username' => 'UserTest',
            'email' => 'UserTest@Test.com',
            'job_title' => 'Test',
            'password' => Hash::make('test'),

        ]);

    }
}
