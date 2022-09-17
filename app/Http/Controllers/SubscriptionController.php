<?php

namespace App\Http\Controllers;



use App\Services\SubscriptionService;
use Illuminate\Http\Request;


class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionService
     */
    private $SubscriptionService;

    /**
     *
     */
    public function __construct( SubscriptionService $SubscriptionService)
    {
        $this->SubscriptionService = new $SubscriptionService;


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(){return $this->SubscriptionService->index();}

    /**
     * Create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function store(Request $request){return  $this->SubscriptionService->store($request);}

    /**
     * Show the specified resource in storage.
     * @param $id
     * @return \App\Http\Resources\SubscriptionResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id){return $this->SubscriptionService->show($id);}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id){return $this->SubscriptionService->update($request,$id);}

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){return $this->SubscriptionService->destroy($id);}

}
