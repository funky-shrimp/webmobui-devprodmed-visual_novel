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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade'); // Relation avec chapters
            $table->foreignId('next_chapter_id')->nullable()->constrained('chapters')->onDelete('set null'); // Relation avec le chapitre suivant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
