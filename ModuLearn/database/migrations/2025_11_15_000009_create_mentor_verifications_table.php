<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_verifications', function (Blueprint $table) {
            $table->id();

            // relasi ke tabel users
            $table->unsignedBigInteger('user_id');

            // status default: pending
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // optional catatan
            $table->text('notes')->nullable();

            $table->timestamps();

            // foreign key
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_verifications');
    }
};
