<?php

namespace App\Http\Controllers;

use App\Services\CourseServie;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function index(CourseServie $courseServie)
    {
        return $courseServie->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request, CourseServie $courseServie)
    {
        return $courseServie->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @param CourseServie $courseServie
     * @return\Illuminate\Http\Resources\Json\JsonResource
     */

    public function show($id, CourseServie $courseServie)
    {
        return  $courseServie->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request,$id, CourseServie $courseServie)
    {
        return $courseServie->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id, CourseServie $courseServie)
    {
        return $courseServie->destroy($id);
    }


}
