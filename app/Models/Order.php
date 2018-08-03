<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $fillable = ['user_id', 'shop_id', 'order_code', 'provence', 'city', 'county', 'order_address', 'tel', 'name', 'total', 'status', 'out_trade_no'];

    //返回状态数组



 public function getOrderStatusAttribute()
 {
     $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
     return $arr[$this->status];//-1 0 1 2 3

 }

    //连表
    public function shop()
    {
        return $this->belongsTo(ShopInfo::class, 'shop_id');
    }



    //查询出orderGoods的所有值
    public function goods()
    {
        return $this->hasMany(OrderGood::class, "order_id");
    }
}
