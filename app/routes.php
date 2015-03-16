<?php

# This is our API. These calls must be AJAX only
Route::group(['prefix' => '/api/v1','before' => 'ajax','after' => 'cors'], function() {

    # Contacts
    Route::group(['prefix' => 'contacts'], function() {
        Route::get('/',      'ApiV1ContactsController@index');
        Route::post('/',     'ApiV1ContactsController@store');
        Route::get('{id}',   'ApiV1ContactsController@show')->where('id', '[0-9]+');
        Route::delete('{id}','ApiV1ContactsController@destroy')->where('id', '[0-9]+');
        Route::post('{id}',  'ApiV1ContactsController@update')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'messages','before' => 'ajax','after' => 'cors'], function() {
        Route::get('/', 'ApiV1MessagesController@index');
        Route::post('/', 'ApiV1MessagesController@store');
        Route::post('/inbound_twilio', 'ApiV1MessagesController@inbound_twilio');
    });
});

        Route::post('/greeting', 'HomeController@greeting');
        Route::post('/call', 'HomeController@makeCall');

if(isset($_SERVER['REQUEST_METHOD']))
{
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Credentials: true");
	    header('Access-Control-Allow-Headers: X-Requested-With');
	    header('Access-Control-Allow-Headers: Content-Type');
	    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); // http://stackoverflow.com/a/7605119/578667
	    header('Access-Control-Max-Age: 86400');
	    exit;
	}
}
