<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('election_id')->constrained()->cascadeOnDelete();
            $table->foreignId('candidate_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('vote_hash')->unique();
            $table->timestamps();
            
            $table->index('election_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
