<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\CRUD;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UserService implements CRUD
{
    use ProvidesConvenienceMethods;
    public function index()
    {
        if(!Auth::guard('admin_api')->user()->can('user.index')){
            throw new AuthorizationException();
        }
        return UserResource::collection(User::paginate(10));
    }

    public function store(Request $request)
    {
        if(!Auth::guard('admin_api')->user()->can('user.store')){
            throw new AuthorizationException();
        }
        $this->Valid($request);
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->job_title = $request->job_title;

        if($user->save()){
            $user->roles()->attach($request->role);
            return new UserResource($user);
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::guard('admin_api')->user()->can('user.update')){throw new AuthorizationException();}
        $user = User::findOrFail($id);

        $this->UpdateValid($request);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->job_title = $request->job_title;

        if($user->save()){
            $user->roles()->sync($request->role);
            return new UserResource($user);
        }
    }

    public function destroy($id)
    {
        if(!Auth::guard('admin_api')->user()->can('user.destroy')){
            throw new AuthorizationException();
        }
        $user = User::findOrFail($id);
        if($user->delete()){
            return response()->json('',204);
        }
    }

    public function show($id)
    {
        if(!Auth::guard('admin_api')->user()->can('user.show')){
            throw new AuthorizationException();
        }
        $user = User::findOrFail($id);
        return UserResource::make($user->load('roles'));
    }


    protected function Valid(Request $request){
        $this->validate($request,[
            'username' => ['required','string','max:50', 'min:5'],
            'email' => ['required','email','unique:users'],
            'job_title' => ['required','string'],
            'password' => ['required','confirmed'],
        ]);
    }

    protected function UpdateValid(Request $request){
        $this->validate($request,[
            'username' => ['required','string','max:50', 'min:5'],
            'email' => ['email'],
            'job_title' => ['required','string'],
            'password' => ['required','confirmed'],
        ]);
    }

}
