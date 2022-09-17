<?php

namespace App\Services;

use App\Http\Resources\RoleResource;
use App\Interfaces\CRUD;
use App\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class RoleService implements CRUD
{
    use ProvidesConvenienceMethods;

    public function index(){
        if(!Auth::guard('admin_api')->user()->can('role.index')){
            throw new AuthorizationException();
        }
       return RoleResource::collection(Role::paginate(10));
    }
    public function store($request){
        if(!Auth::guard('admin_api')->user()->can('role.store')){
            throw new AuthorizationException();
        }
        $this->Valid($request);
       $role =   Role::create([
            'role' => $request->role
        ]);
       if($role != null){
           return new RoleResource($role);
       }

    }
    public function update($request,$id){
        if(!Auth::guard('admin_api')->user()->can('role.update')){throw new AuthorizationException();}

        $this->Valid($request);
        $role =   Role::findOrFail($id);
        $role->role = $request->role;
        if($role->save()){
            return new RoleResource($role);
        }
    }
    public function destroy($id){
        if(!Auth::guard('admin_api')->user()->can('role.destroy')){
            throw new AuthorizationException();
        }

        $role = Role::findOrFail($id);
        if($role->delete()){
            return response()->json('',204);
        }
    }
    public function show($id){
        if(!Auth::guard('admin_api')->user()->can('role.show')){
            throw new AuthorizationException();
        }
        return RoleResource::make(Role::findOrFail($id));
    }
    protected function Valid(Request $request){
        $this->validate($request,[
            'role' => ['required','string']
        ]);

    }
}
