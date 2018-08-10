<?php

namespace App\Mail;

use App\Models\Event_prize;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
//声明一个仅供的属性来存订单模型对象
    public $prize;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event_prize $prize)
    {
        //从外部传入订单实例
        $this->prize=$prize;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('2219274955@qq.com')
            ->subject("中奖通知")
            ->view('admin.mail.order',['prize'=>$this->prize]);
    }
}
