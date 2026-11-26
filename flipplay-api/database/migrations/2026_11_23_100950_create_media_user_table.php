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
        Schema::create('media_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //hapus relasi otomatis jika User atau Media dihapus
            $table->foreignId('media_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['user_id', 'media_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_user');
    }
};
