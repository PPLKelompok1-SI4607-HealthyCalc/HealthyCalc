<?php

namespace App\Http\Controllers;

use App\Models\Calory;
use App\Http\Requests\StoreCaloryRequest;
use App\Http\Requests\UpdateCaloryRequest;

class CaloryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('calory.index');
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
    public function store(StoreCaloryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calory $calory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calory $calory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaloryRequest $request, Calory $calory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calory $calory)
    {
        //
    }
}
