<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop foreign key dulu
            $table->dropForeign(['user_id']);

            // Ubah jadi nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Tambahkan kembali foreign key
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['user_id']);

            // Ubah kembali jadi tidak nullable
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Tambahkan kembali foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
