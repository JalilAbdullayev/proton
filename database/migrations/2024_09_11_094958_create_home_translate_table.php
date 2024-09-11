<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('home_translate', function(Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained('home');
            $table->string('lang');
            $table->string('services_title')->nullable();
            $table->string('services_subtitle')->nullable();
            $table->string('portfolio_title')->nullable();
            $table->string('portfolio_subtitle')->nullable();
            $table->string('clients_title')->nullable();
            $table->string('team_title')->nullable();
            $table->string('team_subtitle')->nullable();
            $table->string('blog_title')->nullable();
            $table->string('blog_subtitle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('home_translate');
    }
};
