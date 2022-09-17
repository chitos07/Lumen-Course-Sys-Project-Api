<?php

namespace App\Services;

use App\Http\Resources\CourseResource;
use App\Interfaces\CRUD;
use App\Models\Course;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CourseServie implements CRUD
{
    use ProvidesConvenienceMethods;
    public function index()
    {
        if(!Auth::user()->can('course.index')){throw new AuthorizationException();}

        return CourseResource::collection(Course::paginate(10));
    }

    public function store(Request $request)
    {
        if(!Auth::user()->can('course.store')){throw new AuthorizationException();}

        $this->Valid($request);
        $course = new Course();
        $course->name = $request->name;
        $course->instructor_id = $request->instructor_id;
        $course->max_student = $request->max_student;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;

        if($course->save()){
            return response()->json(['msg' => 'recored inserted'],201);
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('course.update')){throw new AuthorizationException();}
        $this->Valid($request);
        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->instructor_id = $request->instructor_id;
        $course->max_student = $request->max_student;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;

        if($course->save()){
            return response()->json(['msg' => 'recored Updated'],201);
        }
    }

    public function destroy($id)
    {
        if(!Auth::user()->can('course.destroy')){throw new AuthorizationException();}
        $course = Course::findOrFail($id);
        if($course->delete()){
            return response()->json('',204);
        }
    }

    public function show($id)
    {
        if(!Auth::user()->can('course.show')){throw new AuthorizationException();}
        return CourseResource::make(Course::findOrFail($id)->load('instructor'));
    }

    protected function Valid(Request $request){
        $this->validate($request,[
            'name' => ['required','string'],
            'instructor_id' => ['required','integer'],
            'max_student' => ['required','integer'],
            'status' => ['required','integer'],
            'price' => ['required','integer'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
        ]);
    }

}
