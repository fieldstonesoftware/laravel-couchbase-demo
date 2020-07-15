@extends('layouts.app')
@section('content')
    <p>This is for the purpose of demonstrating basic CRUD functionality.</p>

    {!! Form::open(['method'=>'POST','route'=>'orders.store','class'=>"mt-3"]) !!}
    <h3>Create New Order</h3>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="s_customer_name">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input type="text" class="form-control" name="s_customer_phone">
    </div>

    {!! Form::submit('Create Order',['class'=>'btn btn-primary form-control'
           ,'onclick'=>'this.disabled=true; this.form.submit();'
    ]) !!}
    {!! Form::close() !!}

    <h3 class="mt-5">Placed Orders</h3>
    @if(!empty($placedOrders))
        <table class="table table-sm table-hover m-0 p-0">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Phone</th>
                <th class="text-left">Status</th>
                <th class="text-left">Placed</th>
            </tr>
            </thead>
            <tbody class="orders-table-body">
            @foreach($placedOrders as $order)
                <tr id="{!! $order->_id !!}">
                    <td class="text-left">{{ $order->s_customer_name }}</td>
                    <td class="text-left">{{ $order->s_customer_phone }}</td>
                    <td class="text-left">{{ $order->s_status }}</td>
                    <td class="text-left">{{ $order->dt_order_placed->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No Orders Have Been Placed!</p>
    @endif

    <h3 class="mt-5">Delivered Orders</h3>
    @if(!empty($deliveredOrders))
        <table class="table table-sm table-hover m-0 p-0">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Phone</th>
                <th class="text-left">Status</th>
                <th class="text-left">Placed (UTC)</th>
                <th class="text-left">Delivered</th>
                <th class="text-left">Turn-Around</th>
            </tr>
            </thead>
            <tbody class="orders-table-body">
            @foreach($deliveredOrders as $order)
                <tr id="{!! $order->_id !!}">
                    <td class="text-left">{{ $order->s_customer_name }}</td>
                    <td class="text-left">{{ $order->s_customer_phone }}</td>
                    <td class="text-left">{{ $order->s_status }}</td>
                    <td class="text-left">{{ $order->dt_order_placed->format(myDefaultPHPDateTimeFormat()) }}</td>
                    <td class="text-left">{{ $order->dt_order_delivered->format(myDefaultPHPTimeFormat()) }}</td>
                    <td class="text-left">{{ $order->dt_order_delivered->shortAbsoluteDiffForHumans($order->dt_order_placed) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No Orders Have Been Placed!</p>
    @endif
@endsection
@section('scripts')
    @parent
    <script>
        // Open Order Page when the table row is clicked
        var showOrderRoute = "{!! route('orders.show','xxxXXXxxx') !!}";
        $('.orders-table-body').on('click','tr',function(event){
            window.location.href = showOrderRoute.replace("xxxXXXxxx", $(this).attr('id'));
        });
    </script>
@endsection
