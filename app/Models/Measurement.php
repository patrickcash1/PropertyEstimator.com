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
		'mms_other',
		'mms_lawn_area',
		'mms_roof_area',
		'mms_roof_pitch',
		'mms_roof_perimeter',
		'mms_fence',
		'mms_driveway_area',
		'mms_stories_num'
,		'mms_fence',
		'mms_img',
		'mms_comments',
		'mms_entered_at'
    ];
}
