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
            if (!Auth::attempt($request->only('username', 'password'))) {
                return response(["success" => false], 403);
            }
            $user = User::where('username', $request->input('username'))->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

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
