<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

interface CRUD
{

    public function index();
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
    public function show($id);

}
