<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('blog_translate', function(Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('blog');
            $table->string('lang');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('full_text')->nullable();
            $table->string('date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('blog_translate');
    }
};
