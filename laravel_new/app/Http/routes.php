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

use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Illuminate\Support\Facades\Session;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/login', function() {
    return redirect('/');
});


Route::get('messages', [
    'as' => 'messages', 'uses' => 'MessagesController@index'
]);

Route::post('postSend', [
    'as' => 'postSend', 'uses' => 'MessagesController@postSend'
]);


Route::get('/message/view/{id}', [
    'as' => 'messageView', 'uses' => 'MessagesController@messageView'
]);

Route::group(['prefix' => '', 'as' => 'auth::'], function () {
    Route::get('login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
    Route::get('signup', ['as' => 'getSignup', 'uses' => 'Auth\AuthController@getRegister']);
    Route::post('signup', ['as' => 'postSignup', 'uses' => 'Auth\AuthController@postRegister']);
    Route::get('password/email', ['as' => 'getPasswordEmail', 'uses' => 'Auth\PasswordController@getEmail']);
    Route::post('password/email', ['as' => 'postPasswordEmail', 'uses' => 'Auth\PasswordController@postEmail']);
    Route::get('password/reset/{token}', ['as' => 'getPasswordReset', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('password/reset', ['as' => 'postPasswordReset', 'uses' => 'Auth\PasswordController@postReset']);
    Route::get('verify/{token}', ['as' => 'verifyUser', 'uses' => 'Auth\AuthController@verify']);
    Route::get('login/{provider?}', ['as' => 'socialLogin', 'uses' => 'Auth\AuthController@login']);
});


Route::get('/fb/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    // Send an array of permissions to request
    $login_url = $fb->getLoginUrl(['email']);

});


Route::get('/fb/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (!$token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (!$helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
                $helper->getError(), $helper->getErrorCode(), $helper->getErrorReason(), $helper->getErrorDescription()
        );
    }

    if (!$token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);
    Session::save();
    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,name,email');
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();

    echo "<pre>";
    print_r($facebook_user);
    echo "</pre>";
    exit;

    // Log the user into Laravel
    //Auth::login($user);
    Session::put('facebook', true);
    return redirect('/')->with('message', 'Successfully logged in with Facebook');
});
Route::get('fb/friends', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {

    $fb->setDefaultAccessToken(Session::get('fb_user_access_token'));
    $response = $fb->get('/me?fields=id,name,email');
    $id = $response->getGraphUser()->getproperty('id');
    $response = $fb->get("/me/taggable_friends");
    echo "<pre>";
    print_r($response);
    echo "</pre>";
    exit;
    $session = new FacebookSession(Session::get('fb_user_access_token'));
    $request = new FacebookRequest($session, 'GET', '/{friend-list-id}'
    );
    $response = $request->execute();
    $graphObject = $response->getGraphObject();
});

Route::post('fb/updata/', function(UserRepository $users, Request $request) {
    $id = $request->input('id');
    $users->updateSocialId($id, 'facebook');
});

Route::get('/dashboard', function () {
    return view('welcome_twitter');
});


Route::get('twitter/login', ['as' => 'twitter.login', function() {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }]);

        Route::get('twitter/callback', ['as' => 'twitter.callback', function(UserRepository $users) {
                // You should set this route on your Twitter Application settings as the callback
                // https://apps.twitter.com/app/YOUR-APP-ID/settings
                if (Session::has('oauth_request_token')) {
                    $request_token = [
                        'token' => Session::get('oauth_request_token'),
                        'secret' => Session::get('oauth_request_token_secret'),
                    ];

                    Twitter::reconfig($request_token);

                    $oauth_verifier = false;

                    if (Input::has('oauth_verifier')) {
                        $oauth_verifier = Input::get('oauth_verifier');
                    }

                    // getAccessToken() will reset the token for you
                    $token = Twitter::getAccessToken($oauth_verifier);

                    if (!isset($token['oauth_token_secret'])) {
                        return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
                    }

                    $credentials = Twitter::getCredentials();

                    if (is_object($credentials) && !isset($credentials->error)) {
                        // $credentials contains the Twitter user object with all the info about the user.
                        // Add here your own user logic, store profiles, create new users on your tables...you name it!
                        // Typically you'll want to store at least, user id, name and access tokens
                        // if you want to be able to call the API on behalf of your users.
                        // This is also the moment to log in your users if you're using Laravel's Auth class
                        // Auth::login($user) should do the trick.

                        $users->updateSocialId($credentials->id, 'twitter');
                        Session::put('access_token', $token);
                        Session::put('social', 'twitter');
                        return view('messages.twitter-popup');
                    }

                    return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
                }
            }]);

                Route::get('twitter/statuses', function() {
                    return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);
                });

                Route::get('twitter/settings', function() {

                    $user = Auth::user();
                    if ($user) {
                        return Twitter::getSettings(['user_id' => $user->twitter_id, 'format' => 'json']);
                    }
                    return redirect('/');
                });

                Route::get('twitter/followers', function() {
                    $user = Auth::user();
                    $access_token = session('access_token');

                    if ($user && $access_token) {
                        return Twitter::getFollowers(['user_id' => $user->twitter_id, 'format' => 'json']);
                    }
                    return redirect('/');
                });
