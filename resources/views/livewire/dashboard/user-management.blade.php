<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">User Management</h2>
        <button wire:click="$toggle('showForm')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
            {{ $showForm ? 'Cancel' : '+ Add User' }}
        </button>
    </div>

    @if(session()->has('message'))
        <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-800 text-green-800 dark:text-green-400 px-4 py-3 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Create New User</h3>
            <form wire:submit.prevent="createUser" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Name</label>
                    <input type="text" wire:model="name" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Email</label>
                    <input type="email" wire:model="email" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required>
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Password</label>
                    <input type="password" wire:model="password" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required>
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Role</label>
                    <select wire:model="role" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                        <option value="admin">Admin - Full access</option>
                        <option value="manager">Manager - Manage elections</option>
                        <option value="viewer">Viewer - View only</option>
                    </select>
                    @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-bold">
                    Create User
                </button>
            </form>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($user->role === 'admin') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                @elseif($user->role === 'manager') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->id !== auth()->id())
                                <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                    Delete
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
