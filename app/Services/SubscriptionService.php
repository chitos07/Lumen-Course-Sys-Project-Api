<?php

namespace App\Services;

use App\Http\Resources\SubscriptionResource;
use App\Interfaces\CRUD;
use App\Models\Subscription;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class SubscriptionService implements CRUD
{
    use ProvidesConvenienceMethods;

    public function index()
    {

        if(!Auth::user()->can('subscription.index')){throw new AuthorizationException();}
        return  SubscriptionResource::collection(Subscription::paginate(10));
    }

    public function store(Request $request)
    {
        if(!Auth::guard('admin_api')->user()->can('subscription.store')){throw new AuthorizationException();}
          $this->Valid($request);
        $booking = new Subscription();
        $booking->student_name = $request->student_name;
        $booking->course_name = $request->course_name;
        $booking->price = $request->price;
        $booking->start_date  = $request->start_date;
        $booking->end_date = $request->end_date ;
        $booking->status = $request->status;

        if($booking->save()){
            return new SubscriptionResource($booking);
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('subscription.update')){
            throw new AuthorizationException();
        }
        $this->Valid($request);
        $booking = Subscription::findOrFail($id);
        $booking->student_name = $request->student_name;
        $booking->course_name = $request->course_name;
        $booking->price = $request->price;
        $booking->start_date  = $request->start_date;
        $booking->end_date = $request->end_date ;
        $booking->status = $request->status;

        if($booking->save()){
            return new SubscriptionResource($booking);
        }

    }

    public function destroy($id)
    {
        if(!Auth::user()->can('subscription.destroy')){throw new AuthorizationException();}

        $booking = Subscription::findOrFail($id);
        if($booking->delete()){
            return response()->json('',204);
        }
    }

    public function show($id)
    {
        if(!Auth::user()->can('subscription.show')){throw new AuthorizationException();}
        return SubscriptionResource::make(Subscription::findOrFail($id));
    }

    protected function Valid(Request $request){
        $this->validate($request,[
            'student_name' => ['required','string'],
            'course_name' => ['required','string'],
            'price' => ['required','integer'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
            'status' => ['required','string'],
        ]);
    }


}
