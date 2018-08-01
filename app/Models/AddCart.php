<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddCart extends Model
{
    //
    public $fillable=['user_id','goods_id','amount'];
}
