<!-- Edit Project Modal -->
<div id="editProjectModal{{$project->id}}" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Project</h2>
        <form id="update-project-form" method="PUT">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-bold">Project Name</label>
                <input type="text" id="edit-project-name" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{$project->name}}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-bold">Description</label>
                <input type="text" id="edit-project-description" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{$project->description}}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-bold">Status</label>
                <select id="edit-project-status" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option value="{{$project->status}}">{{$project->status}}</option>
                    <option value="New">New</option>
                    <option value="In_progress">In_progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('editProjectModal{{$project->id}}').classList.add('hidden')">
                    Cancel
                </button>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow" data-project-id-edit="{{ $project->id }}" onclick="project_update(this)">Update</button>
            </div>

        </form>
    </div>
</div>