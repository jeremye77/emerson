<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::controller('sheet', 'SheetController', [
//    'anyData'  => 'datatables.data',
//    'getIndex' => 'datatables',
//]);

Route::delete('delete/{id}',array('uses' => 'SheetController@destroy', 'as' => 'sheet.destroy'));
Route::patch('edit/{id}',array('uses' => 'SheetController@store', 'as' => 'sheet.patch'));
Route::get('datatables.data',array('uses' => 'SheetController@anyData',	'as' => 'datatables.data'));
Route::get('/',array('uses' => 'SheetController@getIndex', 'as' => 'getIndex'));
Route::get('edit/{id}',array('uses' => 'SheetController@patch', 'as' => 'sheet.patch'));
Route::get('create',array('uses' => 'SheetController@create', 'as' => 'sheet.store'));
Route::post('create',array('uses' => 'SheetController@store', 'as' => 'sheet.store'));
Route::get('autocomplete',array('uses'=>'AutoCompleteController@index','as'=>'autocomplete'));
Route::get('searchaccompaniment',array('uses'=>'AutoCompleteController@searchAccompaniment','as'=>'searchaccompaniment'));
Route::get('searcharranger',array('uses'=>'AutoCompleteController@searchArranger','as'=>'searcharranger'));
Route::get('searchcomposer',array('uses'=>'AutoCompleteController@searchComposer','as'=>'searchcomposer'));
Route::get('searchpublisher',array('uses'=>'AutoCompleteController@searchPublisher','as'=>'searchpublisher'));
Route::get('searchVoicing',array('uses'=>'AutoCompleteController@searchVoicing','as'=>'searchvoicing'));
