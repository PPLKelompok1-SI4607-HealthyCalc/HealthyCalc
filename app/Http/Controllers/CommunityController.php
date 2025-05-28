<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Community;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communities_trending = Community::with('user')
            ->orderBy('like')
            ->take(2)
            ->get();
        $communities = Community::with('user')->latest()->paginate(6); // ;
        $users = User::with('communities')->get();
        return view('community.index', compact( 'communities_trending','communities', 'users'));
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
    public function store(StoreCommunityRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Diet,Olahraga,Kesehatan,Umum',
        ]);

        $validated['user_id'] = auth()->user()->id;

        Community::create($validated);

        return redirect()->route('communities.index')->with('success', 'Community created successfully.');    
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        $community = Community::with('user')->find($community->id);
        // $replies = $community->replies()->with('user')->get();
        return view('community.show', compact('community', ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Diet,Olahraga,Kesehatan,Umum',
        ]);

        $community->update($validated);

        return redirect()->route('communities.index')->with('success', 'Community updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        $community->delete();

        return redirect()->route('communities.index')->with('success', 'Community deleted successfully.');
    }
}
