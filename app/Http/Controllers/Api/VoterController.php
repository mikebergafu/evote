<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'election_id' => 'required|exists:elections,id',
            'voter_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if voter already exists
        $existingVoter = Voter::where('election_id', $request->election_id)
            ->where('voter_id', $request->voter_id)
            ->first();

        if ($existingVoter) {
            return response()->json([
                'success' => false,
                'message' => 'Voter ID already registered for this election'
            ], 409);
        }

        $voter = Voter::create([
            'election_id' => $request->election_id,
            'voter_id' => $request->voter_id,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Voter registered successfully',
            'data' => [
                'id' => $voter->id,
                'voter_id' => $voter->voter_id,
                'name' => $voter->name,
                'phone' => $voter->phone,
                'election_id' => $voter->election_id,
            ]
        ], 201);
    }

    public function bulkRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'election_id' => 'required|exists:elections,id',
            'voters' => 'required|array|min:1',
            'voters.*.voter_id' => 'required|string|max:255',
            'voters.*.name' => 'required|string|max:255',
            'voters.*.phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $registered = [];
        $failed = [];

        foreach ($request->voters as $voterData) {
            // Check if voter already exists
            $existingVoter = Voter::where('election_id', $request->election_id)
                ->where('voter_id', $voterData['voter_id'])
                ->first();

            if ($existingVoter) {
                $failed[] = [
                    'voter_id' => $voterData['voter_id'],
                    'reason' => 'Already registered'
                ];
                continue;
            }

            $voter = Voter::create([
                'election_id' => $request->election_id,
                'voter_id' => $voterData['voter_id'],
                'name' => $voterData['name'],
                'phone' => $voterData['phone'] ?? null,
            ]);

            $registered[] = [
                'id' => $voter->id,
                'voter_id' => $voter->voter_id,
                'name' => $voter->name,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Bulk registration completed',
            'data' => [
                'registered' => count($registered),
                'failed' => count($failed),
                'voters' => $registered,
                'errors' => $failed,
            ]
        ], 201);
    }
}
