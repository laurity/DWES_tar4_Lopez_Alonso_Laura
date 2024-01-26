<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function store(Request $request)
    {
 
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|',
                'password' => 'required|string',
            ]);
 
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->save();
 
            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
 
    public function show($id)
    {
        $user = User::find($id);
 
        if (!$user) {
            return response()->json(['message' => 'No se ha encontrado'], 404);
        }
 
        return response()->json($user);
    }
 
    public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|',
                'password' => 'required|string',
            ]);
   
            $user = User::find($id);
   
            if (!$user) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }
   
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->save();
            return response()->json($user, 200);
        }
 
    public function destroy($id)
    {
        $user = User::find($id);
 
        if (!$user) {
            return response()->json(['message' => 'No se encuentra el organizador'], 404);
        } else {
            $user->delete();
            return response()->json(['message' => 'Organización eliminada'], 200);
        }
    }
}
