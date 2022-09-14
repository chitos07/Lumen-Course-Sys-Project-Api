<?php

namespace Database\Seeders;


use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Course::create([
            'name' => 'php',
            'instructor_id' => 1,
            'max_student' => 12,
            'status' => 0,
            'price' => 1500.00,
            'start_date' => date("Y-m-d"),
            'end_date' => date("Y-m-d"),


        ]);

    }
}
