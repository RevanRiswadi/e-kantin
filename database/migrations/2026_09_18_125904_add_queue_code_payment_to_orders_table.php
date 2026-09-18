<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kode antrean unik, contoh: KBT-001
            $table->string('queue_code')->nullable()->after('status');
            // Metode pembayaran
            $table->enum('payment_method', ['tunai', 'qris'])->default('tunai')->after('queue_code');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['queue_code', 'payment_method']);
        });
    }
};
