<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8.29 13.29a.996.996 0 0 1-1.41 0L5.71 12.7a.996.996 0 1 1 1.41-1.41L10 14.17l6.88-6.88a.996.996 0 1 1 1.41 1.41l-7.58 7.59z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">eVoter</h1>
                        <p class="text-gray-600 dark:text-gray-400">Secure Online Voting Platform</p>
                    </div>
                </div>
                @if($voter)
                    <button wire:click="resetVoter" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all">
                        Change Voter ID
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        @if(!$voter)
            <!-- Voter ID Entry -->
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Enter Your Voter ID</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Enter your voter ID to see available elections</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border-2 border-blue-500 dark:border-blue-600 p-8">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Voter Authentication</h3>
                        <p class="text-gray-600 dark:text-gray-400">You'll need your unique voter ID to continue</p>
                    </div>

                    <form wire:submit.prevent="checkVoterId" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Voter ID</label>
                            <input type="text" 
                                   wire:model="voterId" 
                                   placeholder="Enter your voter ID (e.g., EXEC001)" 
                                   class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-4 text-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required 
                                   autofocus>
                            @error('voterId') 
                                <div class="flex items-center gap-2 mt-2 text-red-500 text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all">
                            Continue →
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Elections List -->
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Your Elections</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Voter ID: <span class="font-bold">{{ $voterId }}</span></p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($elections as $election)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $election->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $election->description }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($election->status === 'active') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 @endif">
                                    {{ ucfirst($election->status) }}
                                </span>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $election->starts_at->format('M d') }} - {{ $election->ends_at->format('M d, Y') }}
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                    {{ $election->candidates()->count() }} Candidates
                                </div>
                            </div>

                            @if($election->status === 'active')
                                <button wire:click="$set('selectedElection', {{ $election->id }})" 
                                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all
                                        @if($selectedElection === $election->id) ring-4 ring-blue-300 dark:ring-blue-700 @endif">
                                    @if($selectedElection === $election->id)
                                        ✓ Selected
                                    @else
                                        Select to Vote
                                    @endif
                                </button>
                            @else
                                <a href="{{ route('election.results', $election) }}" 
                                   class="block w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all text-center">
                                    View Results
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No elections available</h3>
                        <p class="text-gray-600 dark:text-gray-400">No active or closed elections found for your voter ID</p>
                    </div>
                @endforelse
            </div>

            @if($selectedElection)
                <div class="max-w-2xl mx-auto">
                    <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-2xl p-6 shadow-xl text-center">
                        <h3 class="text-2xl font-bold mb-4">Ready to Vote?</h3>
                        <p class="mb-6">You've selected an election. Click below to proceed to the voting booth.</p>
                        <button wire:click="vote" 
                                class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                            Proceed to Vote →
                        </button>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
