<?php

namespace App\Http\Controllers;

use App\Models\ErrorTracking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function test()
    {
        dd('test');
    }




    public function dashboard()
    {
        // Total error trackings
        $totalErrorTrackings = ErrorTracking::count();

        // Resolved error trackings
        $resolvedErrorTrackings = ErrorTracking::where('status', 'Resolved')->count();

        // In-progress error trackings
        $inProgressErrorTrackings = ErrorTracking::where('status', 'In Progress')->count();

        // dd($totalErrorTrackings, $resolvedErrorTrackings, $inProgressErrorTrackings);


        // Pass the data to the view
        return view('dashboard', compact('totalErrorTrackings', 'resolvedErrorTrackings', 'inProgressErrorTrackings'));
    }

}