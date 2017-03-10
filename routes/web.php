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
    Route::name('admin')->resource('/members', 'Admin\MembersController');
    Route::name('admin')->resource('/community-links', 'Admin\CommunityLinksController');
});

/*
|--------------------------------------------------------------------------
| Authenticated Member Routes
|--------------------------------------------------------------------------
*/

// Member Routes

Route::prefix('members')->middleware('auth:all')->group( function() {
    Route::name('members.index')->get('/', 'Members\DirectoryController@index');

    Route::name('members.community-links.index')->get('/community-links', 'Members\CommunityLinksController@index');
    Route::name('members.community-links.store')->post('/community-links', 'Members\CommunityLinksController@store');
    Route::name('members.community-links.channel')->get('/community-links/{channel}', 'Members\CommunityLinksController@index');
    Route::name('members.community-links.votes.store')->post('/community-links/votes/{link}', 'Members\CommunityLinksVotesController@store');

    Route::name('members.show')->get('/{slug}', 'Members\DirectoryController@show');
//    Route::name('members.directory.show')->get('/directory/{slug}', 'Members\DirectoryController@show');
});

// Profile Routes
// {slack_handle} Global Route Constraint defined in RouteServiceProvider

Route::prefix('{slack_handle}')->middleware('auth:all')->group( function() {
    Route::name('{slack_handle}.index')->get('/', 'Profile\ProfileController@index');
    Route::name('{slack_handle}.events')->get('/my-events', 'Profile\EventsController@index');
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware('auth:all')->group( function () {
    Route::name('api.fetch-event')->get('/event', 'API\EventController@fetchEvent');
    Route::name('api.event-checkin')->post('/event', 'API\EventController@eventCheckIn');
    Route::name('api.get-participants')->get('/event/{id}', 'API\EventController@getParticipants');
    Route::name('api.set-role')->post('/member', 'API\MemberController@setRole');
    Route::name('api.approve-community-link')->post('/community-links', 'API\CommunityLinksController@setApproval');
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
//            ->to('randy.rankin@smith-blair.com', 'Randy Rankin')
//            ->subject('From TXKUG with ❤');
//  });
//});