<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            User::updateUserInfo($user, $request);
            return Response()->json([
                'result' => true,
                'message' => "user updated",
                'data' => [
                    'user' => new UserResource($user)
                ]
            ], 201);
        } else {
            return Response()->json([
                'result' => false,
                'message' => "user not found",
                'data' => []
            ], 403);
        }
    }
}
