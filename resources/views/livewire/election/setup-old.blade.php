<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-[#0a0a0a] dark:to-[#1b1b18]">
    <!-- Header Section -->
    <div class="bg-white dark:bg-[#161615] border-b border-gray-200 dark:border-gray-800 sticky top-0 z-10 backdrop-blur-lg bg-white/90 dark:bg-[#161615]/90">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#F53003] to-[#FF6B35] rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Create New Election</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Set up your election in a few simple steps</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Progress Steps -->
        <div class="mb-10">
            <div class="flex items-center justify-between max-w-3xl mx-auto">
                <div class="flex items-center gap-3 flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#F53003] to-[#FF6B35] flex items-center justify-center text-white font-bold shadow-lg">1</div>
                    <div class="hidden sm:block">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Election Details</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Basic information</div>
                    </div>
                </div>
                <div class="h-0.5 flex-1 bg-gradient-to-r from-[#F53003] to-gray-300 dark:to-gray-700 mx-2"></div>
                
                <div class="flex items-center gap-3 flex-1">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center text-white font-bold shadow-lg">2</div>
                    <div class="hidden sm:block">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Add Candidates</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Minimum 2 required</div>
                    </div>
                </div>
                <div class="h-0.5 flex-1 bg-gradient-to-r from-purple-500 to-gray-300 dark:to-gray-700 mx-2"></div>
                
                <div class="flex items-center gap-3 flex-1">
                    <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center text-white font-bold">3</div>
                    <div class="hidden sm:block">
                        <div class="text-sm font-semibold text-gray-500 dark:text-gray-400">Review & Create</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Final check</div>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="createElection" class="space-y-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Form -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Election Details Card -->
                    <div class="bg-white dark:bg-[#1D1D1C] rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                        <div class="bg-gradient-to-r from-[#F53003] to-[#FF6B35] px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-white">Election Details</h2>
                                    <p class="text-white/80 text-sm">Provide basic information about your election</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 space-y-6">
                            <!-- Election Name -->
                            <div>
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                    <svg class="w-4 h-4 text-[#F53003]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Election Name *
                                </label>
                                <input 
                                    type="text" 
                                    wire:model="name" 
                                    placeholder="e.g., Annual Board Member Election 2026"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-[#F53003] focus:border-transparent transition-all placeholder-gray-400 dark:placeholder-gray-600 text-gray-900 dark:text-white" 
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
                                    <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    Description (Optional)
                                </label>
                                <textarea 
                                    wire:model="description" 
                                    placeholder="Provide additional context about this election..."
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder-gray-400 dark:placeholder-gray-600 text-gray-900 dark:text-white" 
                                    rows="3"
                                ></textarea>
                                @error('description') 
                                    <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Date Range -->
                            <div class="grid sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Start Date & Time *
                                    </label>
                                    <input 
                                        type="datetime-local" 
                                        wire:model="starts_at" 
                                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-900 dark:text-white" 
                                        required
                                    >
                                    @error('starts_at') 
                                        <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        End Date & Time *
                                    </label>
                                    <input 
                                        type="datetime-local" 
                                        wire:model="ends_at" 
                                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-gray-900 dark:text-white" 
                                        required
                                    >
                                    @error('ends_at') 
                                        <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidates Card -->
                    <div class="bg-white dark:bg-[#1D1D1C] rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-blue-500 px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-white">Candidates</h2>
                                        <p class="text-white/80 text-sm">Add at least 2 candidates for the election</p>
                                    </div>
                                </div>
                                <div class="bg-white/20 backdrop-blur-lg px-4 py-2 rounded-lg">
                                    <span class="text-white font-bold">{{ count($candidates) }}</span>
                                    <span class="text-white/80 text-sm ml-1">added</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 space-y-6">
                            <!-- Existing Candidates -->
                            @if(count($candidates) > 0)
                                <div class="space-y-4">
                                    @foreach($candidates as $index => $candidate)
                                        <div class="group relative bg-gradient-to-br from-gray-50 to-gray-100 dark:from-[#0a0a0a] dark:to-[#1b1b18] rounded-2xl p-6 border-2 border-gray-200 dark:border-gray-800 hover:border-purple-500 dark:hover:border-purple-500 transition-all">
                                            <!-- Candidate Number Badge -->
                                            <div class="absolute -top-3 -left-3 w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                                {{ $index + 1 }}
                                            </div>

                                            <!-- Remove Button -->
                                            <button 
                                                type="button" 
                                                wire:click="removeCandidate({{ $index }})" 
                                                class="absolute -top-3 -right-3 w-10 h-10 bg-red-500 hover:bg-red-600 rounded-xl flex items-center justify-center text-white shadow-lg transition-all opacity-0 group-hover:opacity-100"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>

                                            <!-- Candidate Info -->
                                            <div class="flex items-start gap-4 mt-2">
                                                <!-- Avatar/Photo -->
                                                @if(isset($candidate['photo']) && $candidate['photo'])
                                                    <img src="{{ is_string($candidate['photo']) ? asset('storage/' . $candidate['photo']) : $candidate['photo']->temporaryUrl() }}" 
                                                         class="w-16 h-16 rounded-2xl object-cover flex-shrink-0 shadow-lg border-2 border-purple-500">
                                                @else
                                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-blue-400 rounded-2xl flex items-center justify-center text-white font-bold text-xl flex-shrink-0 shadow-lg">
                                                        {{ strtoupper(substr($candidate['name'], 0, 2)) }}
                                                    </div>
                                                @endif

                                                <!-- Details -->
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $candidate['name'] }}</h3>
                                                    @if($candidate['bio'])
                                                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $candidate['bio'] }}</p>
                                                    @else
                                                        <p class="text-sm text-gray-400 dark:text-gray-600 italic">No bio provided</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 px-4 bg-gradient-to-br from-purple-50 to-blue-50 dark:from-purple-900/10 dark:to-blue-900/10 rounded-2xl border-2 border-dashed border-purple-300 dark:border-purple-800">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">No candidates added yet</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Add your first candidate below to get started</p>
                                </div>
                            @endif

                            <!-- Add New Candidate Form -->
                            <div class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/10 dark:to-purple-900/10 rounded-2xl p-6 border-2 border-blue-200 dark:border-blue-800">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Add New Candidate</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Candidate Name *</label>
                                        <input 
                                            type="text" 
                                            wire:model="newCandidate.name" 
                                            placeholder="e.g., John Smith"
                                            class="w-full px-4 py-3 bg-white dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400 dark:placeholder-gray-600 text-gray-900 dark:text-white"
                                        >
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Bio (Optional)</label>
                                        <textarea 
                                            wire:model="newCandidate.bio" 
                                            placeholder="Brief background about this candidate..."
                                            class="w-full px-4 py-3 bg-white dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400 dark:placeholder-gray-600 text-gray-900 dark:text-white" 
                                            rows="3"
                                        ></textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Photo (Optional)</label>
                                        <input 
                                            type="file" 
                                            wire:model="newCandidate.photo" 
                                            accept="image/*"
                                            class="w-full px-4 py-3 bg-white dark:bg-[#0a0a0a] border border-gray-300 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-900 dark:text-white"
                                        >
                                        @if($newCandidate['photo'])
                                            <img src="{{ $newCandidate['photo']->temporaryUrl() }}" class="mt-3 w-32 h-32 rounded-lg object-cover border-2 border-blue-500">
                                        @endif
                                    </div>
                                    
                                    <button 
                                        type="button" 
                                        wire:click="addCandidate" 
                                        class="w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Candidate
                                    </button>
                                </div>
                            </div>

                            @error('candidates') 
                                <div class="flex items-center gap-2 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-red-700 dark:text-red-400 font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="bg-white dark:bg-[#1D1D1C] rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800 p-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Ready to create?</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Review your details and create the election</p>
                            </div>
                            <button 
                                type="submit" 
                                class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all shadow-lg hover:shadow-2xl hover:scale-105 flex items-center gap-3"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Create Election
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Info Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Election Preview Card -->
                    <div class="bg-white dark:bg-[#1D1D1C] rounded-2xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden sticky top-24">
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">
                            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Preview
                            </h3>
                        </div>

                        <!-- Stats -->
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Election Name</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white text-right max-w-[60%] truncate">
                                    {{ $name ?: '—' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Candidates</span>
                                <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-3 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded-lg text-sm font-bold">
                                    {{ count($candidates) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Status</span>
                                <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400 rounded-lg text-xs font-semibold">
                                    Draft
                                </span>
                            </div>
                        </div>

                        <!-- Important Notice -->
                        <div class="px-6 py-4 bg-orange-50 dark:bg-orange-900/10 border-t border-orange-200 dark:border-orange-900/30">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <div>
                                    <p class="text-xs font-semibold text-orange-900 dark:text-orange-300 mb-1">Device Lock</p>
                                    <p class="text-xs text-orange-800 dark:text-orange-400 leading-relaxed">
                                        This device will be the only one authorized to manage this election.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="bg-white dark:bg-[#1D1D1C] rounded-2xl shadow-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">
                            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Quick Tips
                            </h3>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Use clear, descriptive election names</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Add at least 2 candidates</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Include candidate bios for voters</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(156, 163, 175, 0.5);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(107, 114, 128, 0.7);
    }

    /* Dark mode scrollbar */
    .dark ::-webkit-scrollbar-thumb {
        background: rgba(75, 85, 99, 0.5);
    }

    .dark ::-webkit-scrollbar-thumb:hover {
        background: rgba(107, 114, 128, 0.7);
    }

    /* Smooth transitions for Livewire updates */
    [wire\:loading] {
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    /* Input focus glow effect */
    input:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(245, 48, 3, 0.1);
    }
</style>
