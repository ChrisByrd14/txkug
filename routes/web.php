<?php

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::name('welcome.index')->get('/', 'WelcomeController@index');
Route::name('blog.index')->get('/blog', 'BlogController@index');
Route::name('events.index')->get('/events', 'EventsController@index');
Route::name('events.show')->get('/events/{slug}', 'EventsController@show');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::name('social.redirect')->get('/social/redirect/{provider}', 'Auth\SlackController@getSocialRedirect');
Route::name('social.handle')->get('/social/handle/{provider}', 'Auth\SlackController@getSocialHandle');
Route::name('authenticated.logout')->get('/logout', 'Auth\LoginController@logout')->middleware('auth:all');
Auth::routes(['login' => 'auth.login', 'middleware' => 'auth:all']);

/*
|--------------------------------------------------------------------------
| Authenticated Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth:administrator')->group( function() {
    Route::name('admin.home')->get('/', 'Admin\DashboardController@index');
    Route::name('admin')->resource('/venues', 'Admin\VenuesController');
    Route::name('admin')->resource('/events', 'Admin\EventsController');
    Route::name('admin')->resource('/users', 'Admin\UsersController');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

// User Profile Routes

Route::prefix('user')->middleware('auth:all')->group( function() {
    Route::name('user.home')->get('/', 'User\UsersController@home');
    Route::name('user.events')->get('/events', 'User\UsersController@events');
    Route::name('user.directory')->get('/directory', 'User\DirectoryController@index');
    Route::name('user.directory.show')->get('/directory/{slug}', 'User\DirectoryController@show');
});


//Route::name('user.directory')->get('/directory', 'User\DirectoryController@index')->middleware('auth:all');
//Route::name('user.directory.show')->get('/directory/{slug}', 'User\DirectoryController@show')->middleware('auth:all');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware('auth:all')->group( function () {
    Route::name('api.fetch-event')->get('/event', 'API\EventController@fetchEvent');
    Route::name('api.event-checkin')->post('/event', 'API\EventController@eventCheckIn');
    Route::name('api.get-participants')->get('/event/{id}', 'API\EventController@getParticipants');
    Route::name('api.set-role')->post('/user', 'API\UserController@setRole');

});

Route::name('api.slack-invite-request')->post('/api/slack-invite-request', 'API\SlackInviteController@processSlackInviteRequest');

/*
|--------------------------------------------------------------------------
| Temporary SparkPost mail test route
|--------------------------------------------------------------------------
*/

//Route::get('/sparkpost', function () {
//    Mail::send('mail.test', [], function ($message) {
//        $message
//            ->from('contact@txkug.com', 'TXKUG Admin')
//            ->to('stephen.dumas@smith-blair.com', 'Stephen Dumas')
//            ->subject('From TXKUG with ❤');
//  });
//});