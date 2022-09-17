<?php
namespace Tests\Feature;
use App\Models\Student;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{


    public function test_required_Fields_forCreateAndUpdate(){
        $user = User::findOrFail(1);
        $this->actingAs($user,'admin_api');

        $this->json('POST','/api/admin/users',['Accept' => 'application/json'])
            ->seeJson([
                "email"    => ["The email field is required."],
                "username"     => ["The username field is required."],
                "job_title" => ["The job title field is required."],
                "password" => ["The password field is required."],


            ])->assertResponseStatus(422);
    }

    public function testRepeatPassword()
    {
        $user = \App\Models\User::findOrFail(1);
        $this->actingAs($user,'admin_api');

        $userData = [
            "username" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "job_title" => "Admin"
        ];

        $this->json('POST', '/api/admin/users', $userData, ['Accept' => 'application/json'])
            ->seeJson(["password" => ["The password confirmation does not match."]])
            ->assertResponseStatus(422);
    }

   public function testUserIndex()
   {
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user,'admin_api');

    $this->json('GET','/api/admin/users',['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testCreateUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user,'admin_api');

       $data = [
           'username' => 'Ahmed2',
           'email' => 'Ahmed22@ahmed.com',
           'job_title' => 'engee',
           'password' => 'Ahmed',
           'password_confirmation' => 'Ahmed'

       ];

       $this->json('POST','/api/admin/users',$data,['Accept' => 'application/json'])->assertResponseStatus(201);
   }

   public function testShowUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user,'admin_api');
       $this->json('GET',"/api/admin/users/$user->id",['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testUpdateUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user,'admin_api');

       $updateUser = User::latest()->first();

       $data = [
           'username' => 'Hossam',
           'email' => 'Ahmed@ahmed.com',
           'job_title' => 'test',
           'password' => 'Ahmed',
           'password_confirmation' => 'Ahmed'

       ];

       $this->json('PUT',"/api/admin/users/$updateUser->id",$data,['Accept' => 'application/json'])->assertResponseStatus(200);

   }




public function testDeleteUser(){
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user,'admin_api');

    $deletedUser = User::latest()->first();
    $this->json('DELETE',"/api/admin/users/$deletedUser->id",['Accept' => 'application/json'])->assertResponseStatus(204);
}

public function testStudentIndex()
{
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user,'admin_api');
    $this->json('GET','/api/admin/students',['Accept' => 'application/json'])->assertResponseStatus(200);
}

   }

