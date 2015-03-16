<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function greeting()
	{
		$from = Input::get('From');
		$allowed = Config::get('sms.allowed');

		$template = in_array($from,array_keys($allowed)) ? 'proceed' : 'reject';
		return View::make($template,[
			'caller_id' => $allowed[$from]
		]);
	}

	public function makeCall()
	{
		return View::make('makeCall',[
			'to' => Input::get('Digits'),
			'callerId' => Input::get('caller_id')
		]);
	}

}
