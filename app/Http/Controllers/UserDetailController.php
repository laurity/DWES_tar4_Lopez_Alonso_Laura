<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;

class UserDetailController extends Controller
{
    public function index()
    {
        $userdetail = UserDetail::all();
        return response()->json($userdetail);
    }
    public function store(Request $request)
    {
 
        try {
            $request->validate([
                'user_id' => 'required|integer',
                'direccion' => 'required|string',
                'telefono' => 'required|string|',
            ]);
 
            $userdetail = new UserDetail();
            $userdetail->user_id = $request->input('user_id');
            $userdetail->direccion = $request->input('direccion');
            $userdetail->telefono = $request->input('telefono');
            $userdetail->save();
 
            return response()->json($userdetail, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
 
    public function show($id)
    {
        $userdetail = UserDetail::find($id);
 
        if (!$userdetail) {
            return response()->json(['message' => 'No se ha encontrado'], 404);
        }
 
        return response()->json($userdetail);
    }
 
    public function update(Request $request, $id)
        {
            $request->validate([
                'user_id' => 'required|integer',
                'direccion' => 'required|string',
                'telefono' => 'required|string|',
            ]);
   
            $userdetail = UserDetail::find($id);
   
            if (!$userdetail) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }
   
            $userdetail->user_id = $request->input('user_id');
            $userdetail->direccion = $request->input('direccion');
            $userdetail->telefono = $request->input('telefono');
            $userdetail->save();
            return response()->json($userdetail, 200);
        }
 
    public function destroy($id)
    {
        $userdetail = UserDetail::find($id);
 
        if (!$userdetail) {
            return response()->json(['message' => 'No se encuentra el organizador'], 404);
        } else {
            $userdetail->delete();
            return response()->json(['message' => 'Organización eliminada'], 200);
        }
    }
}
