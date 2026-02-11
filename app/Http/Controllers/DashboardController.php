<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*dd(
            get_class($user),
            method_exists($user, 'projects'),
            $user->projects()->count()
        );*/

        $projects = $user->projects()->withCount('tasks')->get();

        $tasksByStatus = Task::whereHas('users', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        })
        ->with('status')
        ->get()
        ->groupBy('status.name');

        return view('dashboard', compact(
            'projects',
            'tasksByStatus'
        ));
    }
}
