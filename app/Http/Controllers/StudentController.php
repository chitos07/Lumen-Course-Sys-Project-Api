<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Resources\BookingResoure;
use App\Http\Resources\StudentResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Course;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        if(!Auth::user()->can('student.index')){
            abort(403);
        }
        return StudentResource::collection(Student::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username' => ['required','string'],
            'password' => ['required','confirmed'],
            'email' => ['required','email','unique:students'],
            'credit' => ['required','integer'],
        ]);
        $student = new Student();
        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->email = $request->email;
        $student->credit = $request->credit;
        if($student->save()){
            return new StudentResource($student);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show( $id)
    {
        if(!Auth::user()->can('student.show')){
            abort(403);
        }
        $student = Student::findOrFail($id);
        return StudentResource::make($student);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request,  $id)
    {
        $student =Student::findOrFail($id);
        $this->validate($request,[
            'username' => ['required','string'],
            'password' => ['required','confirmed'],
            'email' => ['required','email','unique:students'],
            'credit' => ['required','integer'],
        ]);

        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->email = $request->email;
        $student->credit = $request->credit;
        if($student->save()){
            StudentAuthController::logout();
            return new StudentResource($student);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('student.destroy')){
            abort(403);
        }
        $student =Student::findOrFail($id);
        if($student->delete()){
            return response()->json('',204);
        }
    }


    public function course_subscribe($id){


        // The Course that is student wanna subscribe it
        $course = Course::findOrFail($id);


        $booking = new Subscription();
        $booking->student_name = auth('student_api')->user()->username;
        $booking->course_name = $course->name;
        $booking->price = $course->price;
        $booking->start_date = $course->start_date;
        $booking->end_date = $course->end_date;
        $booking->status = $course->status;

        if($booking->save()){
            return new SubscriptionResource($booking);
        }
    }
    public function subscriptions($id){

        $StudentName = Student::findOrFail($id)->username;


        return DB::select('select * from subscriptions where student_name = ?', [$StudentName]);
    }

    public function unsubscribe($id){
        $booking = Subscription::findOrFail($id);
        if($booking->delete()){
            return response()->json('',204);
        }
    }


}
