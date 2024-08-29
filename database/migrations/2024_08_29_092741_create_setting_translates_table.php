<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('setting_translates', function(Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('settings_id');
            $table->string('title');
            $table->string('author');
            $table->text('keywords');
            $table->text('description');
            $table->string('lang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('setting_translates');
    }
};
