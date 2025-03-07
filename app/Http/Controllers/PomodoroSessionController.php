<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PomodoroSession;

class PomodoroSessionController extends Controller
{
    public function startSession(Request $request)
    {
        $session = PomodoroSession::create([
            'user_id' => auth()->id(),
            'task_id' => $request->task_id,
            'session_type' => $request->session_type,
            'status' => 'ongoing'
        ]);

        return response()->json($session, 201);
    }

    public function endSession($id)
    {
        $session = PomodoroSession::findOrFail($id);
        $session->update(['status' => 'completed', 'end_time' => now()]);
        return response()->json(['message' => 'Session ended']);
    }

    public function skipSession($id)
    {
        $session = PomodoroSession::findOrFail($id);
        $session->update(['status' => 'skipped', 'end_time' => now()]);
        return response()->json(['message' => 'Session skipped']);
    }
}
