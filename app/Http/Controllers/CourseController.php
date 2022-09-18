<?php

namespace App\Http\Controllers;

use App\Services\CourseServie;
use App\Services\CrudOperation;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function index()
    {
        $CurdOperation = new CrudOperation(new CourseServie());
        return $CurdOperation->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        $CurdOperation = new CrudOperation(new CourseServie());
        return $CurdOperation->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @param CourseServie $courseServie
     * @return\Illuminate\Http\Resources\Json\JsonResource
     */

    public function show($id)
    {
        $CurdOperation = new CrudOperation(new CourseServie());
        return  $CurdOperation->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request,$id)
    {
        $CurdOperation = new CrudOperation(new CourseServie());
        return $CurdOperation->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @param CourseServie $courseServie
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        $CurdOperation = new CrudOperation(new CourseServie());
        return $CurdOperation->destroy($id);
    }


}
