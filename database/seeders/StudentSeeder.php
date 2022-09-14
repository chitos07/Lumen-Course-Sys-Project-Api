<?php

namespace Database\Seeders;


use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $normal = Student::create([
            'username' => 'Ahmed',
            'email' => 'Ahmed@ahmed.com',
            'credit' => 1,
            'password' => Hash::make('Ahmed'),

        ]);

    }
}
