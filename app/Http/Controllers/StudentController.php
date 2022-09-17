<?php

namespace App\Http\Controllers;


use App\Services\StudentService;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * @var StudentService
     */
    private $StudentService;

    /**
     * @param StudentService $StudentService
     */
    public function __construct(StudentService $StudentService)
    {
        $this->StudentService = $StudentService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(){return  $this->StudentService->index();}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request){return $this->StudentService->store($request);}

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id){return $this->StudentService->show($id);}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request,  $id){return $this->StudentService->update($request,$id);}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function course_subscribe($id){return $this->StudentService->course_subscribe($id);}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscriptions($id){return $this->StudentService->subscriptions($id);}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function unsubscribe($id){return $this->StudentService->unsubscribe($id);}


}
