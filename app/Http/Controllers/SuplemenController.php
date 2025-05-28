<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Suplemen;
use App\Models\SuplemenHistory;
use App\Http\Requests\StoreSuplemenRequest;
use App\Http\Requests\UpdateSuplemenRequest;

class SuplemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all suplemen data
        $suplemens = Suplemen::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $suplemen_histories = SuplemenHistory::with('suplemen')
            ->whereHas('suplemen', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        foreach ($suplemen_histories as $history) {
            $time = Carbon::parse($history->time);
            $now = Carbon::now();
            $diffInDays = $time->diffInDays($now, false);

            if ($diffInDays === 0) {
                $formatted = 'Dikonsumsi hari ini, ' . $time->format('H:i');
            } elseif ($diffInDays === 1) {
                $formatted = 'Kemarin, ' . $time->format('H:i');
            } elseif ($diffInDays > 1) {
                $formatted = $diffInDays . ' hari yang lalu, ' . $time->format('H:i');
            } else {
                $formatted = $time->translatedFormat('l, d F Y') . ', ' . $time->format('H:i');
            }

            $history->setAttribute('formatted_time', $formatted);
        }
        // Return the view with the suplemen data
        return view('suplemen.index', compact('suplemens', 'suplemen_histories'));
    }

    public function konsumsi($id)
    {
        $suplemen = Suplemen::findOrFail($id);

        SuplemenHistory::create([
            'suplemen_id' => $suplemen->id,
            'waktu_konsumsi' => now(),
            'status' => 'sudah'
        ]);

        return back()->with('success', 'Konsumsi dicatat.');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuplemenRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();
        // Set the user_id to the authenticated user's id
        $validatedData['user_id'] = auth()->id();

        // Create a new suplemen
        Suplemen::create($validatedData);

        // Redirect to the suplemen index with a success message
        return redirect()->route('suplemens.index')->with('success', 'Suplemen created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suplemen $suplemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suplemen $suplemen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuplemenRequest $request, Suplemen $suplemen)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Update the suplemen
        $suplemen->update($validatedData);

        // Redirect to the suplemen index with a success message
        return redirect()->route('suplemens.index')->with('success', 'Suplemen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suplemen $suplemen)
    {
        $suplemen->delete();
        return back()->with('success', 'Suplemen berhasil dihapus.');
    }
}
