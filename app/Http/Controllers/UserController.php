<?php

namespace App\Http\Controllers;


use App\Services\CrudOperation;
use App\Services\UserService;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $UserService;


    public function __construct()
    {
        $this->UserService = new CrudOperation(new UserService());;
    }


    public function index()
    {
        return $this->UserService->index();
    }

    /*
     * Store a User into A Database With his role
     * Validate the data before insert it
     * a
     */

    public function store(Request $request){
        return $this->UserService->store($request);
    }

    /*
     * Show a specific User
     * @param id
     */
    public function show($id){
        return $this->UserService->show($id);
    }

    /*
    * Update a specific User  With his role
    * Validate the data before update it
    *
     */
    public function update(Request $request,$id){
        return $this->UserService->update($request,$id);
    }

    public function destroy($id){
        return $this->UserService->destroy($id);
    }


}
