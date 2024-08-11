<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    @if(session()->has('user'))

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
        @csrf
    </form>
    <script type="text/javascript">
        document.getElementById('logout-form').submit();
    </script>
    @endif



    <script type="text/javascript">
        function createProject(event) {
            event.preventDefault();
            fetch('{{ route("projects.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: document.getElementById('create-project-name').value,
                        description: document.getElementById('create-project-description').value,
                        status: document.getElementById('create-project-status').value
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        // Handle non-200 responses
                        return response.json().then(errorData => {
                            throw new Error('Server Error');
                        });
                    }
                })
                .then(data => {

                    if (data.success) {
                        const successMessage = document.getElementById('success-message');
                        successMessage.textContent = data.message;
                        successMessage.classList.remove('hidden');

                        // Hide the message after 3 seconds
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                        }, 3000);

                        document.getElementById('createProjectModal').classList.add('hidden');
                        document.getElementById('project-form').reset();

                        //Updating the project list
                        fetch('{{ route("showprojects") }}?search=', {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('project-list').innerHTML = data;
                                console.log(data);
                            });
                    }
                })
                .catch(error => {
                    // Handle the error
                    alert('Something went wrong. Please try again.');
                    console.error('Error:', error); // Log the error for debugging
                });
        }

        function search() {
            console.log("Search Called");
            document.getElementById('search').addEventListener('input', function() {
                let query = this.value;
                fetch('{{ route("showprojects") }}?search=' + query, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('project-list').innerHTML = data;
                        // console.log(data);
                    });
            });
        }

        function project_delete(button) {
            const projectId = button.getAttribute('data-project-id');
            if (!confirm("Are you sure you want to delete this project?" + projectId)) {

                return;
            }

            fetch(`/deleteProject`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Project-ID': projectId
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the project from the DOM
                        document.getElementById(`${projectId}`).remove();
                    } else {
                        alert('Failed to delete the project.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function project_update(button) {

            let projectId = button.getAttribute('data-project-id-edit');
            // let formData = new FormData(document.getElementById('update-project-form').value);
            let name = document.getElementById('edit-project-name').value;
            let description = document.getElementById('edit-project-description').value;
            let status = document.getElementById('edit-project-status').value;

            console.log(description, status, name);
            fetch(`/updateProject/${projectId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ // Stringify the body
                        'name': name,
                        'description': description,
                        'status': status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const successMessage = document.getElementById('success-message');
                    if (data.success) {
                        successMessage.innerText = 'Project updated successfully!';
                        // successMessage.classList.replace('bg-green-100', 'bg-gray-100');
                        successMessage.classList.remove('hidden');
                        console.log("Works");

                        //Updating project lists
                        fetch('{{ route("showprojects") }}?search=', {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('project-list').innerHTML = data;
                                // console.log(data);
                            });


                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                            // successMessage.classList.replace('bg-green-100', 'bg-red-100');
                        }, 3000);
                    } else {
                        const successMessage = document.getElementById('success-message');
                        successMessage.innerText = 'Project Update Failed';
                        successMessage.classList.replace('bg-green-100', 'bg-orange-100');
                        successMessage.classList.replace('text-blue-700', 'text-red-800');
                        successMessage.classList.remove('hidden');

                        console.log("Didn't Work");
                        // Hide the message after 3 seconds
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                            successMessage.classList.replace('bg-orange-100', 'bg-green-100');
                            successMessage.classList.replace('text-red-800', 'text-blue-700');
                        }, 3000);
                    }


                    //Hide the edit card
                    let editcard = document.getElementById(`editProjectModal${projectId}`);
                    editcard.classList.add('hidden');
                    console.log("found Edit Card");

                })
                .catch(error => {
                    console.error('Error:', error);
                    const successMessage = document.getElementById('success-message');
                    successMessage.innerHTML = '<p class="flex bg-red-600 py-3 text-white hidden">An Error Occured!!</p>';
                    successMessage.classList.remove('hidden');

                    // Hide the message after 3 seconds
                    setTimeout(() => {
                        successMessage.classList.add('hidden');
                    }, 3000);
                });

        }
    </script>
</body>


</html>