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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userId = Auth::user()->id;
        // $userId = "2";

        if ($search) {
            $projects = Project::where('user_id', $userId)
                ->where('name', 'like', '%' . $search . '%')
                ->with('tasks')  // Eager load tasks
                //->where('name', 'like', '%' . $search . '%')
                ->latest()->get();
        } else {
            $projects = Project::where('user_id', $userId)
                ->with('tasks')  // Eager load tasks
                ->latest()->get();
        }


        if ($request->ajax()) {
            return view('components.project_list', compact('projects'))->render();
        }

        // return view('components.project_list', compact('projects'))->render();
        return view('admin.index', compact('projects'));
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
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);



        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string'
        ]);


        if ($project->user_id === Auth::user()->id) {
            // Update the project details
            $project->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status
            ]);

            // Return a JSON response indicating success
            return response()->json(['success' => true]);
        }

        // Return a JSON response indicating failure
        return response()->json(['success' => false], 403);
    }

    public function destroy(Request $request)
    {
        $id = $request->header('Project-ID'); // Retrieve project ID from the headers
        $project = Project::findOrFail($id);

        // Ensure that the user owns the project
        if ($project->user_id === Auth::user()->id) {
            $project->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
        // return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
