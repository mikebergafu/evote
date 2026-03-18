<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('election_id')->constrained()->cascadeOnDelete();
            $table->string('voter_id')->unique();
            $table->string('name');
            $table->string('device_fingerprint')->nullable();
            $table->boolean('device_registered')->default(false);
            $table->boolean('has_voted')->default(false);
            $table->timestamp('voted_at')->nullable();
            $table->timestamps();
            
            $table->index(['election_id', 'voter_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
