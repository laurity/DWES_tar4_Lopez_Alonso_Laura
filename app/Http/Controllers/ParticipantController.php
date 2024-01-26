<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::all();
        return response()->json($participants);
    }
    public function store(Request $request)
    {
 
        try {
            $request->validate([
                'nombre' => 'required|string',
                'email' => 'required|string',
            ]);
 
            $participants = new Participant();
            $participants->nombre = $request->input('nombre');
            $participants->email = $request->input('email');
            $participants->save();
 
            return response()->json($participants, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
 
    public function show($id)
    {
        $participants = Participant::find($id);
 
        if (!$participants) {
            return response()->json(['message' => 'No se ha encontrado'], 404);
        }
 
        return response()->json($participants);
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string',
        ]);
 
        $participants = Participant::find($id);
 
        if (!$participants) {
            return response()->json(['message' => 'No se pudo encontrar al usuario'], 404);
        }
 
        $participants->update($request->all());
 
        return response()->json($participants, 200);
    }
 
    public function destroy($id)
    {
        $participants = Participant::find($id);
 
        if (!$participants) {
            return response()->json(['message' => 'No se encuentra el Participantso'], 404);
        } else {
            $participants->delete();
            return response()->json(['message' => 'Participantso eliminado'], 200);
        }
    }
}
