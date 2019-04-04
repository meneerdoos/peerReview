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

Route::middleware(['auth'])->group(function () {

//peer review
//dashboard
    Route::get('/', array('as' => 'dashboard', 'uses' => 'PeerReviewController@dashboard'));


//get all the peer reviews
    Route::get('/peerReviews', array('as' => 'peerReviewIndex', 'uses' => 'PeerReviewController@index'));
//get the form to create a new peer review
    Route::get('/addPeerReview', array('as' => 'addPeerReview', 'uses' => 'PeerReviewController@addPeerReview'));
//save new peer review
    Route::post('/addPeerReview', array('as' => 'savePeerReview', 'uses' => 'PeerReviewController@savePeerReview'));

    Route::get('/addPeerReview', array('as' => 'addPeerReview', 'uses' => 'PeerReviewController@addPeerReview'));

    Route::get('/editPeerReview/{id}', array('as' => 'showEditPeerReview', 'uses' => 'PeerReviewController@showEditPeerReview'));

    Route::post('/editPeerReview/{id}', array('as' => 'editPeerReview', 'uses' => 'PeerReviewController@editPeerReview'));

    Route::post('/deletePeerReview/{id}', array('as' => 'deletePeerReview', 'uses' => 'PeerReviewController@deletePeerReview'));


//add group to peer review


    Route::get('/editPeerReview/{id}/addGroup', array('as' => 'addGroup', 'uses' => 'GroupController@add'));

    Route::post('/saveGroup', array('as' => 'saveGroup', 'uses' => 'GroupController@save'));


//criteria
    Route::get('/addCriteria/{id}', array('as' => 'addCriteria', 'uses' => 'CriteriaController@add'));

    Route::post('/addCriteria', array('as' => 'saveCriteria', 'uses' => 'CriteriaController@save'));

    Route::get('/editCriteria/{id}', array('as' => 'showEditCriteria', 'uses' => 'CriteriaController@showEdit'));

    Route::post('/editCriteria/{id}', array('as' => 'editCriteria', 'uses' => 'CriteriaController@edit'));

    Route::post('/deleteCriteria/{id}', array('as' => 'deleteCriteria', 'uses' => 'CriteriaController@delete'));

//group

    Route::get('/editGroup/{id}', array('as' => 'showEditGroup', 'uses' => 'GroupController@showEdit'));
    Route::post('/editGroup/{id}', array('as' => 'showEditGroup', 'uses' => 'GroupController@saveEdit'));


    Route::get('/showImport/{id}', array('as' => 'importCsv', 'uses' => 'GroupController@showImportCsv'));

    Route::post('/editGroup/{id}/saveImport', array('as' => 'saveImport', 'uses' => 'GroupController@saveImport'));


//mail
    Route::post('/editPeerReview/{id}/notifyToComplete', array('as' => 'notify', 'uses' => 'PeerReviewController@notify'));

    Route::get('/overview/{id}', array('as' => 'showOverview', 'uses' => 'PeerReviewController@overview'));

//fill in a peer review

    Route::get('/{id}/{link}', array('as' => 'showPeerReview', 'uses' => 'PeerReviewController@show'));


    Route::post('/completePeerReview/{id}', array('as' => 'completePeerReview', 'uses' => 'PeerReviewController@complete'));

});
//overview


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');

});