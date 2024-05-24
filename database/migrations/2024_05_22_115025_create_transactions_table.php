<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('booking_id')->constrained('bookings');
            $table->decimal('amount', 8, 2);
            $table->date('payment_date');
            $table->string('payment_method'); // e.g., 'credit_card', 'paypal'
            $table->enum('status', ['completed', 'pending', 'failed']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

