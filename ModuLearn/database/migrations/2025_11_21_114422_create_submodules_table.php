<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('submodules', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('module_id');

            $table->string('title');
            $table->enum('content_type', ['pdf', 'doc', 'ppt', 'video', 'text']);
            $table->string('content_url');
            $table->integer('order');
            
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submodules');
    }
};
