<?php

namespace App\Services;

use App\Http\Resources\InstructorResource;
use App\Interfaces\CRUD;
use App\Models\Instructor;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class InstructorService implements CRUD
{
    use ProvidesConvenienceMethods;

    public function index()
    {
        if(!Auth::user()->can('instructor.index')){throw new AuthorizationException();}
        return InstructorResource::collection(Instructor::paginate(10));
    }

    public function store(Request $request)
    {
        if(!Auth::user()->can('instructor.store')){throw new AuthorizationException();}
        $this->Valid($request);
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

    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('instructor.update')){throw new AuthorizationException();}
        $this->Valid($request);
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

    public function destroy($id)
    {
        if(!Auth::user()->can('instructor.destroy')){throw new AuthorizationException();}
        $Instructor = Instructor::findOrFail($id);
        if($Instructor->delete()){
            return response()->json('',204);
        }

    }

    public function show($id)
    {
        if(!Auth::user()->can('instructor.show')){throw new AuthorizationException();}
        return InstructorResource::make(Instructor::findOrFail($id)->load('course'));
    }
    protected function Valid(Request $request){
        $this->validate($request,[

            'name' => ['required','string'],
            'phone' => ['required','integer'],
            'address' => ['required','string'],
            'salary' => ['required','integer'],
            'his_specialty' => ['required','string'],
        ]);
    }

}
