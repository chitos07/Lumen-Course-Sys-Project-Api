<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->group(['prefix' => 'api'],function () use($router){
    $router->post('admins/login','Auth\AdminAuthController@login');

    $router->group(['prefix' => 'admin', 'middleware' => 'auth:admin_api'],function ($router){
        $router->post('/logout', 'Auth\AdminAuthController@logout');

        // Users Route
        $router->get('/users','UserController@index');
        $router->post('/users','UserController@store');
        $router->get('/users/{id}','UserController@show');
        $router->put('/users/{id}','UserController@update');
        $router->delete('/users/{id}','UserController@destroy');


        //Role Route
        $router->get('/roles','RoleController@index');
        $router->post('/roles','RoleController@store');
        $router->get('/roles/{id}','RoleController@show');
        $router->put('/roles/{id}','RoleController@update');
        $router->delete('/roles/{id}','RoleController@destroy');

        // Instructor Routes
        $router->get('/instructors','InstructorController@index');
        $router->post('/instructors','InstructorController@store');
        $router->get('/instructors/{id}','InstructorController@show');
        $router->put('/instructors/{id}','InstructorController@update');
        $router->delete('/instructors/{id}','InstructorController@destroy');


        // Course Routes
        $router->get('/courses','CourseController@index');
        $router->post('/courses','CourseController@store');
        $router->get('/courses/{id}','CourseController@show');
        $router->put('/courses/{id}','CourseController@update');
        $router->delete('/courses/{id}','CourseController@destroy');

        //subscribe Route
        $router->get('/subscriptions','SubscriptionController@index');
        $router->post('/subscriptions','SubscriptionController@store');
        $router->get('/subscriptions/{id}','SubscriptionController@show');
        $router->put('/subscriptions/{id}','SubscriptionController@update');
        $router->delete('/subscriptions/{id}','SubscriptionController@destroy');

        // Student Route
        $router->get('/students','StudentController@index');

    });


    $router->group(['prefix' => 'students'],function ($router){

        $router->post('/register','StudentController@store');
        $router->post('login','Auth\StudentAuthController@login');

        $router->group(['middleware' => 'auth:student_api'], function ($router){
            $router->put('{id}','StudentController@update');
            $router->get('/{id}/subscriptions','StudentController@subscriptions');
            $router->get('/{id}','StudentController@show');
            $router->post('/{id}/subscribe', 'StudentController@course_subscribe');
            $router->delete('/{id}/unsubscribe' , 'StudentController@unsubscribe');
        });
    });

});





$router->get('/', function () use ($router) {
    return $router->app->version();
});
