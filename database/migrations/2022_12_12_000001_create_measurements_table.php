<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->string('mms_address1')->nullable();
            $table->string('mms_address2')->nullable();
            $table->string('mms_locality')->nullable();
            $table->string('mms_town')->nullable();
            $table->string('mms_city')->nullable();
            $table->string('mms_state')->nullable();
            $table->string('mms_state_code')->nullable();
            $table->string('mms_zip')->nullable();
            $table->string('mms_country_name')->nullable();
            $table->string('mms_country_code')->nullable();
            $table->string('mms_lat')->nullable();
            $table->string('mms_lng')->nullable();
            $table->string('mms_lawn_area')->nullable();
            $table->string('mms_roof_area')->nullable();
            $table->string('mms_roof_pitch')->nullable();
            $table->string('mms_roof_perimeter')->nullable();
            $table->string('mms_driveway_area')->nullable();
            $table->string('mms_other')->nullable();
            $table->tinyInteger('mms_fence')->default(0);
            $table->tinyInteger('mms_stories_num')->default(0);
            $table->string('mms_img')->nullable();
            $table->tinyInteger('mms_status')->default(0);
            $table->integer('mms_entered_by_user')->default(0);
            $table->dateTime('mms_entered_at')->nullable();
            $table->dateTime('mms_updated_at')->nullable();
            $table->text('mms_comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_sizes');
    }
}
