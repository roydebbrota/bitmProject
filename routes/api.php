<?php


Route::apiResource('/class/name', 'Api\ClassNameController');
Route::apiResource('/subject', 'Api\SubjectController');
Route::apiResource('/section', 'Api\SectionController');
Route::apiResource('/student', 'Api\StudentController');


Route::group([
    'prefix' => 'auth'

], function () {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

});