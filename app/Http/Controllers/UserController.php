<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'required|integer',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return response()->json(['message' => 'User added successfully', 'user' => $user], 201);
    }

    public function showUsers()
    {
        $users = User::all();
        return response()->json(['message' => 'List of Users', 'users' => $users], 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
    
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'role_id' => 'required|integer',
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }
}
