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

    @if(session()->has('user'))
    <!-- Navbar -->
    <x-nav userMode="User Mode" />

    <!-- Main Content -->
    <div class="container mt-6 w-auto mx-10">
        <!-- Search Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="w-full md:w-2/3">
                <input type="text" placeholder="Search projects, tasks, users..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            </div>
            <div class="ml-4">
                <button class="bg-green-500 text-white px-4 py-2 rounded-md shadow">Search</button>
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

    <!-- Projects and Tasks List -->
    <div>
        <!-- Example Project -->
        <div class="bg-white p-4 rounded-md shadow mb-4 mx-10">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold">Project 1</div>

                <div class="flex items-center">
                    <p class="bg-orange-200 text-black px-2 py-1 rounded-md mr-2">Status</p>
                    <button class="bg-yellow-500 text-white px-2 py-1 rounded-md mr-2" onclick="document.getElementById('editProjectModal').classList.remove('hidden')">
                        Edit
                    </button>

                    <button class="bg-red-500 text-white px-2 py-1 mr-2 rounded-md">Delete</button>

                </div>
            </div>
            <div class="mt-4">
                <button class="bg-green-500 text-white px-4 py-2 rounded-md shadow" onclick="document.getElementById('createTaskModal').classList.remove('hidden')">
                    Create Task
                </button>
                <ul class="list-disc pl-5 mt-4">
                    <li class="mb-2 flex justify-left items-center max-w-4/5 w-4/5">
                        <span>Task 1 (Assigned to User A)</span>
                        <div class="flex items-center space-x-2">
                            <!-- Status Icon -->
                            <p class="bg-gray-200 text-blue-900 px-2 py-0 rounded-md ml-4 mr-2">Status</p>

                            <!-- Edit Icon -->
                            <i class="fas fa-edit cursor-pointer text-yellow-500" title="Edit Task" onclick="document.getElementById('editTaskModal').classList.remove('hidden')"></i>

                            <!-- Delete Icon -->
                            <i class="fas fa-trash-alt cursor-pointer text-red-500" title="Delete Task" onclick="document.getElementById('deleteTaskModal').classList.remove('hidden')"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Modals -->
    <!-- Create Project Modal -->
    <div id="createProjectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Create New Project</h2>
            <form>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Project Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('createProjectModal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="editProjectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Project</h2>
            <form>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Project Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="Existing Project Name">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('editProjectModal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div id="createTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Create New Task</h2>
            <form>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Task Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Status</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option>Select Status</option>
                        <option>New</option>
                        <option>Processing</option>
                        <option>Done</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Assign to User</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option>Select User</option>
                        <option>User A</option>
                        <option>User B</option>
                        <option>User C</option>
                    </select>
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

    <!-- Edit Task Modal -->
    <div id="editTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Task</h2>
            <form>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Task Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="Existing Task Name">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Status</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option>Select Status</option>
                        <option>New</option>
                        <option>Processing</option>
                        <option>Done</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-bold">Assign to User</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option>Select User</option>
                        <option>User A</option>
                        <option>User B</option>
                        <option>User C</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('editTaskModal').classList.add('hidden')">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow">Update</button>
                </div>
            </form>
        </div>
    </div>


    <!--Logout for invalid session id -->
    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
        @csrf
    </form>
    @else
    <!-- If the session variable 'user' is not set, submit the logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script type="text/javascript">
        document.getElementById('logout-form').submit();
    </script>
    @endif
</body>


</html>