<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-4"> Dashboard Staff</h1>
                    <p>Welcome to the {{ Auth::user()->role }} Dashboard!</p>

                    <div class="mt-6">
                        <h2 class="text-lg font-semibold">Quick Links</h2>
                        <ul class="mt-2">
                            <li><a href="#" class="text-blue-500 hover:underline">Manage Users</a></li>
                            <li><a href="#" class="text-blue-500 hover:underline">View Reports</a></li>
                            <li><a href="#" class="text-blue-500 hover:underline">System Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
