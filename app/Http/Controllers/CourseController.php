<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        if(!Auth::user()->can('course.index')){
            throw new AuthorizationException();
            //abort(403);
        }

        return CourseResource::collection(Course::paginate(10));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if(!Auth::user()->can('course.store')){
            throw new AuthorizationException();
            //abort(403);
        }
        $this->validate($request,[
            'name' => ['required','string'],
            'instructor_id' => ['required','integer'],
            'max_student' => ['required','integer'],
            'status' => ['required','integer'],
            'price' => ['required','integer'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],

        ]);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return\Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        if(!Auth::user()->can('course.show')){
            throw new AuthorizationException();
            //abort(403);
        }

        return CourseResource::make(Course::findOrFail($id)->load('instructor'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,  $id)
    {
        if(!Auth::user()->can('course.update')){
            throw new AuthorizationException();
            //abort(403);
        }
        $this->validate($request,[
            'name' => ['required','string'],
            'instructor_id' => ['required','integer'],
            'max_student' => ['required','integer'],
            'status' => ['required','integer'],
            'price' => ['required','integer'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],

        ]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('course.destroy')){
            throw new AuthorizationException();
            //abort(403);
        }
        $course = Course::findOrFail($id);
        if($course->delete()){
            return response()->json('',204);
        }
    }
}
