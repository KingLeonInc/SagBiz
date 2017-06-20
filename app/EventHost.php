<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventHost extends Model
{
    protected $table = "event_host";
    protected $primaryKey = "event_host_id";

    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'address',
        'additional_info',
        'enabled'
    ];
    //SEARCH EVENT Host
    public static function searchEventHost($keyword)
    {
        return EventHost::where('name', 'LIKE', "%$keyword%")
                            ->orWhere('company', 'LIKE', "%$keyword%")
                            ->orWhere('phone', 'LIKE', "%$keyword%")
                            ->orWhere('email', 'LIKE', "%$keyword%")
                            ->get();
    }
}
