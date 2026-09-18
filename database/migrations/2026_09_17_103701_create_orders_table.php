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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('student_name');
        $table->string('class_major');
        $table->string('whatsapp');
        $table->enum('break_time', ['Istirahat 1', 'Istirahat 2']);
        $table->integer('total_price');
        $table->enum('status', ['pending', 'processing', 'ready', 'completed'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
