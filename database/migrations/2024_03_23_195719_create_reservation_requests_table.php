<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_request_id')->constrained()->default(2);
            $table->foreignId('period_id')->constrained();
            $table->string('reason_reservation');
            $table->date('date_reservation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_requests');
    }
}
