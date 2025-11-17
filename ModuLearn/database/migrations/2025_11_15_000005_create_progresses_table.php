<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->foreignId('submodul_id')->constrained('submoduls')->onDelete('cascade');
            $table->enum('status', ['done'])->default('done');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // prevent duplicate mark-as-done entries per user+submodul
            $table->unique(['user_id','submodul_id']);
            $table->index(['user_id','modul_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progresses');
    }
};
