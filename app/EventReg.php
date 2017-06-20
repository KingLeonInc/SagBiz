<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventReg extends Model
{
    protected $table = "event_reg";
    protected $primaryKey = "event_reg_id";

    protected $fillable = [
        'event_id',
        'name',
        'gender', 
        'email',
        'phone',
        'bdate',
        'company',            
        'enabled'
    ];
            
}
