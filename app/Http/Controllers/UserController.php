<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        if(!Auth::user()->can('user.index')){
            abort(403);
        }
        return UserResource::collection(User::paginate(10));

    }

    /*
     * Store a User into A Database With his role
     * Validate the data before insert it
     * a
     */

    public function store(Request $request){
        if(!Auth::user()->can('user.store')){
            abort(403);
        }


        $this->validate($request,[
            'name' => ['required','string','max:50', 'min:5'],
            'email' => ['required','email','unique:users'],
            'jobTitle' => ['required','string'],
            'password' => ['required','confirmed'],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->jobTitle = $request->jobTitle;

        if($user->save()){
            $user->roles()->attach($request->role);
            return new UserResource($user);
        }

    }

    /*
     * Show a specific User
     * @param id
     */
    public function show($id){
        if(!Auth::user()->can('user.show')){
            abort(403);
        }
        $user = User::findOrFail($id);
        return UserResource::make($user->load('roles'));
    }

    /*
    * Update a specific User  With his role
    * Validate the data before update it
    *
     */
    public function update(Request $request,$id){
        if(!Auth::user()->can('user.update')){
            abort(403);
        }

        $user = User::findOrFail($id);
        $this->validate($request,[
            'name' => ['required','string','max:50', 'min:5'],
            'email' => ['required','email','unique:users'],
            'jobTitle' => ['required','string'],
            'password' => ['required','confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->jobTitle = $request->jobTitle;

        if($user->save()){
            $user->roles()->sync($request->role);
            return new UserResource($user);
        }
    }

    public function destroy($id){
        if(!Auth::user()->can('user.destroy')){
            abort(403);
        }
        $user = User::findOrFail($id);
        if($user->delete()){
            return response()->json('',204);
        }

    }

}
