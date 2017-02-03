<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->post('api/stats/pulse', 'StatsController@pulse');

$app->get('api/report/count', 'Report\CountController@get');
$app->get('api/report/histogram', 'Report\HistogramController@get');
