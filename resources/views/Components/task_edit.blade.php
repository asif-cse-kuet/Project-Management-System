<!-- Edit Task Modal -->
<div id="editTaskModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Task</h2>
        <form>
            <div class="mb-4">
                <label class="block mb-1 font-bold">Task Name</label>
                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="Task Name">
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