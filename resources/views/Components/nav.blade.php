<section>
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto w-[90%] flex justify-between items-center">
            <div class="text-white text-lg font-bold">Project Management Dashboard<br>
                <p class="text-[12px] text-yellow-200">{{$userMode}}</p>
            </div>
            <div class="flex items-center">
                <span class="text-white mr-4">{{ Auth::user()->fname }}</span> <!-- Placeholder for username -->
                <button class="bg-blue-800 text-white px-4 py-2 rounded-md" onclick="{{route('logout')}}" id="logoutButton">Logout</button>
            </div>
        </div>
        <script>
            document.getElementById('logoutButton').addEventListener('click', function() {
                if (confirm('Are you sure you want to log out?')) {
                    fetch('{{ route("logout") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.href = '/';
                        } else {
                            alert('Logout failed. Please try again.');
                        }
                    });
                }
            });
        </script>

    </nav>
</section>