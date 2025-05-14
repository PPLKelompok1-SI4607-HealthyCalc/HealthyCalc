<?php

// app/Http/Controllers/ExerciseLogController.php
namespace App\Http\Controllers;

use App\Models\ExerciseLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseLogController extends Controller
{
    public function index()
    {
        $logs = ExerciseLog::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('exercise_logs.index', compact('logs'));
    }

    public function create()
    {
        return view('exercise_logs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_type' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        ExerciseLog::create([
            'user_id' => Auth::id(),
            'activity_type' => $request->activity_type,
            'duration' => $request->duration,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('exercise-logs.index')->with('success', 'Aktivitas berhasil dicatat!');
    }

