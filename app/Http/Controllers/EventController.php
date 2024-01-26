<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participant;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();
        return response()->json($event);
    }
    public function store(Request $request)
    {
 
        try {
            $request->validate([
                'organizer_id' => 'required|integer',
                'nombre_evento' => 'required|string',
                'ubicacion' => 'required|string',
                'fecha' => 'required|date',
            ]);
 
            $event = new Event();
            $event->organizer_id = $request->input('organizer_id');
            $event->nombre_evento = $request->input('nombre_evento');
            $event->fecha = $request->input('fecha');
            $event->ubicacion = $request->input('ubicacion');
            $event->save();
 
            return response()->json($event, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
 
    public function show($id)
    {
        $event = Event::find($id);
 
        if (!$event) {
            return response()->json(['message' => 'No se ha encontrado'], 404);
        }
 
        return response()->json($event);
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'organizer_id' => 'required|integer' . $id,
            'nombre_evento' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha' => 'required|date',
        ]);
 
        $event = Event::find($id);
 
        if (!$event) {
            return response()->json(['message' => 'No se pudo encontrar al usuario'], 404);
        }
 
        $event->update($request->all());
 
        return response()->json($event, 200);
    }
 
    public function destroy($id)
    {
        $event = Event::find($id);
 
        if (!$event) {
            return response()->json(['message' => 'No se encuentra el evento'], 404);
        } else {
            $event->delete();
            return response()->json(['message' => 'Evento eliminado'], 200);
        }
    }
    public function attachParticipant($eventID, $participantId)
    {
        $event = Event::find($eventID);
        $participantId = Participant::find($participantId);
 
        if (!$event || !$participantId) {
            return response()->json([
                'message' => 'El evento o participante no se encontraron'
            ], 404);
        }
 
        $event->participants()->attach($participantId);
        return response()->json([
            'message' => 'Se ha adjuntado correctamente el participante al evento'
        ], 200);
    }
 
    public function detachParticipant($eventID, $participantId)
    {
        $event = Event::find($eventID);
        $participantId = Participant::find($participantId);
        if (!$event || !$participantId) {
            return response()->json([
                'message' => 'El evento o participante no se encontraron'
            ], 404);
        }
 
        $event->participants()->dettach($participantId);
        return response()->json([
            'message' => 'Se ha desvinculado correctamente el participante del evento'
        ], 200);
    }
}
