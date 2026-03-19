<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4">
    <div class="max-w-7xl mx-auto space-y-4">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $election->name }} - Results</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $election->description }}</p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-3 mt-6">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalVotes }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-xs">Total Votes</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $voterTurnout }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-xs">Participated</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalVoters > 0 ? round(($voterTurnout / $totalVoters) * 100, 1) : 0 }}%</p>
                    <p class="text-gray-600 dark:text-gray-400 text-xs">Turnout</p>
                </div>
            </div>
        </div>

        <!-- Results by Position -->
        @foreach($candidatesByPosition as $positionName => $candidates)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gray-900 dark:bg-gray-950 px-4 py-3 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-white">{{ $positionName ?? 'Other Candidates' }}</h2>
                    @php 
                        $positionTotalVotes = $candidates->sum('votes_count'); 
                    @endphp
                    <span class="text-white text-sm font-semibold bg-white/10 px-3 py-1 rounded-full">
                        {{ $positionTotalVotes }} / {{ $totalVoters }} votes
                    </span>
                </div>

                <div class="p-4 space-y-3">
                    @php 
                        $sortedCandidates = $candidates->sortByDesc('votes_count');
                    @endphp
                    @forelse($sortedCandidates as $index => $candidate)
                        <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    @if($index === 0 && $candidate->votes_count > 0)<span class="text-2xl">🏆</span>@endif
                                    @if($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-700 dark:text-gray-300 font-bold">
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
                                <div class="bg-gray-900 dark:bg-gray-600 h-2 rounded-full" style="width: {{ $positionTotalVotes > 0 ? ($candidate->votes_count / $positionTotalVotes) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center py-4 text-sm text-gray-500 dark:text-gray-400">No candidates</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
