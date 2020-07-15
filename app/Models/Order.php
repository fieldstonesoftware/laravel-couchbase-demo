<?php

namespace App\Models;

use App\Http\Requests\Orders\CreateOrderRequest;
use Carbon\Carbon;

class Order extends MyModel
{
    const ORDER_STATUS_PLACED = 'Placed';
    const ORDER_STATUS_DELIVERED = 'Delivered';

    protected $fillable = [
        's_customer_name'
        , 's_customer_phone'
    ];

    protected $dates = [
        'dt_order_placed'
        ,'dt_order_delivered'
    ];

    public function __construct(array $attributes = [])
    {
        $this->initializeAttributes();
        parent::__construct($attributes);
    }

    // We have no relational schema to lean on for setting default values of our attributes
    // so we do it when our model object is constructed.
    public function initializeAttributes()
    {
        $this->forceFill([
            's_status' => ''
            , 'dt_order_placed' => Carbon::maxValue()
            , 'dt_order_delivered' => Carbon::maxValue()
            , 's_customer_name' => null
            , 's_customer_phone' => null
        ]);
    }

    // relationships

    // getters
    public function fDelivered()
    {
        return $this->dt_order_delivered->isPast();
    }

    // attributes
    // settters
    // utility
    // statics
    public static function createFromRequest(CreateOrderRequest $request)
    {
        $order = new self($request->all());
        $order->s_status = self::ORDER_STATUS_PLACED;
        $order->dt_order_placed = Carbon::now('UTC');
        $order->save();
        return $order;
    }
}
