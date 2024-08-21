
function createProject(event) {
    event.preventDefault();
    fetch(Projects_Store_Route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
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
                fetch(Show_ProjectList_Route, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('project-list').innerHTML = data;
                        // console.log(data);
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
    // console.log("Search Called");
    document.getElementById('search').addEventListener('input', function() {
        let query = this.value;
        fetch(Show_ProjectList_Route + query, {
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
    if (!confirm("Are you sure you want to delete this project?")) {
        return;
    }

    fetch(Delete_Project_Route, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
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


function create_task(event) {
    var title = document.getElementById('task-title').value;
    var description = document.getElementById('task-description').value;
    var status = document.getElementById('task-status').value;
    var user_id = document.getElementById('user-id').value;
    var project_id = document.getElementById('task-project-id').value;

    // console.log(title, description, status, user_id, project_id);

    event.preventDefault();
    fetch(Task_Create_Route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                title: title,
                description: description,
                status: status,
                user_id: user_id,
                project_id: project_id
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
            // console.log(data);
            if (data.success) {
                const successMessage = document.getElementById('success-message');
                successMessage.textContent = data.message;
                successMessage.classList.remove('hidden');

                // Hide the message after 3 seconds
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                }, 3000);

                document.getElementById('createTaskModal').classList.add('hidden');
                document.getElementById('task-create-form').reset();

                //Updating the project list
                fetch(Show_ProjectList_Route, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('project-list').innerHTML = data;
                    });
            }
        })
        .catch(error => {
            // Handle the error
            alert('Something went wrong. Please try again.');
            console.error('Error:', error); // Log the error for debugging
        });
}


function project_update(button) {
    let projectId = button.getAttribute('data-project-id-edit');
    let name = document.getElementById('edit-project-name').value;
    let description = document.getElementById('edit-project-description').value;
    let status = document.getElementById('edit-project-status').value;

    // console.log(description, status, name);
    fetch(Projects_Update_Route+`${projectId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
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
                // console.log("Update Project Works!!");

                //Updating project lists
                fetch(Show_ProjectList_Route, {
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

                // console.log("Update Project Didn't work");
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
            // console.log("found Edit Card");

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


// Below Functions Have to Be updated with routes from blade file 

function initiateSearch() {
    $(document).ready(function() {
        $('#user-search').on('input', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: searchUsersUrl,
                    type: "GET",
                    data: {
                        search: query
                    },
                    success: function(data) {
                        $('#user-suggestions').empty();

                        if (data.length > 0) {
                            $('#user-list').show();
                            let count = 0; // Initialize a counter

                            $.each(data, function(key, user) {
                                if (count < 3) { // Check if the counter is less than 3
                                    $('#user-suggestions').append('<li class="w-[50%] m-2 px-4 py-2 border border-gray-300 bg-orange-100 rounded-md shadow-sm focus:ring focus:ring-blue-200" data-user-id="' + user.id + '">' + user.fname + '</li>');
                                    count++;
                                } else {
                                    return false; // Break the loop once 3 users have been processed
                                }
                            });

                            $('#user-suggestions li').on('click', function() {
                                let selectedName = $(this).text();
                                let selectedId = $(this).data('user-id');

                                $('#user-search').val(selectedName);
                                $('#user-id').val(selectedId);
                                // console.log(selectedName, selectedId);
                                $('#user-list').hide();
                            });
                        } else {
                            $('#user-list').hide();
                        }
                    }
                });
            } else {
                $('#user-list').hide();
            }
        });
    });
}


function userName(uid) {
    console.log('userName function called');
    console.log(uid);
    if (uid) {
        fetch(`/userDetails?user_id=${uid}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.fname) {
                    document.getElementById(uid).textContent = data.fname;
                } else if (data.error) {
                    // console.error('Error:', data.error);
                }
            })
            .catch(error => {
                console.error('Request failed:', error);
            });
    }
}

function taskUserSearch() {
    $(document).ready(function() {
        $('#edit-user-search').on('input', function() {
            let query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('search-users') }}",
                    type: "GET",
                    data: {
                        search: query
                    },
                    success: function(data) {
                        $('#edit-user-suggestions').empty();

                        if (data.length > 0) {
                            $('#edit-user-list').show();
                            let count = 0; // Initialize a counter

                            $.each(data, function(key, user) {
                                if (count < 3) { // Check if the counter is less than 3
                                    $('#edit-user-suggestions').append('<li class="w-[50%] m-2 px-4 py-2 border border-gray-300 bg-orange-100 rounded-md shadow-sm focus:ring focus:ring-blue-200" data-user-id=' + user.id + '>' + user.fname + '</li>');
                                    count++;
                                } else {
                                    return false; // Break the loop once 3 users have been processed
                                }
                            });

                            $('#edit-user-suggestions li').on('click', function() {
                                let selectedName = $(this).text();
                                let selectedId = $(this).data(
                                    'userId');
                                console.log($(this));
                                $('#edit-user-search').val(selectedName);
                                $('#edit-user-search').attr('user_att', selectedId);
                                console.log(selectedId);
                                console.log(selectedName);
                                // console.log($('#edit-user-search'));
                                $('#edit-user-id').val(selectedId);
                                // console.log(selectedName, selectedId);
                                $('#edit-user-list').hide();
                            });
                        } else {
                            $('#edit-user-list').hide();
                        }
                    }
                });
            } else {
                $('#edit-user-list').hide();
            }
        });
    });
}

function editTask(event, $taskid) {
    console.log($taskid);
    event.preventDefault();
    let task = JSON.parse(document.getElementById($taskid).value);
    let usr_id = task.user_id;
    let project_id = task.project_id;

    //Fetching the task edit ids that should be updated
    let edit_task = document.getElementById('editTaskModal');
    let task_title = document.getElementById('edit-task-title').value;
    let task_description = document.getElementById('edit-task-description').value;
    let task_status = document.getElementById('edit-task-status').value;
    let task_user = document.getElementById('edit-user-search').getAttribute('user_att');

    //Updating the Edit Task 
    fetch(`/taskUpdate/${$taskid}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ // Stringify the body
                'title': task_title,
                'description': task_description,
                'status': task_status,
                'user_id': task_user,
                'project_id': project_id
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const successMessage = document.getElementById('success-message');
            if (data.success) {
                console.log("success message");
                successMessage.innerText = 'Task updated successfully!';
                // successMessage.classList.replace('bg-green-100', 'bg-gray-100');
                successMessage.classList.remove('hidden');
                // console.log("Update Project Works!!");

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
                successMessage.innerText = 'Task Update Failed';
                successMessage.classList.replace('bg-green-100', 'bg-orange-100');
                successMessage.classList.replace('text-blue-700', 'text-red-800');
                successMessage.classList.remove('hidden');

                // console.log("Update Project Didn't work");
                // Hide the message after 3 seconds
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                    successMessage.classList.replace('bg-orange-100', 'bg-green-100');
                    successMessage.classList.replace('text-red-800', 'text-blue-700');
                }, 3000);
            }


            //Hide the edit card
            let editcard = document.getElementById(`editTaskModal`);
            editcard.classList.add('hidden');
            // console.log("found Edit Card");

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