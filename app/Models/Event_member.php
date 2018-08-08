<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_member extends Model
{
    //
    public $fillable=['event_id','user_id'];

    //商家名字
    public function user(){

        return $this->belongsTo(User::class,'user_id');

    }

    //活动名字
    public function eve(){

        return $this->belongsTo(Event::class,'id');

    }
}
