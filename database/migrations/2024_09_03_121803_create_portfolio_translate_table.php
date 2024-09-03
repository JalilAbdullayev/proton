<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('portfolio_translate', function(Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('portfolio');
            $table->string('lang');
            $table->string('title');
            $table->string('slug');
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->string('date')->nullable();
            $table->text('full_text')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('portfolio_translate');
    }
};
