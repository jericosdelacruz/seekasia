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
    return view('welcome');
});

Route::get('/', 'CheckoutController@home');
Route::post('/checkout', 'CheckoutController@checkout');

Route::get('/price_rules', 'PriceRuleController@index');
Route::get('/price_rules/add', 'PriceRuleController@addPriceRule');
Route::get('/price_rules/edit/{id}', 'PriceRuleController@editPriceRule');
Route::post('/price_rules/save', 'PriceRuleController@savePriceRule');