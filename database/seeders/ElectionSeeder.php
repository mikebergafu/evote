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
            'name' => 'Association Executive Election 2026',
            'description' => 'Annual election for executive positions',
            'starts_at' => now(),
            'ends_at' => now()->addDays(7),
            'status' => 'active',
        ]);

        $positions = [
            'Chairman' => [
                ['name' => 'John Smith', 'bio' => 'Experienced leader with 10 years in association management'],
                ['name' => 'Mary Johnson', 'bio' => 'Former Vice Chairman with strong leadership skills'],
            ],
            'Vice Chairman' => [
                ['name' => 'Robert Brown', 'bio' => 'Current Secretary with excellent organizational skills'],
                ['name' => 'Sarah Williams', 'bio' => 'Community organizer and strategic planner'],
            ],
            'Secretary' => [
                ['name' => 'David Lee', 'bio' => 'Administrative professional with attention to detail'],
                ['name' => 'Emma Davis', 'bio' => 'Communications expert and record keeper'],
            ],
            'Treasurer' => [
                ['name' => 'Michael Wilson', 'bio' => 'Certified accountant with 8 years experience'],
                ['name' => 'Jennifer Taylor', 'bio' => 'Financial analyst and budget specialist'],
            ],
            'Organising Secretary' => [
                ['name' => 'James Anderson', 'bio' => 'Event coordinator with proven track record'],
                ['name' => 'Patricia Martinez', 'bio' => 'Project manager and team builder'],
            ],
            'Research and Training' => [
                ['name' => 'Christopher Garcia', 'bio' => 'Academic researcher and training facilitator'],
                ['name' => 'Linda Rodriguez', 'bio' => 'Education specialist with curriculum development experience'],
            ],
            'Gender Coordinator' => [
                ['name' => 'Barbara Hernandez', 'bio' => 'Gender equality advocate and policy expert'],
                ['name' => 'Thomas Moore', 'bio' => 'Diversity and inclusion consultant'],
            ],
        ];

        $position = 0;
        foreach ($positions as $positionName => $candidates) {
            foreach ($candidates as $candidateData) {
                Candidate::create([
                    'election_id' => $election->id,
                    'name' => $candidateData['name'],
                    'bio' => $candidateData['bio'],
                    'position' => $position,
                    'position_name' => $positionName,
                ]);
            }
            $position++;
        }

        $voters = [
            ['name' => 'Alice Johnson', 'voter_id' => 'EXEC001', 'phone' => '+233241234567'],
            ['name' => 'Bob Wilson', 'voter_id' => 'EXEC002', 'phone' => '+233241234568'],
            ['name' => 'Carol Brown', 'voter_id' => 'EXEC003', 'phone' => '+233241234569'],
            ['name' => 'David Lee', 'voter_id' => 'EXEC004', 'phone' => '+233241234570'],
            ['name' => 'Emma Davis', 'voter_id' => 'EXEC005', 'phone' => '+233241234571'],
            ['name' => 'Frank Miller', 'voter_id' => 'EXEC006', 'phone' => '+233241234572'],
            ['name' => 'Grace Taylor', 'voter_id' => 'EXEC007', 'phone' => '+233241234573'],
            ['name' => 'Henry Anderson', 'voter_id' => 'EXEC008', 'phone' => '+233241234574'],
            ['name' => 'Ivy Martinez', 'voter_id' => 'EXEC009', 'phone' => '+233241234575'],
            ['name' => 'Jack Robinson', 'voter_id' => 'EXEC010', 'phone' => '+233241234576'],
        ];

        foreach ($voters as $voterData) {
            Voter::create([
                'election_id' => $election->id,
                'voter_id' => $voterData['voter_id'],
                'name' => $voterData['name'],
                'phone' => $voterData['phone'],
            ]);
        }

        $this->command->info('Sample election created successfully!');
        $this->command->info('Election: ' . $election->name);
        $this->command->info('Positions: 7 (with 2 candidates each)');
        $this->command->info('Voters: 10 approved voters');
        $this->command->info('Voting URL: /election/' . $election->id . '/vote');
        $this->command->info('Test Voter IDs: EXEC001 through EXEC010');
    }
}
