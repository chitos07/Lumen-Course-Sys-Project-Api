<?php

namespace App\Http\Controllers;


use App\Services\CrudOperation;
use App\Services\InstructorService;
use Illuminate\Http\Request;


class InstructorController extends Controller
{
    /**
     * @var InstructorService
     */
    private $InstructorOperation;


    public function __construct()
    {
        $this->InstructorService = new CrudOperation(new InstructorService());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return $this->InstructorService->index();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->InstructorService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
      return $this->InstructorService->show($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        return $this->InstructorService->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->InstructorService->destroy($id);
    }

}
