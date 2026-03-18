<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-4">
    <div class="max-w-7xl mx-auto space-y-4">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $election->name }} - Results</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $election->description }}</p>
                </div>
                <a href="{{ route('election.manage', $election) }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-3 mt-4">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white">
                    <p class="text-2xl font-bold">{{ $totalVotes }}</p>
                    <p class="text-blue-100 text-xs">Total Votes</p>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 text-white">
                    <p class="text-2xl font-bold">{{ $voterTurnout }}</p>
                    <p class="text-green-100 text-xs">Participated</p>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white">
                    <p class="text-2xl font-bold">{{ $totalVoters > 0 ? round(($voterTurnout / $totalVoters) * 100, 1) : 0 }}%</p>
                    <p class="text-purple-100 text-xs">Turnout</p>
                </div>
            </div>
        </div>

        <!-- Results by Position -->
        @foreach($positions as $position)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-4 py-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                    <h2 class="text-lg font-bold text-white">{{ $position->title }}</h2>
                </div>

                <div class="p-4 space-y-3">
                    @php $positionTotalVotes = $position->candidates->sum('votes_count'); @endphp
                    @forelse($position->candidates as $index => $candidate)
                        <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    @if($index === 0 && $candidate->votes_count > 0)<span class="text-2xl">🏆</span>@endif
                                    @if($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-blue-400 rounded-lg flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($candidate->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $candidate->name }}</h3>
                                        @if($candidate->bio)<p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ $candidate->bio }}</p>@endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $candidate->votes_count }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $positionTotalVotes > 0 ? round(($candidate->votes_count / $positionTotalVotes) * 100, 1) : 0 }}%</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2 rounded-full" style="width: {{ $positionTotalVotes > 0 ? ($candidate->votes_count / $positionTotalVotes) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center py-4 text-sm text-gray-500 dark:text-gray-400">No candidates</p>
                    @endforelse
                </div>
            </div>
        @endforeach

        <!-- Unassigned Candidates -->
        @if($unassignedCandidates->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-4 py-3">
                    <h2 class="text-lg font-bold text-white">Other Candidates</h2>
                </div>
                <div class="p-4 space-y-3">
                    @php $unassignedTotalVotes = $unassignedCandidates->sum('votes_count'); @endphp
                    @foreach($unassignedCandidates as $index => $candidate)
                        <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    @if($index === 0 && $candidate->votes_count > 0)<span class="text-2xl">🏆</span>@endif
                                    @if($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-blue-400 rounded-lg flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($candidate->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $candidate->name }}</h3>
                                        @if($candidate->bio)<p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ $candidate->bio }}</p>@endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $candidate->votes_count }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $unassignedTotalVotes > 0 ? round(($candidate->votes_count / $unassignedTotalVotes) * 100, 1) : 0 }}%</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-gray-500 to-gray-600 h-2 rounded-full" style="width: {{ $unassignedTotalVotes > 0 ? ($candidate->votes_count / $unassignedTotalVotes) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
