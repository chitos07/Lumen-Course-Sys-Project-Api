<?php

namespace Database\Seeders;


use App\Models\Role;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role' => 'user.index']);
        Role::create(['role' => 'user.store']);
        Role::create(['role' => 'user.show']);
        Role::create(['role' => 'user.update']);
        Role::create(['role' => 'user.destroy']);
        Role::create(['role' => 'role.index']);
        Role::create(['role' => 'role.show']);
        Role::create(['role' => 'role.update']);
        Role::create(['role' => 'role.store']);
        Role::create(['role' => 'role.destroy']);
        Role::create(['role' => 'instructor.index']);
        Role::create(['role' => 'instructor.show']);
        Role::create(['role' => 'instructor.store']);
        Role::create(['role' => 'instructor.update']);
        Role::create(['role' => 'instructor.destroy']);
        Role::create(['role' => 'course.index']);
        Role::create(['role' => 'course.show']);
        Role::create(['role' => 'course.store']);
        Role::create(['role' => 'course.update']);
        Role::create(['role' => 'course.destroy']);
        Role::create(['role' => 'student.show']);
        Role::create(['role' => 'student.index']);
        Role::create(['role' => 'student.destroy']);
        Role::create(['role' => 'booking.index']);
        Role::create(['role' => 'booking.update']);
        Role::create(['role' => 'booking.destroy']);

    }
}
