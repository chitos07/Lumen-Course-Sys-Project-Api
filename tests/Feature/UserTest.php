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
        $user = \App\Models\User::findOrFail(1);
        $this->actingAs($user);

        $this->json('POST','/api/admin/users',['Accept' => 'application/json'])
            ->seeJson([
                "email"    => ["The email field is required."],
                "name"     => ["The name field is required."],
                "job_title" => ["The job title field is required."],
                "password" => ["The password field is required."],


            ])->assertResponseStatus(422);
    }

    public function testRepeatPassword()
    {
        $user = \App\Models\User::findOrFail(1);
        $this->actingAs($user);

        $userData = [
            "name" => "John Doe",
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
    $this->actingAs($user);

    $this->json('GET','/api/admin/users',['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testCreateUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user);

       $data = [
           'name' => 'Ahmed2',
           'email' => 'Ahmed22@ahmed.com',
           'job_title' => 'engee',
           'password' => 'Ahmed',
           'password_confirmation' => 'Ahmed'

       ];


       $this->json('POST','/api/admin/users',$data,['Accept' => 'application/json'])->assertResponseStatus(201);
   }

   public function testShowUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user);
       $this->json('GET',"/api/admin/users/$user->id",['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testUpdateUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user);

       $updateUser = User::latest()->first();

       $data = [
           'name' => 'Ahmed2',
           'email' => 'Ahmed@ahmed.com',
           'job_title' => 'test',
           'password' => 'Ahmed',
           'password_confirmation' => 'Ahmed'

       ];

       $this->json('PUT',"/api/admin/users/$updateUser->id",$data,['Accept' => 'application/json'])->assertResponseStatus(200);

   }




public function testDeleteUser(){
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user);

    $deletedUser = User::latest()->first();
    $this->json('DELETE',"/api/admin/user/$deletedUser->id",['Accept' => 'application/json'])->assertResponseStatus(204);
}

//public function testStudentIndex()
//{
//    $user = \App\Models\User::findOrFail(1);
//    $this->actingAs($user);
//    $this->json('GET','/api/admin/student',['Accept' => 'application/json'])->assertResponseStatus(200);
//}


//   public function testShowStudent(){
//       $user = \App\Models\User::findOrFail(1);
//       $this->actingAs($user);
//
//       $studnet = Student::latest()->first();
//       $this->json('GET',"/api/admin/student/$studnet->id",['Accept' => 'application/json'])->assertResponseStatus(200);
//   }



//public function testDeleteStudent(){
//    $user = \App\Models\User::findOrFail(1);
//    $this->actingAs($user);
//
//    $deletedStudent = Student::latest()->first();
//    $this->json('DELETE',"/api/admin/student/$deletedStudent->id",['Accept' => 'application/json'])->assertResponseStatus(204);
//}


   }

