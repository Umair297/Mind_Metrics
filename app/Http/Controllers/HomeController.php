<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Assessment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
    
        if ($user->role === 'admin') {
            // Admin sees everything
            $totalUsers = User::count();
            $adminUsers = User::where('role', 'admin')->count();
            $clientUsers = User::where('role', 'client')->count();
    
            $totalServices = Service::count();
            $assignedServices = Service::where('status', 'Assigned')->count();
            $receivedServices = Service::where('status', 'Received')->count();
    
            $totalAssessment = Assessment::count();
            $receivedAssessment = Assessment::where('status', 'Received')->count();
            $assignedAssessment = Assessment::where('status', 'Assigned')->count();
            $in_ProgressAssessment = Assessment::where('status', 'In Progress')->count();
            $completedAssessment = Assessment::where('status', 'Completed')->count();
    
            $assessments = Assessment::all();
            $users = User::orderBy('created_at', 'DESC')->get();
    
        } else {
            // Client sees only their own data
            $totalUsers = null;
            $adminUsers = null;
            $clientUsers = null;
    
            $totalServices = Service::where('user_id', $user->id)->count();
            $assignedServices = Service::where('user_id', $user->id)->where('status', 'Assigned')->count();
            $receivedServices = Service::where('user_id', $user->id)->where('status', 'Received')->count();
    
            $totalAssessment = Assessment::where('user_id', $user->id)->count();
            $receivedAssessment = Assessment::where('user_id', $user->id)->where('status', 'Received')->count();
            $assignedAssessment = Assessment::where('user_id', $user->id)->where('status', 'Assigned')->count();
            $in_ProgressAssessment = Assessment::where('user_id', $user->id)->where('status', 'In Progress')->count();
            $completedAssessment = Assessment::where('user_id', $user->id)->where('status', 'Completed')->count();
    
            $assessments = Assessment::where('user_id', $user->id)->get();
            $users = collect();
        }
    
        return view('dashboard', compact(
            'totalUsers', 'adminUsers', 'clientUsers',
            'totalServices', 'assignedServices', 'receivedServices',
            'totalAssessment', 'receivedAssessment', 'assignedAssessment',
            'in_ProgressAssessment', 'completedAssessment', 'assessments', 'users'
        ));
    }
    
}
