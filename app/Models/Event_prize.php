<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    //
    public $fillable=['event_id','name','description','user_id'];


    //连表查询活动表
    public function event(){
        return $this->belongsTo(Event::class,'event_id');

    }
    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

}
