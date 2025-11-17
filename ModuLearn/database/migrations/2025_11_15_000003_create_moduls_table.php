<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            // mentor (author)
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            // category (course/pelajaran)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('likes')->default(0)->comment('thumbs up count');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['mentor_id']);
            $table->index(['category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
