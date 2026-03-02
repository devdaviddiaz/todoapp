<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
        ->withCount('tasks')
        ->latest()
        ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);*/

        $baseRules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $baseRules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $request->user()->projects()->create($validator->validated());

        return response()->json([
            'message' => 'Project created successfully ✅',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        if ($project->user_id !== Auth::id()) 
        {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) 
        {
            abort(403);
        }

        $baseRules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $baseRules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $project->update($validator->validated());

        return response()->json([
            'message' => 'Project edited successfully ✅',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->user_id !== Auth::id())
        {
            abort(403);
        }

        $project->delete();

        Cache::flush();

        return response()->json([
            'message' => 'Project successfully deleted 🗑️',
        ]);
    }
}
