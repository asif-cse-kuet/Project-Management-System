<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'user_id' => 'nullable'
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id, // Admin who created the project
            'status' => $request->status,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Project created successfully!',
            // 'project' => $request,
            // 'user' => Auth::user()
        ]);

        // if (Auth::user()->role === 'admin') {
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Project created successfully!',
        //         // 'project' => $request,
        //         // 'user' => Auth::user()
        //     ]);
        // } elseif (Auth::user() === 'user') {
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Project created successfully!',
        //         // 'project' => $request,
        //         // 'user' => Auth::user()
        //     ]);
        // }
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
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
