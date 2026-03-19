<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Check if column exists
        if (!Schema::hasColumn('elections', 'uuid')) {
            Schema::table('elections', function (Blueprint $table) {
                $table->uuid('uuid')->nullable()->after('id');
            });

            // Generate UUIDs for existing elections
            DB::table('elections')->whereNull('uuid')->get()->each(function ($election) {
                DB::table('elections')->where('id', $election->id)->update(['uuid' => Str::uuid()]);
            });

            Schema::table('elections', function (Blueprint $table) {
                $table->uuid('uuid')->unique()->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('elections', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
