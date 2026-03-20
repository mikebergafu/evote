<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ElectionReportController extends Controller
{
    public function download(Election $election)
    {
        $data = $this->getReportData($election);
        
        $pdf = Pdf::loadView('pdf.election-report', $data)
            ->setPaper('a4', 'portrait');
        
        return $pdf->download("election-report-{$election->uuid}.pdf");
    }

    private function getReportData(Election $election)
    {
        $positions = $election->positions()->with(['candidates' => function($q) {
            $q->withCount('votes')->orderByDesc('votes_count');
        }])->get();

        // Calculate percentages for each position
        foreach ($positions as $position) {
            $totalVotes = $position->candidates->sum('votes_count');
            
            // For single candidate positions, calculate Yes/No percentages
            if ($position->candidates->count() === 1) {
                $candidate = $position->candidates->first();
                $yesVotes = $candidate->votes_count;
                
                // Total votes for this position (including null candidate_id for "No" votes)
                $totalPositionVotes = DB::table('votes')
                    ->where('election_id', $election->id)
                    ->where('position', $position->title)
                    ->count();
                
                $noVotes = $totalPositionVotes - $yesVotes;
                
                $candidate->yes_percentage = $totalPositionVotes > 0 
                    ? round(($yesVotes / $totalPositionVotes) * 100, 2) 
                    : 0;
                $candidate->no_percentage = $totalPositionVotes > 0 
                    ? round(($noVotes / $totalPositionVotes) * 100, 2) 
                    : 0;
                $candidate->no_votes = $noVotes;
                $candidate->is_single_candidate = true;
            } else {
                foreach ($position->candidates as $candidate) {
                    $candidate->percentage = $totalVotes > 0 
                        ? round(($candidate->votes_count / $totalVotes) * 100, 2) 
                        : 0;
                    $candidate->is_single_candidate = false;
                }
            }
        }

        $totalVoters = $election->voters()->count();
        $totalVoted = $election->voters()->where('has_voted', true)->count();
        $turnoutRate = $totalVoters > 0 ? round(($totalVoted / $totalVoters) * 100, 2) : 0;

        $votingTimeline = $election->votes()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $voterList = $election->voters()->orderBy('name')->get();

        return compact('election', 'positions', 'totalVoters', 'totalVoted', 'turnoutRate', 'votingTimeline', 'voterList');
    }
}
