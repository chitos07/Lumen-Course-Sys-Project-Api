<?php
namespace Tests\Feature;
use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class AuthenticationTest extends TestCase
{

    public function test_required_Fields_for_login(){
        $this->json('POST','/api/admins/login',['Accept' => 'application/json'])
            ->seeJson([
                "email"    => ["The email field is required."],
                "password" => ["The password field is required."],

            ])->assertResponseStatus(422);
    }

    /**
     * Test The Login Method nd json response
     */
    public function test_admin_login()
    {

       $this->json('POST','/api/admins/login',['email' => 'admin@admin.com','password' => 'admin'])->assertResponseStatus(200);

    }

    public function test_required_Fields_for_student_login(){
        $this->json('POST','/api/students/login',['Accept' => 'application/json'])
            ->seeJson([
                "email"    => ["The email field is required."],
                "password" => ["The password field is required."],

            ])->assertResponseStatus(422);
    }

    /**
     * Test The Login Method nd json response
     */
    public function test_student_login()
    {

        $this->json('POST','/api/students/login',['email' => 'Ahmed@ahmed.com','password' => 'Ahmed'])->assertResponseStatus(200);

    }
}

