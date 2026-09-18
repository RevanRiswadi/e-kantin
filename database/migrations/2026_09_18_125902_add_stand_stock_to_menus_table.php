<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Nama stand kantin, contoh: "Stand 1 - Makanan Utama"
            $table->string('stand')->default('Stand 1')->after('category');
            // Sisa stok, null = tidak terbatas
            $table->unsignedInteger('stock')->nullable()->after('stand');
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['stand', 'stock']);
        });
    }
};
