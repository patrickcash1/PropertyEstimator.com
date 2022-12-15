<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('as_title')->nullable();
            $table->string('as_address')->nullable();
            $table->string('as_zip')->nullable();
            $table->string('as_neighborhood')->nullable();
            $table->integer('as_worker_id')->default(0);
            $table->tinyInteger('as_priority')->default(0);
            $table->text('as_comments')->nullable();
            $table->tinyInteger('as_status')->default(0);
            $table->integer('as_added_by_user')->default(0);
            $table->dateTime('as_entered_at')->nullable();
            $table->dateTime('as_deadlilne')->nullable();
            $table->tinyInteger('as_lawn_area')->default(0);
            $table->tinyInteger('as_roof_area')->default(0);
            $table->tinyInteger('as_roof_pitch')->default(0);
            $table->tinyInteger('as_roof_perimeter')->default(0);
            $table->tinyInteger('as_fence')->default(0);
            $table->tinyInteger('as_driveway')->default(0);
            $table->string('as_lat')->nullable();
            $table->string('as_lng')->nullable();
            $table->string('as_img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_assignments');
    }
}
