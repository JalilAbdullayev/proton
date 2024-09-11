<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('contact_translate', function(Blueprint $table) {
            $table->string('title')->nullable()->after('address');
            $table->string('subtitle')->nullable()->after('title');
            $table->text('description')->nullable()->after('subtitle');
            $table->string('call_text')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('contact_translate', function(Blueprint $table) {
            $table->dropColumn(['title', 'subtitle', 'description', 'call_text']);
        });
    }
};
