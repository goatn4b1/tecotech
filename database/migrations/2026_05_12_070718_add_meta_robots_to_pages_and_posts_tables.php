<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('meta_robots')->nullable()->after('canonical_url');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('meta_robots')->nullable()->after('canonical_url');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('meta_robots');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('meta_robots');
        });
    }
};
