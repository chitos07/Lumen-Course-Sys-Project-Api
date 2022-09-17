<?php
namespace Tests\Feature;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{


    public function test_required_Fields_forCreateAndUpdate(){
        $user = User::findOrFail(1);
        $this->actingAs($user,'admin_api');

        $this->json('POST','/api/admin/roles',['Accept' => 'application/json'])
            ->seeJson([
                "role"  => ["The role field is required."],
            ])->assertResponseStatus(422);
    }



   public function testRoleIndex()
   {
    $user = User::findOrFail(1);
    $this->actingAs($user,'admin_api');

    $this->json('GET','/api/admin/roles',['Accept' => 'application/json'])->assertResponseStatus(200);
   }



   public function testCreateRole(){
       $user = User::findOrFail(1);
       $this->actingAs($user,'admin_api');

       $data = [
           'role' => 'test.test',

       ];

       $this->json('POST','/api/admin/roles',$data,['Accept' => 'application/json'])->assertResponseStatus(201);
   }

   public function testShowRole(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user,'admin_api');

       $this->json('GET',"/api/admin/roles/1",['Accept' => 'application/json'])->assertResponseStatus(200);
   }


   public function testUpdateRole(){
       $user = \App\Models\User::findOrFail(1);
       $this->actingAs($user,'admin_api');

       $updatedrole = Role::latest('id')->first();
       $data = [
           'role' => 'test.test2',

       ];
       $this->json('PUT',"/api/admin/roles/$updatedrole->id",$data,['Accept' => 'application/json'])->assertResponseStatus(200);

   }




public function testDeleteUser(){
    $user = \App\Models\User::findOrFail(1);
    $this->actingAs($user,'admin_api');

    $deletedRole = Role::latest('id')->first();

    $this->json('DELETE',"/api/admin/roles/$deletedRole->id",['Accept' => 'application/json'])->assertResponseStatus(204);
}


   }

