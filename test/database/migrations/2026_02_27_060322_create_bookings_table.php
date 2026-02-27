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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('room', ['зал', 'ресторан', 'летняя веранда', 'закрытая веранда']);
            $table->date('banket_date');
            $table->enum('status', ['Новая', 'Банкет назначен', 'Банкет завершен']);
            $table->enum('payments', ['наличные', 'карта', 'онлайн']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
