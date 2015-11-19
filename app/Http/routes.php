<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/get-debts', function() {

    //this route should return json response
    return \App\Transaction::all();

});

// This allows adding debts to the system
Route::post('/add-debt', function() {

    $input = Input::json()->all();

    $debt = new \App\Transaction();
    $debt->name = $input['name'];
    $debt->description = $input['description'];
    $debt->type = $input['type'];
    $debt->amount = $input['amount'];

    $debt->save();



});

// This allows us to delete debts from the system
Route::post('/remove-debt', function() {

    // Get an array comprised of the JSON postdata
    $input = Input::json()->all();

    // Get a collection of the debts (there should be only one)
    $debts = \App\Transaction::find($input);

    // There should only ever be one of these, but since we get a collection we do a loop just to be safe
    foreach($debts as $debt) {
        $debt->delete();
    }

});



