<!-- These comments are the logic how this page is implemented -->
<!-- @if ($projects->isEmpty())
<p>No projects found.</p>
@else
<ul>
    @foreach ($projects as $project)
    <li>
        <strong>{{ $project->name }}</strong>

        @if ($project->tasks->isEmpty())
        <p>No tasks found for this project.</p>
        @else
        <ul>
            @foreach ($project->tasks as $task)
            <li>{{ $task->name }} - {{ $task->status }}</li>
            @endforeach
        </ul>
        @endif
    </li>
    @endforeach
</ul>
@endif -->


@if ($projects->isEmpty())
<p>No projects found.</p>
@else
@foreach ($projects as $project)
<div id="project-list">
    <div id="{{$project->id}}" class="bg-white p-4 rounded-md shadow mb-4 mx-10">


        <div class="flex justify-between items-center">
            <div class="text-xl font-bold">{{ $project->name }}</div>

            <div class="flex items-center">
                <p class="bg-orange-200 text-black px-2 py-1 rounded-md mr-2">{{ $project->status }}</p>
                <button class="bg-yellow-500 text-white px-2 py-1 rounded-md mr-2" onclick="document.getElementById('editProjectModal{{$project->id}}').classList.remove('hidden')">
                    Edit
                </button>

                <button class="bg-red-500 text-white px-2 py-1 mr-2 rounded-md" data-project-id="{{ $project->id }}" onclick="project_delete(this)">Delete</button>

                <!-- <button class="bg-red-500 text-white px-2 py-1 mr-2 rounded-md" onclick="project_delete({{ $project->id }})">Delete</button> -->

            </div>

        </div>

        <div class="mt-2 mb-2">
            <div class="text-base text-green-700 font-medium">{{ $project->description }}</div>
        </div>

        <div class="mt-4">
            @include('components.project_edit')
        </div>

        <div class="mt-4">
            <button class="bg-green-500 text-white px-4 py-2 rounded-md shadow" onclick="document.getElementById('createTaskModal').classList.remove('hidden')">
                Create Task
            </button>
            @if ($project->tasks->isEmpty())
            <p>No tasks found for this project.</p>
            @else
            @foreach ($project->tasks as $task)
            <ul class="list-disc pl-5 mt-4">
                <li class="mb-2 flex justify-left items-center max-w-4/5 w-4/5">
                    <span>{{ $task->name }}</span>
                    <div class="flex items-center space-x-2">
                        <!-- Status Icon -->
                        <p class="bg-gray-200 text-blue-900 px-2 py-0 rounded-md ml-4 mr-2">{{ $task->status }}</p>

                        <!-- Edit Icon -->
                        <i class="fas fa-edit cursor-pointer text-yellow-500" title="Edit Task" onclick="document.getElementById('editTaskModal').classList.remove('hidden')"></i>

                        <!-- Delete Icon -->
                        <i class="fas fa-trash-alt cursor-pointer text-red-500" title="Delete Task" onclick="document.getElementById('deleteTaskModal').classList.remove('hidden')"></i>
                    </div>
                </li>
            </ul>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endforeach
@endif