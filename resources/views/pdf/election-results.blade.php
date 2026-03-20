<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Election Results - {{ $election->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { color: #1f2937; font-size: 24px; margin-bottom: 10px; }
        h2 { color: #374151; font-size: 18px; margin-top: 20px; margin-bottom: 10px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #1f2937; padding-bottom: 15px; }
        .stats { display: table; width: 100%; margin-bottom: 20px; }
        .stat { display: table-cell; text-align: center; padding: 10px; background: #f3f4f6; }
        .stat-value { font-size: 20px; font-weight: bold; color: #1f2937; }
        .stat-label { font-size: 10px; color: #6b7280; }
        .position { margin-bottom: 25px; page-break-inside: avoid; }
        .position-header { background: #1f2937; color: white; padding: 8px; font-weight: bold; }
        .candidate { border: 1px solid #e5e7eb; padding: 10px; margin-bottom: 8px; }
        .candidate-name { font-weight: bold; font-size: 14px; }
        .votes { float: right; font-size: 16px; font-weight: bold; }
        .percentage { color: #6b7280; font-size: 11px; }
        .no-vote { background: #fee2e2; border: 1px solid #fca5a5; padding: 10px; margin-bottom: 8px; }
        .no-vote-label { color: #991b1b; font-weight: bold; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #6b7280; border-top: 1px solid #e5e7eb; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $election->name }}</h1>
        <p>{{ $election->description }}</p>
        <p style="font-size: 11px; color: #6b7280;">
            {{ $election->starts_at->format('M d, Y H:i') }} - {{ $election->ends_at->format('M d, Y H:i') }}
        </p>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-value">{{ $totalVotes }}</div>
            <div class="stat-label">Total Votes</div>
        </div>
        <div class="stat">
            <div class="stat-value">{{ $voterTurnout }}</div>
            <div class="stat-label">Voters Participated</div>
        </div>
        <div class="stat">
            <div class="stat-value">{{ $totalVoters > 0 ? round(($voterTurnout / $totalVoters) * 100, 1) : 0 }}%</div>
            <div class="stat-label">Turnout</div>
        </div>
    </div>

    @foreach($positionResults as $result)
        <div class="position">
            <div class="position-header">{{ $result['position']->title }}</div>
            
            @php
                $sortedCandidates = $result['candidates']->sortByDesc('votes_count');
                $noVotes = $result['noVotes'];
                $yesVotes = $result['candidates']->sum('votes_count');
                $totalPositionVotes = $yesVotes + $noVotes;
            @endphp
            
            @foreach($sortedCandidates as $index => $candidate)
                <div class="candidate">
                    <span class="candidate-name">
                        @if($index === 0 && $candidate->votes_count > 0)🏆 @endif
                        {{ $candidate->name }}
                    </span>
                    <span class="votes">{{ $candidate->votes_count }}</span>
                    <br>
                    <span class="percentage">
                        {{ $totalPositionVotes > 0 ? round(($candidate->votes_count / $totalPositionVotes) * 100, 1) : 0 }}%
                    </span>
                </div>
            @endforeach
            
            @if($noVotes > 0)
                <div class="no-vote">
                    <span class="no-vote-label">NO (Voted Against)</span>
                    <span class="votes">{{ $noVotes }}</span>
                    <br>
                    <span class="percentage">
                        {{ $totalPositionVotes > 0 ? round(($noVotes / $totalPositionVotes) * 100, 1) : 0 }}%
                    </span>
                </div>
            @endif
        </div>
    @endforeach

    <div class="footer">
        Generated on {{ now()->format('F d, Y \a\t H:i') }} | e-voter System
    </div>
</body>
</html>
