<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Election Report - {{ $election->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #4F46E5; padding-bottom: 20px; }
        .header h1 { color: #4F46E5; margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; color: #666; }
        .section { margin-bottom: 25px; }
        .section-title { background: #4F46E5; color: white; padding: 8px 12px; font-size: 14px; font-weight: bold; margin-bottom: 10px; }
        .info-grid { display: table; width: 100%; margin-bottom: 15px; }
        .info-row { display: table-row; }
        .info-label { display: table-cell; font-weight: bold; padding: 6px; width: 30%; background: #F3F4F6; }
        .info-value { display: table-cell; padding: 6px; border-bottom: 1px solid #E5E7EB; }
        .stats-box { background: #F9FAFB; border: 1px solid #E5E7EB; padding: 15px; margin-bottom: 15px; }
        .stats-grid { display: table; width: 100%; }
        .stat-item { display: table-cell; text-align: center; padding: 10px; }
        .stat-value { font-size: 28px; font-weight: bold; color: #4F46E5; }
        .stat-label { font-size: 11px; color: #666; margin-top: 5px; }
        .position-block { margin-bottom: 20px; border: 1px solid #E5E7EB; }
        .position-header { background: #F3F4F6; padding: 10px; font-weight: bold; border-bottom: 2px solid #4F46E5; }
        .candidate-row { padding: 8px 10px; border-bottom: 1px solid #E5E7EB; display: table; width: 100%; }
        .candidate-rank { display: table-cell; width: 40px; font-weight: bold; color: #4F46E5; }
        .candidate-name { display: table-cell; }
        .candidate-votes { display: table-cell; text-align: right; width: 100px; }
        .candidate-bar { display: table-cell; width: 150px; padding-left: 10px; }
        .bar { background: #4F46E5; height: 20px; border-radius: 3px; }
        .winner { background: #ECFDF5; border-left: 4px solid #10B981; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 2px solid #E5E7EB; text-align: center; font-size: 10px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #F3F4F6; padding: 8px; text-align: left; font-size: 11px; border-bottom: 2px solid #4F46E5; }
        td { padding: 6px 8px; border-bottom: 1px solid #E5E7EB; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $election->name }}</h1>
        <p>{{ $election->description }}</p>
        <p><strong>Report Generated:</strong> {{ now()->format('F d, Y h:i A') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Election Information</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Election ID</div>
                <div class="info-value">{{ $election->uuid }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status</div>
                <div class="info-value">{{ ucfirst($election->status) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Start Date</div>
                <div class="info-value">{{ $election->starts_at->format('F d, Y h:i A') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">End Date</div>
                <div class="info-value">{{ $election->ends_at->format('F d, Y h:i A') }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Voting Statistics</div>
        <div class="stats-box">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">{{ $totalVoters }}</div>
                    <div class="stat-label">REGISTERED VOTERS</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $totalVoted }}</div>
                    <div class="stat-label">VOTES CAST</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $turnoutRate }}%</div>
                    <div class="stat-label">TURNOUT RATE</div>
                </div>
            </div>
        </div>
    </div>

    @if($votingTimeline->isNotEmpty())
    <div class="section">
        <div class="section-title">Voting Timeline</div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th style="text-align: right;">Votes Cast</th>
                </tr>
            </thead>
            <tbody>
                @foreach($votingTimeline as $day)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($day->date)->format('F d, Y') }}</td>
                    <td style="text-align: right;">{{ $day->count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Results by Position</div>
        @foreach($positions as $position)
        <div class="position-block">
            <div class="position-header">{{ $position->title }}</div>
            @php
                $maxVotes = $position->candidates->max('votes_count') ?: 1;
            @endphp
            @foreach($position->candidates as $index => $candidate)
            <div class="candidate-row {{ $index === 0 ? 'winner' : '' }}">
                <div class="candidate-rank">{{ $index + 1 }}</div>
                <div class="candidate-name">
                    {{ $candidate->name }}
                    @if($index === 0 && !$candidate->is_single_candidate)
                        <strong style="color: #10B981;">✓ WINNER</strong>
                    @endif
                </div>
                <div class="candidate-votes">
                    @if($candidate->is_single_candidate)
                        <strong>{{ $candidate->votes_count }}</strong> Yes ({{ $candidate->yes_percentage }}%) | 
                        <strong>{{ $candidate->no_votes }}</strong> No ({{ $candidate->no_percentage }}%)
                    @else
                        <strong>{{ $candidate->votes_count }}</strong> votes ({{ $candidate->percentage }}%)
                    @endif
                </div>
                <div class="candidate-bar">
                    @if($candidate->is_single_candidate)
                        <div class="bar" style="width: {{ $candidate->yes_percentage }}%; background: #10B981;"></div>
                    @else
                        <div class="bar" style="width: {{ ($candidate->votes_count / $maxVotes) * 100 }}%;"></div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

    <div class="section">
        <div class="section-title">Voter List</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Voter ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Voted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($voterList as $index => $voter)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $voter->voter_id }}</td>
                    <td>{{ $voter->name }}</td>
                    <td>
                        @if($voter->has_voted)
                            <span style="color: #10B981; font-weight: bold;">✓ Voted</span>
                        @else
                            <span style="color: #EF4444;">✗ Not Voted</span>
                        @endif
                    </td>
                    <td>
                        @if($voter->voted_at)
                            {{ $voter->voted_at->format('M d, Y h:i A') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>This is an official election report generated by the eVoter System</p>
        <p>© {{ date('Y') }} eVoter. All rights reserved.</p>
    </div>
</body>
</html>
