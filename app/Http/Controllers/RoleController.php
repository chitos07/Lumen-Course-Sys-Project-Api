<?php

namespace App\Http\Controllers;


use App\Services\RoleService;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(RoleService $service)
    {
        return $service->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request, RoleService $service)
    {

        return   $service->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @param RoleService $service
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id, RoleService $service)
    {

        return $service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $id
     * @param  RoleService $service
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id, RoleService $service)
    {

         return   $service->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @param RoleService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RoleService $service, $id)
    {

        return $service->destroy($id);
    }


}
