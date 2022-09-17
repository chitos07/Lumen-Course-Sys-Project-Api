<?php

namespace App\Services;

use App\Http\Resources\StudentResource;
use App\Interfaces\CRUD;
use App\Models\Course;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class StudentService implements CRUD
{
    use ProvidesConvenienceMethods;
    public function index()
    {
        if(Auth::guard('admin_api')->user() != null) {
            if (!Auth::guard('admin_api')->user()->can('student.index')) {
                throw new AuthorizationException();
            }
        }
        return StudentResource::collection(Student::paginate(10));
    }

    public function store(Request $request)
    {
        $this->Valid($request);

        $student = new Student();
        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->email = $request->email;
        $student->credit = $request->credit;
        if($student->save()){
            return new StudentResource($student);
        }
    }

    public function update(Request $request, $id)
    {
        $student =Student::findOrFail($id);

        $this->UpdateValid($request);

        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->email = $request->email;
        $student->credit = $request->credit;
        if($student->save()){
            return new StudentResource($student);
        }
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return StudentResource::make($student);
    }

    public function course_subscribe($id){

        $course = Course::findOrFail($id);
        if( $course->subscribe(auth('student_api')->user())){
            return response()->json(['Course Subscribtion successfully'],200);
        }
    }

    public function subscriptions($id){

        $student = Student::findOrFail($id);

        return  $student->subscriptions();
    }
    public function unsubscribe($id){
        $Subscription = Subscription::findOrFail($id);
        if($Subscription->delete()){
            return response()->json('',204);
        }
    }

    protected function Valid(Request $request){
        $this->validate($request,[
            'username' => ['required','string'],
            'password' => ['required','confirmed'],
            'email' => ['required','email','unique:students'],
            'credit' => ['required','integer'],
        ]);
    }
    protected function UpdateValid(Request $request){
        $this->validate($request,[
            'username' => ['required','string'],
            'password' => ['required','confirmed'],
            'email' =>    ['required','email'],
            'credit' => ['required','integer'],
        ]);
    }

    public function destroy($id){}

}
