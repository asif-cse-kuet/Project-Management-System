<!-- Edit Task Modal -->
<div id="editTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Task</h2>
        <form>
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-bold">Task Name</label>
                <input type="text" id="edit-task-title" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{$task->title}}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-bold">Task Description</label>
                <input type="text" id="edit-task-description" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{$task->description}}">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-bold">Status</label>
                <select id="edit-task-status" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option id="selected" value="{{$task->status}}" selected>{{$task->status}}</option>
                    <option value="New">New</option>
                    <option value="In_progress">In_progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="mb-4">
                <div class="mb-4">
                    <label for="edit-task-user" class="block mb-1 font-bold">Assign to (Type name and select from suggestion)</label>
                    <input type="text" id="edit-user-search" autocomplete="off" placeholder="Type a user name and select from suggestions..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{$task->users->fname}}" user_att="{{$task->users->id}}" onclick="taskUserSearch()">
                    <input type="hidden" id="edit-user-id">
                    <div id="edit-user-list" style="display:none;">
                        <ul id="edit-user-suggestions"></ul>
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md shadow mr-2" onclick="document.getElementById('editTaskModal').classList.add('hidden')">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow" onclick="editTask(event,'{{$task->id}}')">Update</button>
            </div>
        </form>
    </div>
</div>