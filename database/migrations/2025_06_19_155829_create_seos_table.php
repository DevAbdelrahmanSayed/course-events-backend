<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->morphs('seoable');
            $table->string('meta_title', 60)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->string('og_description', 160)->nullable();
            $table->string('og_title', 60)->nullable();
            $table->string('og_alt', 125)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
