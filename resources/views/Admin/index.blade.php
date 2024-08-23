<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite('resources/css/app.css')
    <!-- Load jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="bg-gray-100">
    @if(Auth::check())

    <!-- Navbar -->
    <x-nav userMode="Admin Mode" />
    <div id="success-message" class="hidden bg-green-100 text-blue-700 p-2 mb-4 rounded"></div>

    <!-- Main Content -->
    <div class="container mt-6 w-auto mx-10">
        <!-- Search Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="w-full md:w-2/3">
                <input type="search" id="search" placeholder="Search projects, tasks, users..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" onclick="search()">
            </div>
        </div>

        <!-- Project and Task Creation Buttons -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md shadow" onclick="document.getElementById('createProjectModal').classList.remove('hidden')">
                    Create New Project
                </button>
            </div>
        </div>
    </div>


    <!-- Modals -->
    <!-- Create Project Modal -->
    <div id="createProjectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Create New Project</h2>
            <form id="project-form">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Project Name</label>
                    <input type="text" id="create-project-name" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Description</label>
                    <input type="text" id="create-project-description" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Status</label>
                    <select id="create-project-status" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="">Select Status</option>
                        <option value="new">New</option>
                        <option value="in_progress">Processing</option>
                        <option value="completed">Done</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('createProjectModal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow" onclick="createProject(event)">Create</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Create Task Modal -->
    <div id="createTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Create New Task</h2>
            <form id="task-create-form" onsubmit="create_task(event)">
                @csrf
                <input type="hidden" id="task-project-id">
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Task Name</label>
                    <input id="task-title" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Task Description</label>
                    <input id="task-description" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Status</label>
                    <select id="task-status" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="new">Select Status</option>
                        <option value="new">New</option>
                        <option value="Pending">Processing</option>
                        <option value="completed">Done</option>
                    </select>
                </div>

                <!-- User Assigned To -->
                <div class="mb-4">
                    <div class="mb-4">
                        <label for="user-search" class="block mb-1 font-bold">Assign to (Type name and select from suggestion)</label>
                        <input type="text" id="user-search" autocomplete="off" placeholder="Type a user name and select from suggestions..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" onclick="initiateSearch()">
                        <input type="hidden" id="user-id">
                        <div id="user-list" style="display:none;">
                            <ul id="user-suggestions"></ul>
                        </div>
                    </div>
                </div>


                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('createTaskModal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow">Create</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Projects and Tasks List -->
    <div id="projects_tasks">
        <!-- Example Project -->
        @include('components.project_list')
    </div>


    <!--Logout for invalid session id -->
    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
        @csrf
    </form>
    @else
    <!-- If the session variable 'user' is not set, submit the logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        <!-- @csrf -->
    </form>
    <script type="text/javascript">
        document.getElementById('logout-form').submit();
    </script>
    @endif


    <!-- Sending routes to the external js file -->
    <script>
        var csrfToken = "{{ csrf_token() }}";
        var searchUsersUrl = "{{ route('search-users') }}";
        var Projects_Store_Route = '{{ route("projects.store") }}';
        var Show_ProjectList_Route = '{{ route("showprojects") }}?search=';
        var Delete_Project_Route = `/deleteProject`;
        var Task_Create_Route = '{{ route("taskCreate") }}';
        var Projects_Update_Route = `/updateProject/`;
        var Task_Update_Route = `/taskUpdate/`;
    </script>

    <!-- Link your external JavaScript file -->
    <script src="{{ asset('js/index.js') }}"></script>
</body>


</html>