@if ($projects->isEmpty())
<p>No projects found.</p>
@else

<div id="project-list">
    @foreach ($projects as $project)
    <div id="{{$project->id}}" class="bg-white p-4 rounded-md shadow mb-4 mx-10">

        <div class="flex justify-between items-center">
            <div class="text-xl font-bold">{{ $project->name }}</div>

            <div class="flex items-center">
                <p class="bg-orange-200 text-black px-2 py-1 rounded-md mr-2">{{ $project->status }}</p>
                <button class="bg-yellow-500 text-white px-2 py-1 rounded-md mr-2" onclick="document.getElementById('editProjectModal{{$project->id}}').classList.remove('hidden')">
                    Edit
                </button>

                <button class="bg-red-500 text-white px-2 py-1 mr-2 rounded-md" data-project-id="{{ $project->id }}" onclick="project_delete(this)">Delete</button>

            </div>
        </div>

        <div class="mt-0 mb-2 px-2 ">
            <div class="text-base text-justify text-green-700 font-medium">{{ $project->description }}</div>
        </div>

        <div class="mt-4">
            @include('components.project_edit')
        </div>

        <div class="mt-4">
            <button class="bg-green-500 text-white px-2 py-1 rounded-md shadow" onclick="document.getElementById('createTaskModal').classList.remove('hidden'); document.getElementById('task-project-id').value='{{$project->id}}'">
                Create Task
            </button>
            @if ($project->tasks->isEmpty())
            <p>No tasks found for this project.</p>
            @else
            @foreach ($project->tasks as $task)
            <ul class="pl-1 my-4">
                <li class="mb-3 flex items-baseline max-w-4/5 w-4/5">
                    <div class="grid grid-row bg-gray-50 text-blue-900 py-2 px-1 w-full rounded-md">
                        <div class="bg-lime-200 p-1 w-full text-blue-900 font-semibold flex justify-between rounded-md">
                            <p class="ml-4">{{ $task->title }}</p>

                            <!-- Status Icon -->
                            <p class="bg-amber-100 text-black mx-4 my-1 px-2 py-0 rounded-md font-normal text-xs max-w-fit">{{ $task->status }}</p>

                        </div>
                        <div class="w-full px-5 py-3 text-justify">{{ $task->description }}</div>
                        <div class="inline-block p-3 font-semibold text-xs text-blue-600 rounded-md">
                            Assigned To:
                            <p id="{{ $task->user_id }}" class="bg-slate-600 px-1 py-0 text-white text-center text-xs inline-block rounded-xl min-w-12 max-w-fit">
                                {{ strtolower($task->users->fname)}}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">

                        <!-- Edit Icon -->
                        <input type="hidden" id="{{$task->id}}" value='@json($task)'>
                        <i class="fas fa-edit ml-4 cursor-pointer text-yellow-500" title="Edit Task" onclick='document.getElementById("editTaskModal").classList.remove(`hidden`)'></i>

                        <!-- Delete Icon -->
                        <i class="fas fa-trash-alt cursor-pointer text-red-500" title="Delete Task" onclick="document.getElementById('deleteTaskModal').classList.remove('hidden')"></i>
                    </div>
                </li>
            </ul>
            <div class="mt-4">
                @include('components.task_edit')
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>

@endif