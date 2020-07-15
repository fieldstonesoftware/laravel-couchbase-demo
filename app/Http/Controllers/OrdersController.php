<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateOrderRequest;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $placedOrders = Order::where('s_status', Order::ORDER_STATUS_PLACED)
            ->orderBy('dt_order_placed', 'desc')
            ->get();
        $deliveredOrders = Order::where('s_status', Order::ORDER_STATUS_DELIVERED)
            ->orderBy('dt_order_placed', 'desc')
            ->get();
        return view('orders.index', compact('placedOrders', 'deliveredOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return RedirectResponse
     */
    public function store(CreateOrderRequest $request)
    {
        // our request takes care of our input validation so we can now assume
        // our input is present and valid.
        $order = Order::createFromRequest($request);
        flashSUCCESS('Order Created!');
        return redirect()->route('orders.show', $order->_id);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Order $order
     * @return View
     */
    public function show(Request $request, Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if($request->has('s_status')){
            $order->s_status = $request->input('s_status');

            if($order->s_status === Order::ORDER_STATUS_DELIVERED){
                $order->dt_order_delivered = Carbon::now('UTC');
            }

            $order->save();
            flashSUCCESS('Order Updated!');
        }


        return redirect()->route('orders.show', $order->_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
