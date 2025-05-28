<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeightProgressController extends Controller
{
    public function index()
    {
        $weights = DB::table('weight_logs')
            ->where('user_id', auth()->id())
            ->orderBy('date')
            ->get();

        return view('dashboard.weight_progress', compact('weights'));
    }
}