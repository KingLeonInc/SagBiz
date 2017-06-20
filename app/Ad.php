<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = "ads";
    protected $primaryKey = "ad_id";

    protected $fillable = [
    	'ad_title',
        'ad_type', // ['photo', 'video']
        'ad_link',
        'ad_background_photo', // AD BACKGROUND IMAGE
        'ad_video_file', // nullable(); // VIDEO FILE OR LINK 
        'ad_video_link', // nullable();
        'ad_start_date',
        'ad_end_date',
        'enabled' // [0, 1]
    ];
}
