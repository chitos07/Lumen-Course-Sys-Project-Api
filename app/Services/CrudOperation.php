<?php

namespace App\Services;

use App\Interfaces\CRUD;
use Illuminate\Http\Request;

class CrudOperation
{
    /**
     * @var CRUD
     */
    private $crudInterface;

    /**
     * @param \App\Interfaces\CRUD $crudInterface
     */
    public function __construct(CRUD $crudInterface)
    {
        $this->crudInterface = $crudInterface;
    }

    public function index(){
        return $this->crudInterface->index();
    }

    public function store(Request $request){

        return $this->crudInterface->store($request);

    }

    public function show($id){
        return $this->crudInterface->show($id);
    }

    public function update(Request $request,$id){
        return $this->crudInterface->update($request,$id);
    }

    public function destroy($id){
        return $this->crudInterface->destroy($id);
    }

    public function course_subscribe($id){
        return $this->crudInterface->course_subscribe( $id);
    }
    public function subscriptions($id){
        return $this->crudInterface->subscriptions($id);
    }

    public function unsubscribe($id)
    {
        return $this->crudInterface->unsubscribe($id);
    }

}
