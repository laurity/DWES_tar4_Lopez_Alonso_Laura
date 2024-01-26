<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizer = Organizer::all();
        return response()->json($organizer);
    }
    public function store(Request $request)
    {
 
        try {
            $request->validate([
                'nombre' => 'required|string',
                'contacto' => 'required|string',
            ]);
 
            $organizer = new Organizer();
            $organizer->nombre = $request->input('nombre');
            $organizer->contacto = $request->input('contacto');
            $organizer->save();
 
            return response()->json($organizer, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
 
    public function show($id)
    {
        $organizer = Organizer::find($id);
 
        if (!$organizer) {
            return response()->json(['message' => 'No se ha encontrado'], 404);
        }
 
        return response()->json($organizer);
    }
 
    public function update(Request $request, $id)
        {
            $request->validate([
                'nombre' => 'required|string',
                'contacto' => 'required|string',
            ]);
   
            $organizador = Organizer::find($id);
   
            if (!$organizador) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }
   
            $organizador->nombre = $request->input('nombre');
            $organizador->contacto = $request->input('contacto');
            $organizador->save();
            return response()->json($organizador, 200);
        }
 
    public function destroy($id)
    {
        $organizer = Organizer::find($id);
 
        if (!$organizer) {
            return response()->json(['message' => 'No se encuentra el organizador'], 404);
        } else {
            $organizer->delete();
            return response()->json(['message' => 'Organización eliminada'], 200);
        }
    }
}
