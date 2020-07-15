@extends('layouts.app')
@section('content')

    Status: <span class="badge badge-primary">{{ $order->s_status }}</span>
    @if($order->s_status === \App\Models\Order::ORDER_STATUS_PLACED)
        <p class="small">Placed <b>{{ $order->dt_order_placed->diffForHumans() }}</b></p>

        <div class="my-3">
            {!! Form::open(['method'=>'PATCH', 'route'=>['orders.update', $order->_id]]) !!}
            <input type="hidden" name="s_status" value="{!! \App\Models\Order::ORDER_STATUS_DELIVERED !!}">
            {!! Form::submit('Set DELIVERED', ['class'=>'btn btn-primary form-control']) !!}
            {!! Form::close() !!}
        </div>
    @endif
    @if($order->s_status === \App\Models\Order::ORDER_STATUS_DELIVERED)
        <p class="small">Delivered <b>{{ $order->dt_order_delivered->diffForHumans() }}</b></p>
    @endif

    <h3>Order: {{ $order->s_customer_name }} ({{ $order->s_customer_phone }})</h3>
    <p>Placed {{ $order->dt_order_placed->toDayDateTimeString() }} UTC</p>
    @if($order->fDelivered())
        <p>Delivered {{ $order->dt_order_delivered->toDayDateTimeString() }} UTC</p>
    @endif

    <div class="my-4">
        {!! Form::open(['method'=>'DELETE'
            ,'route'=>['orders.destroy',$order->_id]
            ,'onsubmit'=>'return confirm("Click OK to delete this Order")']) !!}
        {!! Form::submit('Delete Order', ['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>

@endsection