<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $projects = $user->projects()->withCount('tasks')->get();

        $tasksByStatus = Task::whereHas('users', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })
        ->with('status')
        ->get()
        ->groupBy('status.name');

        return view('dashboard.index', compact(
            'projects',
            'tasksByStatus'
        ));
    }
}
