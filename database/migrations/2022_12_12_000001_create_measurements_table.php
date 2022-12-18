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
            $table->string('mms_locality', 75)->nullable();
            $table->string('mms_town', 75)->nullable();
            $table->string('mms_city', 75)->nullable();
            $table->string('mms_state', 50)->nullable();
            $table->string('mms_state_code', 5)->nullable();
            $table->string('mms_zip', 10)->nullable();
            $table->string('mms_country_name', 75)->nullable();
            $table->string('mms_country_code', 10)->nullable();
            $table->string('mms_lat', 50)->nullable();
            $table->string('mms_lng', 50)->nullable();

            $table->string('mms_property_size', 30)->nullable();
            $table->tinyInteger('mms_property_size_unit')->default(1);

            $table->string('mms_house_size', 30)->nullable();
            $table->tinyInteger('mms_house_size_unit')->default(1);

            $table->string('mms_paved_area', 30)->nullable();
            $table->tinyInteger('mms_paved_area_unit')->default(1);

            $table->string('mms_planting_area', 30)->nullable();
            $table->tinyInteger('mms_planting_area_unit')->default(1);

            $table->string('mms_lawn_area', 30)->nullable();
            $table->tinyInteger('mms_lawn_area_unit')->default(1);

            $table->string('mms_roof_area', 30)->nullable();
            $table->tinyInteger('mms_roof_area_unit')->default(1);

            $table->string('mms_roof_pitch',5)->nullable();

            $table->string('mms_roof_perimeter', 30)->nullable();
            $table->tinyInteger('mms_roof_perimeter_unit')->default(1);

            $table->string('mms_driveway_area', 30)->nullable();
            $table->tinyInteger('mms_driveway_area_unit')->default(1);

            $table->string('mms_front_width', 30)->nullable();
            $table->tinyInteger('mms_front_width_unit')->default(1);

            $table->string('mms_other')->nullable();
            $table->tinyInteger('mms_fence')->default(0);
            $table->tinyInteger('mms_stories_num')->default(0);

            $table->string('mms_img')->nullable();
            $table->string('mms_img_front')->nullable();
            $table->string('mms_img_satellite')->nullable();

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
