<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('portfolio_images', function(Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('portfolio');
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('portfolio_images');
    }
};