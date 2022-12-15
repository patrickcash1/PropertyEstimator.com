<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'as_title',
        'as_address',
        'as_zip',
        'as_neighborhood',
        'as_worker_id',
        'as_priority',
        'as_comments',
        'as_status',
        'as_added_by_user',
        'as_entered_at',
        'as_deadlilne',
        'as_lawn_area',
        'as_roof_area',
        'as_roof_pitch',
        'as_roof_perimeter',
        'as_fence',
        'as_driveway',
        'as_lat',
        'as_lng'
    ];
}
