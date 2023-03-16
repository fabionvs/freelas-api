<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chain;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Services\AuthService;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request){
        $result = $this->authService->verifySignature(session()->pull('sign_message'), $request->input('signature'), $request->input('address'));
        if ($result) {
            $user = User::firstOrCreate([
                'eth_address' => $request->input('address')
            ], [
                'eth_address' => $request->input('address'),
                'last_login' => Carbon::now()
            ]);
            $login = Auth::login($user);
            $chain = Redis::set('user:chain:'.Auth::user()->id, intval($request->input('chain_id')));
            return response([
                "success" => true,
                'user' => [
                    'eth_address' => Auth::user()->eth_address,
                    'photo' => Auth::user()->photo,
                    'username' => Auth::user()->username,
                ],
                'new_user' => (Auth::user()->email == null)
            ], 200);
        } else {
            return response(["success" => false], 403);
        }

    }

    public function sign()
    {
        $token = $this->authService->sign();

        return response([
            "success" => true,
            'token' => $token
        ], 200);
    }

    public function signup(SignupRequest $request)
    {
        $response = $this->authService->signup($request);

        return response( $response, 200);
    }

    public function logout()
    {
        Auth::logout();

        return response(["success" => true], 200);
    }


    public function me(Request $request)
    {
        $response = $this->authService->me($request);
        return response($response, 200);
    }

}
