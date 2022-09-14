<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        if(!Auth::user()->can('instructor.index')){
            throw new AuthorizationException();
          //  abort(403);
        }
        return InstructorResource::collection(Instructor::paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if(!Auth::user()->can('instructor.store')){
            throw new AuthorizationException();
            //abort(403);
        }
        $this->validate($request,[
            'name' => ['required','string'],
            'phone' => ['required','integer'],
            'address' => ['required','string'],
            'salary' => ['required','integer'],
            'his_specialty' => ['required','string'],

        ]);
        $Instructor = new Instructor();
        $Instructor->name = $request->name;
        $Instructor->phone = $request->phone;
        $Instructor->address = $request->address;
        $Instructor->salary = $request->salary;
        $Instructor->his_specialty = $request->his_specialty;
        if($Instructor->save()){
            return response()->json(['msg' => 'recored inserted'],201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        if(!Auth::user()->can('instructor.show')){
            throw new AuthorizationException();
            //abort(403);
        }
        return InstructorResource::make(Instructor::findOrFail($id)->load('course'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('instructor.update')){
            throw new AuthorizationException();
            //abort(403);
        }

        $this->validate($request,[
            'name' => ['required','string'],
            'phone' => ['required','integer'],
            'address' => ['required','string'],
            'salary' => ['required','integer'],
            'his_specialty' => ['required','string'],

        ]);

        $Instructor = Instructor::findOrFail($id);
        $Instructor->name = $request->name;
        $Instructor->phone = $request->phone;
        $Instructor->address = $request->address;
        $Instructor->salary = $request->salary;
        $Instructor->his_specialty = $request->his_specialty;
        if($Instructor->save()){
            return response()->json(['msg' => 'recored Updated'],201);
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
        if(!Auth::user()->can('instructor.destroy')){
            throw new AuthorizationException();
            //abort(403);
        }

        $Instructor = Instructor::findOrFail($id);
        if($Instructor->delete()){
            return response()->json('',204);
        }
    }
}
