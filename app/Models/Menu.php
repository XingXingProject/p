<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //设置可编辑字段
    public $fillable=['goods_id','rating','shop_info_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'
    ];


    //连表商家店铺表shopInfo
    public function shopInfo(){
        return $this->belongsTo(ShopInfo::class,'shop_info_id');
    }

    //连表菜单分类表
    public function menuCategory(){
        return $this->belongsTo(MenuCategory::class,'category_id');

    }

}
