<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_payments', function (Blueprint $table) {
            $table->id();
            $table->string('worker_id')->nullable();
            $table->integer('worker_total_entries')->default(0);
            $table->decimal('worker_paid_at_rate', 10, 2)->default(0);
            $table->decimal('worker_total_paid', 10, 2)->default(0);
            $table->dateTime('worker_paid_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_payments');
    }
}
