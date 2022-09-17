<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }


    /**
     *
     * @param Student $student
     * @return bool
     */
    public function subscribe(Student $student){

        $Subscription = new Subscription();

        $Subscription->student_name = $student->username;
        $Subscription->course_name = $this->name;
        $Subscription->price = $this->price;
        $Subscription->start_date = $this->start_date;
        $Subscription->end_date = $this->end_date;
        $Subscription->status = $this->status;
        return $Subscription->save();
    }
}
