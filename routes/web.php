<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);


	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware'=>'auth','middleware'=>'super.admin'],function (){
        Route::resource('faculties','FacultyController');
});

Route::group(['middleware'=>'auth','middleware'=>'super.admin'],function (){
    Route::resource('departments','DepartmentController');
    Route::get('departments/{faculty}/faculty','DepartmentController@index2')->name('departments.index2');
    Route::get('departments/{faculty}/new','DepartmentController@create2')->name('departments.create2');
});


Route::group(['middleware'=>'auth'],function (){
    Route::resource('decision','DecisionController');
    Route::get('decision/add/{decision}','DecisionController@addDecisionToNextSession')->name('decision.add');
    Route::get('decision_votes/{decision_id}','DecisionController@show_votes')->name('decision.show_votes');
    Route::get('adoption/{decision_id}','DecisionController@decisionAdoption')->name('decision.decisionAdoption');
    Route::post('decision/send/{decision_id}','DecisionController@sendDecision')->name('decision.send');

});
Route::group(['middleware'=>'auth','middleware'=>'council.secretary'],function (){
    Route::resource('facultySession','FacultySessionController');

});
Route::group(['middleware'=>'auth','middleware'=>'council.secretary'],function (){
    Route::resource('advertisement','AdvertisementController');

});

Route::group(['middleware'=>'auth','middleware'=>'council.member'], function () {
    Route::resource('votes','VoteController');
    Route::post('votes/add/{decision}','VoteController@store2')->name('votes.store2');
});

