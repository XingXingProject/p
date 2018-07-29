<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    //
    public $fillable=['id','name','password','email','status'];


    //连表shop_info
    ////通过商家人找商家 -对-
    public function shopInfo(){
        return $this->hasOne(ShopInfo::class,"id");
    }

    //连表shopCate
    public function shopCategory(){
        return $this->belongsTo(ShopCategory::class,"shop_category_id");


    }


}
