<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;

class DashboardController extends Controller
{
    // Show the dashboard view
    public function index()
    {
        return view('dashboard');
    }

    // Return calendar data as JSON
    public function calendarData()
    {
        $assessments = Assessment::select('id', 'due_date', 'first_name', 'last_name')->get();

        $events = $assessments->map(function ($item) {
            return [
                'title' => $item->first_name . ' ' . $item->last_name,
                'start' => $item->due_date,
                'url' => route('assessments.show', $item->id), // optional
            ];
        });

        return response()->json($events);
    }
}
