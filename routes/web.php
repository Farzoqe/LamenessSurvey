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

use Illuminate\Support\Facades\Artisan;


Route::middleware("auth")->group(function () {
    Route::get('/', 'SurveyController@index');
    Route::get('/get-surveys', 'SurveyController@json');
    Route::get('/export/{sid}', 'SurveyController@export');
    Route::get('/command/{commnad}', function ($command) {
        Artisan::call($command);
    });
    Route::post('/save-answers', 'SurveyController@saveAnswers');
    Route::resources([
        'survey' => 'SurveyController',
        'answer-set' => 'AnswerSetController',
        'answer' => 'AnswerController',
        'questions' => 'QuestionController'
    ]);
Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
Route::any('/git-update', function () {
    shell_exec("cd .. && git fetch --all && git reset --hard origin/master && php artisan migrate");
});
