<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userName = Auth::user()->name;

        if ($search) {
            $users = User::where('fname', 'like', '%' . $search . '%')
                ->latest()->get();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No user found',
            ]);
        }

        return view('components.user', compact('users'));
    }

    public function store(Request $request)
    {
        $p_id = intval($request->project_id);
        $u_id = intval($request->user_id);
        $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required',
            'status' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $p_id,
            'status' => $request->status,
            'user_id' => $u_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully!',
        ]);
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update($taskid, Request $request)
    {

        $userId = intval($request->user_id);
        $projectId = intval($request->project_id);
        $status = ($request->status);
        $description = ($request->description);
        $title = ($request->title);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
            'project_id' => 'required',
        ]);

        $findTask = Task::find($taskid);

        $findTask->update([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'project_id' => $projectId,
            'user_id' => $userId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully!',
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
