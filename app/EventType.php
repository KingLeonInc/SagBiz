<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = "event_type";
    protected $primaryKey = "event_type_id";

    protected $fillable = ['name', 'description', 'enabled'];
            
}
