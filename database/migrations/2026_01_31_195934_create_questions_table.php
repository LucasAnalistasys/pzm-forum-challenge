<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Requisito UUID
            $table->string('title');
            $table->string('slug')->unique(); // Requisito Slug
            $table->text('body');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade'); // Vincula ao User UUID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
