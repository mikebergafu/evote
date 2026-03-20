<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Manage Voters</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $election->name }}</p>
                </div>
                <a href="{{ route('election.manage', $election->uuid) }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-800 text-green-800 dark:text-green-400 px-6 py-4 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('message') }}
            </div>
        @endif

        <!-- Search and Stats -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
                <div class="flex-1 w-full">
                    <input type="text" wire:model.live="search" placeholder="Search by name, voter ID, or phone..." class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white">
                </div>
                <div class="flex gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 px-4 py-3 rounded-xl">
                        <div class="text-xs text-blue-600 dark:text-blue-400 font-semibold">Total Voters</div>
                        <div class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $voters->total() }}</div>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 px-4 py-3 rounded-xl">
                        <div class="text-xs text-green-600 dark:text-green-400 font-semibold">Registered Devices</div>
                        <div class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $election->voters()->where('device_registered', true)->count() }}</div>
                    </div>
                </div>
            </div>

            <!-- Voters Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Voter ID</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Phone</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Device Status</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Voted</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($voters as $voter)
                            <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="py-4 px-4">
                                    <span class="font-mono text-sm text-gray-900 dark:text-white">{{ $voter->voter_id }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $voter->name }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="text-gray-600 dark:text-gray-400">{{ $voter->phone ?? 'N/A' }}</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($voter->device_registered)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Registered
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 font-mono">{{ substr($voter->device_fingerprint, 0, 8) }}...</span>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            Not Registered
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($voter->has_voted)
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Voted
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $voter->voted_at->format('M d, H:i') }}</span>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($voter->device_registered)
                                        <button wire:click="removeDeviceRegistration({{ $voter->id }})" wire:confirm="Are you sure you want to remove device registration for {{ $voter->name }}? They will need to register their device again." class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Remove Device
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-400 dark:text-gray-600">No device</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">No voters found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $voters->links() }}
            </div>
        </div>
    </div>
</div>
