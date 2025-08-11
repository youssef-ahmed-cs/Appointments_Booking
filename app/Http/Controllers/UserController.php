<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function show(int $id)
    {
        $user = User::find($id);
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        return response()->json($user);
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
            'user' => $user
        ]);
    }
}
