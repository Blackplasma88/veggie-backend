<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::paginate(Order::get()->count());
        return new OrderCollection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Order|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->data = $request->data;
        $order->amount = $request->amount;
        $order->status = $request->status;
        $order->save();
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OrderResource|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }
}
