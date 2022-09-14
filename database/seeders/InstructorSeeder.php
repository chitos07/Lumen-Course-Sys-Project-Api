<?php

namespace Database\Seeders;


use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Instructor::create([
            'name' => 'Mohsen',
            'phone' => 0112665471,
            'address'=> 'asdsadsadasdasdasd',
            'salary' => 1500.00,
            'his_specialty' => 'Web',

        ]);
    }
}
