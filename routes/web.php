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

Route::get('/', function () {
    return view('welcome');
});
//peer review
//get all the peer reviews
Route::get ('/peerReviews', array ('as'=> 'peerReviewIndex','uses'=>'PeerReviewController@index'));
//get the form to create a new peer review
Route::get ('/addPeerReview',array('as' => 'addPeerReview', 'uses'=>'PeerReviewController@addPeerReview'));
//save new peer review
Route::post ('/addPeerReview', array('as'=> 'savePeerReview', 'uses'=>'PeerReviewController@savePeerReview'));

Route::get ('/addPeerReview',array('as' => 'addPeerReview', 'uses'=>'PeerReviewController@addPeerReview'));

Route::get ('/editPeerReview/{id}',array('as' => 'showEditPeerReview', 'uses'=>'PeerReviewController@showEditPeerReview'));

Route::post ('/editPeerReview/{id}',array('as' => 'editPeerReview', 'uses'=>'PeerReviewController@editPeerReview'));

Route::post('/deletePeerReview/{id}',array('as' => 'deletePeerReview', 'uses'=>'PeerReviewController@deletePeerReview'));


//criteria
Route::get ('/addCriteria/{id}', array ('as'=> 'addCriteria','uses'=>'CriteriaController@add'));

Route::post ('/addCriteria', array ('as'=> 'saveCriteria','uses'=>'CriteriaController@save'));

Route::get ('/editCriteria/{id}',array('as' => 'showEditCriteria', 'uses'=>'CriteriaController@showEdit'));

Route::post ('/editCriteria/{id}',array('as' => 'editCriteria', 'uses'=>'CriteriaController@edit'));

Route::post ('/deleteCriteria/{id}', array ('as'=> 'deleteCriteria','uses'=>'CriteriaController@delete'));

//group

Route::get ('/editGroup/{id}',array('as' => 'showEditGroup', 'uses'=>'GroupController@showEdit'));


Route::get ('/editGroup/{id}',array('as' => 'importCsv', 'uses'=>'GroupController@showImportCsv'));

Route::post ('/editGroup/{id}/saveImport',array('as' => 'saveImport', 'uses'=>'GroupController@saveImport'));

