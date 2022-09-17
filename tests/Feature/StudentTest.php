<?php
namespace Tests\Feature;


use App\Models\Subscription;
use App\Models\Student;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudentTest extends TestCase
{

    public function test_required_Fields_forCreateAndUpdate(){


        $this->json('POST','/api/students/register',['Accept' => 'application/json'])
            ->seeJson([
                "email"    => ["The email field is required."],
                "username"     => ["The username field is required."],
                "credit"   => ["The credit field is required."],
                "password" => ["The password field is required."],


            ])->assertResponseStatus(422);
    }

    public function testRepeatPassword()
    {


        $userData = [
            "username" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "credit" => 0
        ];

        $this->json('POST', '/api/students/register', $userData, ['Accept' => 'application/json'])
            ->seeJson(["password" => ["The password confirmation does not match."]])
            ->assertResponseStatus(422);
    }

   public function testCreateStudent(){
       $data = [
           'username' => 'Ahmed2',
           'email' => 'Ahmed2@yahoo.com',
           'credit' => 0,
           'password' => 'Ahmed',
           'password_confirmation' => 'Ahmed'
       ];
       $this->json('POST','/api/students/register',$data,['Accept' => 'application/json'])->assertResponseStatus(201);
   }

   public function testUpdateStudent(){

       $student = Student::findOrFail(1);
       $this->actingAs($student,'student_api');
       $updatedStudent = Student::latest()->first();

       $data = [
           'username' => 'Hossam3',
           'email' => 'Hossam222@yahoo.com',
           'credit' => 0,
           'password' => 'Ahmed',
           'password_confirmation' => 'Ahmed'

       ];
       $this->json('PUT',"/api/students/$updatedStudent->id",$data,['Accept' => 'application/json'])->assertResponseStatus(200);

   }

    public function testsubscriptions(){
        $student = Student::findOrFail(1);
        $this->actingAs($student,'student_api');
        $this->json('GET',"/api/students/1/subscriptions",['Accept' => 'application/json'])->assertResponseStatus(200);

    }

    public function testSubscribeToCourse(){
        $student = Student::findOrFail(1);
        $this->actingAs($student,'student_api');

        $data = [
            'studentName' => 'Chitos',
            'courseName' => 'php',
            'price'   =>  5000,
            'startDate' => '2022-08-25',
            'endDate'  => '2022-10-25',
            'status' => 'on'
        ];
        $this->json('POST',"/api/students/1/subscribe",$data,['Accept' => 'application/json'])->assertResponseStatus(200);
    }



//    public function testUnSubscribe(){
//        $student = Student::findOrFail(1);
//        $this->actingAs($student,'student_api');
//        $booke = Subscription::latest()->first();
//        $this->json('DELETE',"/api/students/$booke->id/unsubscribe",['Accept' => 'application/json'])->assertResponseStatus(204);
//
//    }

   }

