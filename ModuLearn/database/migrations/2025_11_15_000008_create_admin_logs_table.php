<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id();

            // admin user
            $table->foreignId('admin_id')
                ->constrained('users')
                ->onDelete('cascade');

            // jenis aksi
            $table->string('action');

            // target aksi (opsional)
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('target_id')->nullable();

            // deskripsi tambahan
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_logs');
    }
};
