<?php

namespace App\Http\Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function signup($request)
    {

            $user = User::create([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password'))
            ]);
            $business = Business::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'hashtags' => $request->input('hashtags'),
                'website' => $request->input('website'),
                'horarios' => $request->input('horarios'),
                'info_adicionais' => $request->input('info_adicionais'),
                'user_id' => $user->id,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'category_id' => $request->input('category_id'),
            ]);


            if (!Auth::attempt($request->only('username', 'password'))) {
                return response(["success" => false], 403);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            if($user){

                return  [
                    "success" => true,
                    "user" => $user,
                    "token" => $token,
                    "business_id" => $business->id
                ];
            }
            return  [
                "success" => false,
            ];

    }


    public function me($request)
    {
        if(Auth::user() !== null){
            return [
            "success" => true,
            'user' => [
                'photo' => Auth::user()->photo,
                'username' => Auth::user()->username,
            ]
        ];
        }else{
            return ["success" => true, 'user' => null];
        }
    }

}
