<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FoodChartController extends Controller
{
    public function index() { 
        $data = DB::table('food_logs') 
            ->where('user_id', auth()->id()) 
            ->whereBetween('created_at', [now()->subDays(6), now()]) 
            ->selectRaw('DATE(created_at) as date, SUM(calories) as total_calories') 
            ->groupBy('date') 
            ->orderBy('date') 
            ->get(); 
     
        return view('dashboard.food_chart', compact('data')); 
    } 
}