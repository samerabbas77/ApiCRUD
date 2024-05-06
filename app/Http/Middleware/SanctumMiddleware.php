<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class SanctumMiddleware
{
        
            /**
             * Handle an incoming request.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  \Closure  $next
             * @return mixed
             */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Check if the request contains a bearer token
            $token = $request->bearerToken();

            if (!$token) {
                throw new \Exception('Authorization Token not found', 401);
            }

            // Find the token from the database
            $accessToken = PersonalAccessToken::findToken($token);

            if (!$accessToken) {
                throw new \Exception('Token is Invalid', 401);
            }

            // Authenticate the user using the tokenable_id (user ID)
            $user = Auth::loginUsingId($accessToken->tokenable_id);

            if (!$user) {
                throw new \Exception('Unauthorized', 401);
            }

        } catch (\Exception $e) {
            // Handle different exception scenarios
            $message = $e->getMessage();
            $status = $e->getCode() ?: 500;

            if ($status === 401) {
                // Token-related errors
                if ($message === 'Authorization Token not found') {
                    return response()->json(['error' => 'Authorization Token not found'], 401);
                } elseif ($message === 'Token is Invalid') {
                    return response()->json(['error' => 'Token is Invalid'], 401);
                }
            }

            // Default error response
            return response()->json(['error' => $message], $status);
        }

        // Proceed with the authenticated request
        return $next($request);
    }
        


}







   



