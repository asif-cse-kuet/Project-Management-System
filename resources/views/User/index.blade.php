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
    <x-nav userMode="User Mode" />
    <div id="success-message" class="hidden bg-green-100 text-blue-700 p-2 mb-4 rounded"></div>

    <!-- Main Content -->
    <div class="container mt-6 w-auto mx-10">
        <!-- Search Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="w-full md:w-2/3">
                <input type="search" id="search" placeholder="Search projects, tasks, users..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" onclick="search()">
            </div>
        </div>
    </div>


    <!-- Projects and Tasks List -->
    <div id="projects_tasks">
        <!-- Example Project -->
        @include('components.project_list')
    </div>


    <!--Logout for invalid session id -->
    <>
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
    </>
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