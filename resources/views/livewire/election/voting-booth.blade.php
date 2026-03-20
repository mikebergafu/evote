<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-3 sm:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-8 mb-4 sm:mb-6">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl sm:rounded-2xl shadow-lg mb-3 sm:mb-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h1 class="text-xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $election->name }}</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">{{ $election->description }}</p>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl mb-4 sm:mb-6 flex flex-col sm:flex-row items-center gap-3 shadow-lg">
                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1 text-center sm:text-left">{{ session('message') }}</div>
                <button wire:click="logout" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-semibold transition-all whitespace-nowrap">Vote Again</button>
            </div>
        @endif

        @if(!$voter)
            <!-- Login Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-8">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-blue-100 dark:bg-blue-900/30 rounded-xl sm:rounded-2xl mb-4">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">Voter Authentication</h2>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Enter your voter ID to continue</p>
                    </div>
                    <form wire:submit.prevent="authenticate" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Voter ID</label>
                            <input type="text" wire:model="voterId" placeholder="Enter your voter ID" 
                                   class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-base bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required autofocus>
                            @error('voterId') 
                                <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                            Continue to Vote
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Progress Bar -->
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 mb-4 sm:mb-6 shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2 text-xs sm:text-sm">
                    <span class="font-semibold text-gray-900 dark:text-white">Position {{ $currentStep + 1 }} of {{ $totalSteps }}</span>
                    <span class="text-gray-600 dark:text-gray-400">{{ round((($currentStep + 1) / $totalSteps) * 100) }}%</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 sm:h-3">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 sm:h-3 rounded-full transition-all duration-300" style="width: {{ (($currentStep + 1) / $totalSteps) * 100 }}%"></div>
                </div>
            </div>

            <!-- Voter Info -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl sm:rounded-2xl p-3 sm:p-4 mb-4 sm:mb-6 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="text-center sm:text-left">
                        <p class="text-xs sm:text-sm text-white/80">Voting as</p>
                        <p class="font-bold text-sm sm:text-base">{{ $voter->name }}</p>
                    </div>
                </div>
                <button wire:click="logout" class="bg-white/20 hover:bg-white/30 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all whitespace-nowrap">
                    Not you?
                </button>
            </div>

            @if(!$showConfirmation)
                <!-- Voting Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-8">
                    <div class="text-center mb-4 sm:mb-6">
                        <h2 class="text-xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $currentPosition['position_name'] ?? 'Position' }}</h2>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                            {{ $isSingleCandidate ? 'Vote Yes or No for this candidate' : 'Select your preferred candidate' }}
                        </p>
                    </div>
                    
                    @if($isSingleCandidate)
                        <!-- Single Candidate - Yes/No Vote -->
                        @php $candidate = $candidates->first(); @endphp
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-md mb-6">
                            <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4">
                                @if($candidate->photo)
                                    <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl object-cover shadow-md flex-shrink-0">
                                @else
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-purple-400 to-blue-400 rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-md flex-shrink-0">
                                        {{ strtoupper(substr($candidate->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div class="flex-1 text-center sm:text-left">
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $candidate->name }}</h3>
                                    @if($candidate->position_name)
                                        <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold mb-2">{{ $candidate->position_name }}</p>
                                    @endif
                                    @if($candidate->bio)
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $candidate->bio }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <button wire:click="selectCandidate({{ $candidate->id }})" 
                                    class="bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white px-6 py-6 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all flex flex-col items-center gap-2">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-xl">YES</span>
                            </button>
                            <button wire:click="selectCandidate('no')" 
                                    class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-6 py-6 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all flex flex-col items-center gap-2">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-xl">NO</span>
                            </button>
                        </div>
                    @else
                        <!-- Multiple Candidates -->
                        <div class="space-y-3 sm:space-y-4">
                            @foreach($candidates as $candidate)
                                <div class="w-full bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-md">
                                    <div class="flex flex-col sm:flex-row items-start gap-3 sm:gap-4">
                                        @if($candidate->photo)
                                            <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl object-cover shadow-md flex-shrink-0">
                                        @else
                                            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-purple-400 to-blue-400 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold text-xl sm:text-2xl shadow-md flex-shrink-0">
                                                {{ strtoupper(substr($candidate->name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div class="flex-1 w-full">
                                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $candidate->name }}</h3>
                                            @if($candidate->position_name)
                                                <p class="text-xs sm:text-sm text-blue-600 dark:text-blue-400 font-semibold mb-2">{{ $candidate->position_name }}</p>
                                            @endif
                                            @if($candidate->bio)
                                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2 sm:line-clamp-none">{{ $candidate->bio }}</p>
                                            @endif
                                            <button wire:click="selectCandidate({{ $candidate->id }})" 
                                                    class="w-full sm:w-auto bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-bold shadow-lg hover:shadow-xl transition-all inline-flex items-center justify-center gap-2 text-sm sm:text-base">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Vote for {{ explode(' ', $candidate->name)[0] }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Navigation Buttons -->
                    <div class="flex gap-3 sm:gap-4 mt-4 sm:mt-6">
                        @if($currentStep > 0)
                            <button wire:click="previousStep" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold shadow-lg hover:shadow-xl transition-all text-sm sm:text-base">
                                ← Previous
                            </button>
                        @endif
                    </div>
                </div>
            @else
                <!-- Confirmation -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border-2 border-yellow-400 dark:border-yellow-600 p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Confirm Your Vote</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">Position: <span class="font-bold">{{ $currentPosition['position_name'] }}</span></p>
                        <div class="bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-200 dark:border-blue-800 rounded-2xl p-6 mb-6">
                            <p class="text-lg text-gray-700 dark:text-gray-300 mb-2">You are voting:</p>
                            @if($selectedCandidateId === 'no')
                                <p class="text-2xl font-bold text-red-600 dark:text-red-400">NO</p>
                            @else
                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $candidates->find($selectedCandidateId)->name }}</p>
                            @endif
                        </div>
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 mb-6">
                            <p class="text-red-600 dark:text-red-400 font-semibold">⚠️ This action cannot be undone!</p>
                        </div>
                        <div class="flex gap-4 justify-center">
                            <button wire:click="confirmVote" class="bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                                {{ $currentStep < $totalSteps - 1 ? 'Confirm & Next' : 'Confirm & Submit' }}
                            </button>
                            <button wire:click="cancelVote" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
