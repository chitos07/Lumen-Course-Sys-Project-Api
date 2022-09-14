<?php
namespace Tests\Feature;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{


    public function test_required_Fields_forCreateAndUpdate(){
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $this->json('POST','/api/admin/role',['Accept' => 'application/json'])
            ->seeJson([
                "role"  => ["The role field is required."],



            ])->assertResponseStatus(422);
    }



   public function testRoleIndex()
   {
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user);

    $this->json('GET','/api/admin/role',['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testCreateRole(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user);

       $data = [
           'role' => 'test.test',

       ];

       $this->json('POST','/api/admin/role',$data,['Accept' => 'application/json'])->assertResponseStatus(201);
   }

   public function testShowUser(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user);

       $this->json('GET',"/api/admin/role/$user->id",['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testUpdateRole(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user);

       $updatedrole = Role::latest('id')->first();
       $data = [
           'role' => 'test.test2',

       ];
       $this->json('PUT',"/api/admin/role/$updatedrole->id",$data,['Accept' => 'application/json'])->assertResponseStatus(200);

   }




public function testDeleteUser(){
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user);

    $deletedRole = Role::latest('id')->first();

    $this->json('DELETE',"/api/admin/role/$deletedRole->id",['Accept' => 'application/json'])->assertResponseStatus(204);
}


   }

