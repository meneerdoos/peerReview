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

    //lists
    Route::get('/lists', array('as' => 'listsIndex', 'uses' => 'ListController@Index'));

    Route::get('/addList', array('as' => 'addList', 'uses' => 'ListController@add'));

    Route::post('/saveList', array('as' => 'saveList', 'uses' => 'ListController@save'));

    Route::get('/editList/{id}', array('as' => 'showEditList', 'uses' => 'ListController@showEdit'));


    Route::post('/editList/{id}', array('as' => 'EditList', 'uses' => 'ListController@Edit'));


    Route::get('/editSetCriteria/{id}', array('as' => 'showEditList', 'uses' => 'ListController@showEditSetCriteria'));

    Route::post('/editSetCriteria/{id}', array('as' => 'EditSetCriteria', 'uses' => 'ListController@EditSetCriteria'));

    Route::post('/deleteSetCriteria/{id}', array('as' => 'DeleteSetCriteria', 'uses' => 'ListController@DeleteSetCriteria'));

//add group to peer review


    Route::get('/editPeerReview/{id}/addGroup', array('as' => 'addGroup', 'uses' => 'GroupController@add'));

    Route::post('/saveGroup', array('as' => 'saveGroup', 'uses' => 'GroupController@save'));

//peer review wizard
//
    Route::get('/stepOne', array('as' => 'showStepOne', 'uses' => 'PeerReviewController@showStepOne'));
    Route::post('/saveStepOne', array('as' => 'saveStepOne', 'uses' => 'PeerReviewController@saveStepOne'));

    Route::get('/stepTwo/{id}', array('as' => 'showStepTwo', 'uses' => 'PeerReviewController@showStepTwo'));
    Route::post('/saveStepTwo', array('as' => 'saveStepTwo', 'uses' => 'PeerReviewController@saveStepTwo'));

    Route::get('/stepThree/{id}', array('as' => 'showStepThree', 'uses' => 'PeerReviewController@showStepThree'));

    Route::post('/saveStepThree', array('as' => 'saveStepThree', 'uses' => 'PeerReviewController@saveStepThree'));

    Route::get('/stepFour/{id}', array('as' => 'showStepFour', 'uses' => 'PeerReviewController@showStepFour'));

    Route::post('/saveStepFour/{id}', array('as' => 'saveStepFour', 'uses' => 'PeerReviewController@saveStepFour'));


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
