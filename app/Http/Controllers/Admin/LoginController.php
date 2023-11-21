<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\User\LoginUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        // login with sanctum using email and password
        $admin = User::where('email', $request->email)->orWhere('username', $request->email)->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $token = $admin->createToken('token')->plainTextToken;
                return responseJson(200, 'success', ['token' => $token, 'user' => new LoginUserResource($admin)]);
            }
        }
        return responseJson(400, 'invalid credentials');
    }

    public function profile(Request $request)
    {
        $admin = $request->user();
        return responseJson(200, 'success', ['user' => new LoginUserResource($admin)]);
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        return responseJson(200, 'logged out');
    }

}
