<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('submoduls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modules_id')->constrained('modules')->onDelete('cascade');
            $table->string('title');
            // content type: pdf or video
            $table->enum('content_type', ['pdf','video'])->default('pdf');
            // stored URL/path (could be storage path or external URL)
            $table->text('content_url');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['modules_id','order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submoduls');
    }
};
