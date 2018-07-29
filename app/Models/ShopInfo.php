<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopInfo extends Model
{
    //
    public $fillable=['shop_category_id','shop_name','shop_rating','shop_img','brand','on_time','fengniao',
        'bao','piao','zhun','start_send','start_cost','notice','discount','status','shop_user_id'

    ];

    //连表shopCate
    public function shopCategory(){
        return $this->belongsTo(ShopCategory::class,"shop_category_id");


    }
    ////通过商家人找商家 -对-
    public function shop_user(){
        return $this->hasOne(User::class,"id");
    }




}
