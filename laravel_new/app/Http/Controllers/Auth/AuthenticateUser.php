<?php

namespace App;

// AuthenticateUser.php


use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users)
    {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($request, $listener, $provider)
    {
        if (!$request)
            return $this->getAuthorizationFirst($provider);
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider), $provider);

        $this->auth->login($user, true);
        if($user->facebook_id){
        Session::put('facebook', $user->facebook_id);
      }
      if($user->twitter_id){
      Session::put('twitter', $user->twitter_id);
    }
        Session::put('social', $provider); // for identify user login type
    //  dd(\Session::all());
      return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }

}
