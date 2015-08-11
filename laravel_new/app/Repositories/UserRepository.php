<?php

namespace App\Repositories;

use App\User;
use Auth;

class UserRepository
{

    public function findByUserNameOrCreate($userData, $provider)
    {
        if ($provider == "facebook") {
            $user = User::where('facebook_id', '=', $userData->id)->first();
            if (!$user) {
                $user = User::create([
                            'facebook_id' => $userData->id,
                            //    'provider' => $provider,
                            'name' => $userData->name,
                            'username' => $userData->nickname,
                            'email' => $userData->email,
                            'avatar' => $userData->avatar,
                            'active' => 1,
                ]);
            }
        } elseif ($provider == "twitter") {
            $user = User::where('twitter_id', '=', $userData->id)->first();
            if (!$user) {
                $user = User::create([
                            'twitter_id' => $userData->id,
                            //    'provider' => $provider,
                            'name' => $userData->name,
                            'username' => $userData->nickname,
                            'email' => $userData->email,
                            'avatar' => $userData->avatar,
                            'active' => 1,
                ]);
            }
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {

        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'name' => $userData->name,
            'username' => $userData->nickname,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'name' => $user->name,
            'username' => $user->username,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->name = $userData->name;
            $user->username = $userData->nickname;
            $user->save();
        }
    }

    public function updateSocialId($id, $provider)
    {

        $user = Auth::user();
        if ($user) {
            $userData = User::find($user->id);
            if ($userData) {
                if ($provider == "facebook") {
                    $userData->facebook_id = $id;
                } elseif ($provider == "twitter") {
                    $userData->twitter_id = $id;
                }
                $userData->save();
                
            }
        }
    }

}
