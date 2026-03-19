<x-layouts::app :title="__('Manage Users')">
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Manage Users</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Add and manage system users with different roles</p>
        </div>

        <livewire:dashboard.user-management />
    </div>
</x-layouts::app>
