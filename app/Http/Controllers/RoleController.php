<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        if(!Auth::user()->can('role.index')){
            abort(403);
        }

        return RoleResource::collection(Role::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        if(!Auth::user()->can('role.store')){
            abort(403);
        }
        $this->validate($request,[
            'role' => ['required','string']
        ]);

        $role = new Role();
        $role->role = $request->role;
        if($role->save()){
            return new RoleResource($role);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        if(!Auth::user()->can('role.show')){
            abort(403);
        }
        return RoleResource::make(Role::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('role.update')){
            abort(403);
        }
        $role = Role::findOrFail($id);
        $role->role = $request->role;
        if($role->save()){
            return new RoleResoure($role);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('role.destroy')){
            abort(403);
        }
        $role = Role::findOrFail($id);
        if($role->delete()){
            return response()->json('',204);
        }
    }
}
