<?php

namespace App\Http\Controllers;


use App\Services\CrudOperation;
use App\Services\RoleService;
use Illuminate\Http\Request;


class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $CurdOp = new CrudOperation(new RoleService());
        return $CurdOp->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {

        $CurdOp = new CrudOperation(new RoleService());
        return   $CurdOp->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        $CurdOp = new CrudOperation(new RoleService());
        return $CurdOp->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id)
    {
        $CurdOp = new CrudOperation(new RoleService());
         return   $CurdOp->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( $id)
    {
        $CurdOp = new CrudOperation(new RoleService());
        return $CurdOp->destroy($id);
    }


}
