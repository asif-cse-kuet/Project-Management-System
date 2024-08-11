<div class="container" id="Project-container">
    <input type="search" id="search" placeholder="Search Projects..." class="mb-4 p-2 border" onclick="search()">

    <div id="project-list">
        @include('components.project_list');
    </div>
</div>



<script>
    function search() {
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
                    console.log(data);
                });
        });
    }
</script>