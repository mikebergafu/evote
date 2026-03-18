<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Create New Election</h1>
            <p class="text-gray-600 dark:text-gray-400">Set up your election details and manage candidates later</p>
        </div>

        <!-- Form Card -->
        <form wire:submit.prevent="createElection" class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Progress Steps -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-6">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center font-bold">1</div>
                        <div>
                            <div class="font-semibold">Election Details</div>
                            <div class="text-sm text-white/80">Basic information</div>
                        </div>
                    </div>
                    <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <div class="flex items-center gap-3 opacity-50">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center font-bold">2</div>
                        <div>
                            <div class="font-semibold">Add Candidates</div>
                            <div class="text-sm text-white/80">Next step</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8 space-y-6">
                <!-- Election Name -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Election Name *
                    </label>
                    <input 
                        type="text" 
                        wire:model="name" 
                        placeholder="e.g., Annual Board Member Election 2026"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400 text-gray-900 dark:text-white" 
                        required
                    >
                    @error('name') 
                        <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Description (Optional)
                    </label>
                    <textarea 
                        wire:model="description" 
                        placeholder="Provide additional context about this election..."
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder-gray-400 text-gray-900 dark:text-white" 
                        rows="3"
                    ></textarea>
                    @error('description') 
                        <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date & Time -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Start Date & Time *
                        </label>
                        <input 
                            type="datetime-local" 
                            wire:model="starts_at" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-gray-900 dark:text-white" 
                            required
                        >
                        @error('starts_at') 
                            <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            End Date & Time *
                        </label>
                        <input 
                            type="datetime-local" 
                            wire:model="ends_at" 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all text-gray-900 dark:text-white" 
                            required
                        >
                        @error('ends_at') 
                            <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 border-2 border-blue-200 dark:border-blue-800 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">What happens next?</h3>
                            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Add candidates with photos and bios
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Register voters with unique IDs
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Activate election when ready
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 dark:bg-gray-900 px-8 py-6 flex items-center justify-between border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition-colors">
                    ← Back to Dashboard
                </a>
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center gap-2"
                >
                    Create Election
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
