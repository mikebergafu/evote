<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Voter;
use App\Services\DeviceFingerprint;

class ElectionSeeder extends Seeder
{
    public function run(): void
    {
        $election = Election::create([
            'name' => 'Board of Directors Election 2026',
            'description' => 'Annual election for board positions',
            'starts_at' => now(),
            'ends_at' => now()->addDays(7),
            'status' => 'active',
        ]);

        $candidates = [
            ['name' => 'John Smith', 'bio' => 'Current treasurer with 5 years of experience in financial management'],
            ['name' => 'Jane Doe', 'bio' => 'Marketing professional and active community member'],
            ['name' => 'Robert Johnson', 'bio' => 'Former board member with expertise in operations'],
            ['name' => 'Sarah Williams', 'bio' => 'Legal advisor with passion for community development'],
        ];

        foreach ($candidates as $index => $candidateData) {
            Candidate::create([
                'election_id' => $election->id,
                'name' => $candidateData['name'],
                'bio' => $candidateData['bio'],
                'position' => $index,
            ]);
        }

        $voters = [
            ['name' => 'Alice Johnson', 'voter_id' => 'MEMBER001'],
            ['name' => 'Bob Wilson', 'voter_id' => 'MEMBER002'],
            ['name' => 'Carol Brown', 'voter_id' => 'MEMBER003'],
            ['name' => 'David Lee', 'voter_id' => 'MEMBER004'],
            ['name' => 'Emma Davis', 'voter_id' => 'MEMBER005'],
            ['name' => 'Frank Miller', 'voter_id' => 'MEMBER006'],
            ['name' => 'Grace Taylor', 'voter_id' => 'MEMBER007'],
            ['name' => 'Henry Anderson', 'voter_id' => 'MEMBER008'],
        ];

        foreach ($voters as $voterData) {
            Voter::create([
                'election_id' => $election->id,
                'voter_id' => $voterData['voter_id'],
                'name' => $voterData['name'],
            ]);
        }

        $this->command->info('Test election created successfully!');
        $this->command->info('Election ID: ' . $election->id);
        $this->command->info('Voting URL: /election/' . $election->id . '/vote');
        $this->command->info('Test Voter IDs: MEMBER001 through MEMBER008');
    }
}
