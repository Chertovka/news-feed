<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::query()->find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Пользователь не найден']);
        }

        return response()->json(['success' => true, 'user' => new UserResource($user)]);
    }

    public function getUsers()
    {
        $users = User::query()->get();

        return response()->json(['success' => true, 'users' => new UserCollection($users)]);
    }
}
