<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(['middlewareGroups' => 'web', 'middleware' => 'revalidate'], function () {

    Route::auth();
    Route::get('/', 'Auth\LoginController@showlogin');
    Route::post('/', 'Auth\LoginController@login');
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
   
    Route::get('dashboard', 'DashoardController@index');
    Route::get('profile','DashoardController@profile');

    Route::get('mentorcard','MentorController@mentorcard');
    Route::post('get_mem_by_cat','MentorController@mem_cat');
    Route::get('completed_task','TaskController@completed_task_index');
    Route::get('new_task','TaskController@new_task_index');
    Route::post('new_task/submit','TaskController@new_task');
    Route::get('open_task','TaskController@open_index');
    Route::post('open_task/submit','TaskController@open_submit');


    Route::post('req_mentor','MentorController@req_mentor');
    Route::get('add_mentor','MentorController@add_mentor');
    
    
    Route::get('strt_report','StartupController@strt_report');
    Route::post('accpet_app','StartupController@acceptStrp');


    Route::get('visitor','VisitorController@showVisitor');
    Route::get('new_visitor','VisitorController@new_visitor_index');
    Route::post('new_visitor/submit','VisitorController@addVisitor');
    
    Route::get('visitor','EventController@showVisitor');
});
