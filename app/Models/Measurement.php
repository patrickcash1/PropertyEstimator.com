<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mms_entered_by_user',
		'mms_address1',
		'mms_address2',
		'mms_locality',
		'mms_town',
		'mms_country_name',
		'mms_country_code',
		'mms_city',
		'mms_state',
		'mms_state_code',
		'mms_zip',
		'mms_lat',
		'mms_lng',
		'mms_property_size',
		'mms_property_size_unit',
		'mms_house_size',
		'mms_house_size_unit',
		'mms_paved_area',
		'mms_paved_area_unit',
		'mms_planting_area',
		'mms_planting_area_unit',
		'mms_lawn_area',
		'mms_lawn_area_unit',
		'mms_roof_area',
		'mms_roof_area_unit',
		'mms_roof_pitch',
		'mms_roof_perimeter',
		'mms_roof_perimeter_unit',
		'mms_driveway_area',
		'mms_driveway_area_unit',
		'mms_front_width',
		'mms_front_width_unit',
		'mms_other',
		'mms_img',
		'mms_img_front',
		'mms_img_satellite',
		'mms_stories_num'
,		'mms_fence',
		'mms_comments',
		'mms_entered_at'
    ];
}
