<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Event extends Model
{
	use Sluggable;
	use SluggableScopeHelpers;
    
    protected $table = "event";
    protected $primaryKey = "event_id";

    protected $fillable = [
		'title',
	    'summary',
	    'description',
	    'event_img',
	    'event_type',
	    'event_host',
	    'start_date',
	    'end_date',
	    'price',
	    'availability', 
	    'max_guest',
	    'enabled'
    ];
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    //SEARCH EVENT
    public static function searchEvent($keyword)
    {
        return Event::where('title', 'LIKE', "%$keyword%")->get();
    }
}
