<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Election;

#[Signature('election:status {id?}')]
#[Description('Check the status of elections')]
class CheckElectionStatus extends Command
{
    public function handle()
    {
        $electionId = $this->argument('id');

        if ($electionId) {
            $election = Election::find($electionId);
            
            if (!$election) {
                $this->error("Election #{$electionId} not found.");
                return 1;
            }

            $this->displayElectionDetails($election);
        } else {
            $elections = Election::all();
            
            if ($elections->isEmpty()) {
                $this->info('No elections found.');
                return 0;
            }

            $this->info('All Elections:');
            $this->newLine();

            foreach ($elections as $election) {
                $this->displayElectionDetails($election);
                $this->newLine();
            }
        }

        return 0;
    }

    private function displayElectionDetails(Election $election)
    {
        $this->info("Election #{$election->id}: {$election->name}");
        $this->line("Status: {$election->status}");
        $this->line("Period: {$election->starts_at->format('Y-m-d H:i')} to {$election->ends_at->format('Y-m-d H:i')}");
        $this->line("Candidates: {$election->candidates()->count()}");
        $this->line("Registered Voters: {$election->voters()->count()}");
        $this->line("Votes Cast: {$election->votes()->count()}");
        $this->line("Voter Turnout: {$election->voters()->where('has_voted', true)->count()} / {$election->voters()->count()}");
        
        if ($election->isActive()) {
            $this->line("🟢 Election is currently active");
        } elseif ($election->hasEnded()) {
            $this->line("🔴 Election has ended");
        } else {
            $this->line("🟡 Election not yet started");
        }
    }
}

