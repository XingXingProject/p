<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //
    public $fillable=['name','type_id','shop_info_id','description','status'];


    //连表shopInfo表
    public function shopInfo(){
        return $this->belongsTo(ShopInfo::class,'shop_info_id');

    }
}
