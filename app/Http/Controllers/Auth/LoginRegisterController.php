<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Traits\ApiResponses;
use Laravel\Passport\HasApiTokens;

class LoginRegisterController extends Controller
{
    use ApiResponses;
    public function login(LoginRequest $request){
        if (!Auth::attempt($request->only('email', 'password'))) 
        {
            return $this->faildLoginResponse();
        }
    
        $user = User::where('email', $request['email'])->first();
    
        $token = $user->createToken('authToken')->plainTextToken;
    
        return $this->loginResponse(new AuthResource(auth()->user()),$token);

    }
    public function userProfile() {
        return response()->json(Auth::user());
    }


public function register(RegisterRequest $request)
{

    $user = User::create([
        'name' => $request ->name,
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
    ]);

    $token = $user->createToken('authToken')->plainTextToken;
    
    return $this->regesterResponse(new AuthResource($user),$token);

}

public function logout(Request $request)
{  
    $user = Auth::user();
        $request->user()->tokens()->delete();
        return $this->logoutResponse($user);   
    //auth()->user()->tokens()->delete();//تعمل رغم وجود خطأ
  // auth()->logout();//لا تعمل رغم عدم وجود خطأ
}
// 
}