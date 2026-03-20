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
            foreach ($position->candidates as $candidate) {
                $candidate->percentage = $totalVotes > 0 
                    ? round(($candidate->votes_count / $totalVotes) * 100, 2) 
                    : 0;
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
