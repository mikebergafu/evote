<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $election->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $election->description }}</p>
                    <div class="flex items-center gap-4 mt-4">
                        <span class="px-4 py-2 rounded-xl text-sm font-semibold shadow-sm
                            @if($election->status === 'setup') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                            @elseif($election->status === 'active') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 @endif">
                            {{ ucfirst($election->status) }}
                        </span>
                        <span class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $election->starts_at->format('M d, Y H:i') }} - {{ $election->ends_at->format('M d, Y H:i') }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button wire:click="deleteElection" wire:confirm="Are you sure you want to delete this election? This action cannot be undone." class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-2 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                    <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </div>
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
        @if(session()->has('error'))
            <div class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-800 text-red-800 dark:text-red-400 px-6 py-4 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Voter Registration Link -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    Voter Registration Link
                </h3>
            </div>
            <div class="flex gap-2">
                <input type="text" readonly value="{{ route('register.voter', ['uuid' => $election->uuid]) }}" id="registration-link" class="flex-1 border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-sm">
                <button onclick="copyToClipboard()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-xl font-semibold transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Copy
                </button>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Share this link with voters to register for this election</p>
        </div>

        <script>
            function copyToClipboard() {
                const input = document.getElementById('registration-link');
                input.select();
                document.execCommand('copy');
                alert('Registration link copied to clipboard!');
            }
        </script>

        <!-- Positions Section -->
        @if($election->status === 'setup')
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white">Positions ({{ $positions->count() }})</h2>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <form wire:submit.prevent="addPosition" class="bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border-2 border-orange-200 dark:border-orange-800 p-4 rounded-2xl space-y-3">
                    <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Position
                    </h3>
                    <input type="text" wire:model="positionTitle" placeholder="Position Title (e.g., President)" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required>
                    <textarea wire:model="positionDescription" placeholder="Description (optional)" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" rows="2"></textarea>
                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-4 py-3 rounded-xl font-semibold shadow-lg transition-all">
                        Add Position
                    </button>
                </form>

                <div class="space-y-3">
                    @forelse($positions as $position)
                        <div class="group bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 hover:border-orange-500 dark:hover:border-orange-500 rounded-2xl p-4 transition-all flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">{{ $position->title }}</h3>
                                @if($position->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $position->description }}</p>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">{{ $position->candidates()->count() }} candidates</p>
                            </div>
                            <button wire:click="removePosition({{ $position->id }})" class="text-red-500 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500 dark:text-gray-400 text-sm">
                            No positions added yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @endif

        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Candidates Section -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-blue-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Candidates ({{ $candidates->count() }})</h2>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    @if($election->status === 'setup')
                        <form wire:submit.prevent="addCandidate" class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 border-2 border-blue-200 dark:border-blue-800 p-4 rounded-2xl space-y-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add New Candidate
                            </h3>
                            <input type="text" wire:model="candidateName" placeholder="Candidate Name" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required>
                            <select wire:model="candidateUserId" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                                <option value="">Link to User (optional)</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            <select wire:model="candidatePositionId" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                                <option value="">Select Position (optional)</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                                @endforeach
                            </select>
                            <textarea wire:model="candidateBio" placeholder="Bio (optional)" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" rows="2"></textarea>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo (optional)</label>
                                <input type="file" wire:model="candidatePhoto" accept="image/*" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                                @if($candidatePhoto)
                                    <img src="{{ $candidatePhoto->temporaryUrl() }}" class="mt-2 w-20 h-20 rounded-xl object-cover border-2 border-blue-500">
                                @endif
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-4 py-3 rounded-xl font-semibold shadow-lg transition-all">
                                Add Candidate
                            </button>
                        </form>
                    @endif

                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @forelse($candidates as $candidate)
                            <div class="group bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 hover:border-purple-500 dark:hover:border-purple-500 rounded-2xl p-4 transition-all">
                                <div class="flex items-start gap-3">
                                    @if($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 shadow-md">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-blue-400 rounded-xl flex items-center justify-center text-white font-bold text-xl flex-shrink-0 shadow-md">
                                            {{ strtoupper(substr($candidate->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $candidate->name }}</h3>
                                        @if($candidate->position_name)
                                            <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ $candidate->position_name }}</p>
                                        @endif
                                        @if($candidate->bio)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $candidate->bio }}</p>
                                        @endif
                                    </div>
                                    @if($election->status === 'setup')
                                        <button wire:click="removeCandidate({{ $candidate->id }})" class="text-red-500 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                No candidates added yet
                            </div>
                        @endforelse
                        <div class="mt-4">
                            {{ $candidates->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Voter Registrations -->
            @if($potentialVoters->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Pending Registrations ({{ $potentialVoters->count() }})</h2>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    @foreach($potentialVoters as $potentialVoter)
                        <div class="bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 rounded-2xl p-4 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">{{ $potentialVoter->title }} {{ $potentialVoter->full_name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $potentialVoter->email }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $potentialVoter->mobile }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Registered: {{ $potentialVoter->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="approvePotentialVoter({{ $potentialVoter->id }})" wire:confirm="Approve {{ $potentialVoter->full_name }} as a voter? A Voter ID will be generated." class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                                    Approve
                                </button>
                                <button wire:click="rejectPotentialVoter({{ $potentialVoter->id }})" wire:confirm="Are you sure you want to reject this registration?" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                                    Reject
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $potentialVoters->links() }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Voters Section -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Voters ({{ $voters->count() }})</h2>
                    </div>
                    <a href="{{ route('election.voters', $election->uuid) }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg font-semibold transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Manage All
                    </a>
                </div>

                <div class="p-6 space-y-4">
                    @if($election->status === 'setup')
                        <form wire:submit.prevent="addVoter" class="bg-gradient-to-br from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 border-2 border-green-200 dark:border-green-800 p-4 rounded-2xl space-y-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add New Voter
                            </h3>
                            <input type="text" wire:model="voterName" placeholder="Voter Name" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required>
                            <input type="tel" wire:model="voterPhone" placeholder="Phone Number (optional)" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Voter ID will be auto-generated</p>
                            <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white px-4 py-3 rounded-xl font-semibold shadow-lg transition-all">
                                Add Voter
                            </button>
                        </form>
                    @endif

                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @forelse($voters as $voter)
                            <div class="group bg-gray-50 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $voter->name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">ID: {{ $voter->voter_id }}</p>
                                        <div class="flex gap-2 mt-2">
                                            @if($voter->device_registered)
                                                <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg font-medium">📱 Device Registered</span>
                                            @endif
                                            @if($voter->has_voted)
                                                <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg font-medium">✓ Voted</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="confirmClearDevice({{ $voter->id }}, '{{ $voter->name }}')" class="text-orange-500 hover:text-orange-700 transition-colors p-1 hover:bg-orange-50 dark:hover:bg-orange-900/20 rounded {{ !$voter->device_registered ? 'opacity-50 cursor-not-allowed' : '' }}" title="{{ $voter->device_registered ? 'Clear device' : 'No device registered' }}" {{ !$voter->device_registered ? 'disabled' : '' }}>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </button>
                                        @if($voter->phone)
                                            <button wire:click="resendVotingLink({{ $voter->id }})" class="text-blue-500 hover:text-blue-700 transition-colors" title="Resend voting link">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </button>
                                        @endif
                                        @if($election->status === 'setup')
                                            <button wire:click="removeVoter({{ $voter->id }})" class="text-red-500 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                No voters added yet
                            </div>
                        @endforelse
                        <div class="mt-4">
                            {{ $voters->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-wrap gap-4">
                @if($election->status === 'setup')
                    <button wire:click="activateElection" class="bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Activate Election
                    </button>
                @endif
                
                @if($election->status === 'active')
                    <a href="{{ route('election.vote', $election) }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Open Voting Booth
                    </a>
                    <button wire:click="closeElection" class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Close Election
                    </button>
                @endif

                @if($election->status === 'closed' || $election->status === 'active')
                    <a href="{{ route('election.results', $election) }}" class="bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        View Results
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function confirmClearDevice(voterId, voterName) {
    Swal.fire({
        title: 'Clear Device Registration?',
        text: `Remove device registration for ${voterName}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f97316',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, clear it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            @this.call('clearDeviceFingerprint', voterId);
        }
    });
}
</script>
