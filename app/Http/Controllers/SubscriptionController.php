<?php

namespace App\Http\Controllers;


use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        //
        if(!Auth::user()->can('booking.index')){
            abort(403);
        }
        return  SubscriptionResource::collection(Subscription::paginate(10));

    }
    /**
     * Create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function store(Request $request){
        $this->validate($request,[
            'studentName' => ['required','string'],
            'courseName' => ['required','string'],
            'price' => ['required','integer'],
            'startDate' => ['required','date'],
            'endDate' => ['required','date'],
            'status' => ['required','string'],
        ]);

        $booking = new Subscription();
        $booking->studentName = $request->studentName;
        $booking->courseName = $request->courseName;
        $booking->price = $request->price;
        $booking->startDate = $request->startDate;
        $booking->endDate = $request->endDate;
        $booking->status = $request->status;

        if($booking->save()){
            return new SubscriptionResource($booking);
        }
    }

    public function show($id){

        return SubscriptionResource::make(Subscription::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('booking.update')){
            abort(403);
        }

        $this->validate($request,[
            'studentName' => ['required','string'],
            'courseName' => ['required','string'],
            'price' => ['required','integer'],
            'startDate' => ['required','date'],
            'endDate' => ['required','date'],
            'status' => ['required','string'],
        ]);

        $booking = Subscription::findOrFail($id);
        $booking->studentName = $request->studentName;
        $booking->courseName = $request->courseName;
        $booking->price = $request->price;
        $booking->startDate = $request->startDate;
        $booking->endDate = $request->endDate;
        $booking->status = $request->status;

        if($booking->save()){
            return new SubscriptionResource($booking);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $booking = Subscription::findOrFail($id);
        if($booking->delete()){
            return response()->json('',204);
        }
    }

}
