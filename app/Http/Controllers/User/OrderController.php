<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use App\Models\Order;
use App\Models\AppConst;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Exception\Exception;

use App\Events\OrderCanceled;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function newOrders(){
        $orders = Order::where('pending','=', true)->paginate(AppConst::DEFAULT_PER_PAGE);
        $orders->load('user');
        return view('order.new_orders')->with('orders', $orders);
    }
    public function orderProcessing(){
        $orders = Order::where('processing','=', true)->paginate(AppConst::DEFAULT_PER_PAGE);
        $orders->load('user');
        return view('order.processing_orders')->with('orders', $orders);
    }
    public function orderDelivered(){
        $orders = Order::where('delivered','=', true)->paginate(AppConst::DEFAULT_PER_PAGE);
        $orders->load('user');
        return view('order.delivered_orders')->with('orders', $orders);
    }
    public function orderCanceled(){
        $orders = Order::where('canceled','=', true)->paginate(AppConst::DEFAULT_PER_PAGE);
        $orders->load('user');
        return view('order.canceled_orders')->with('orders', $orders);
    }
    public function markDelivered(Order $order){
        $order->delivered = true;
        $order->processing = false;
        $order->update();
        return redirect()->back();
    }
    public function markCanceled(Order $order){
        $order->pending = false;
        $order->processing = false;
        $order->delivered = false;
        $order->canceled = true;
        $order->update();
        OrderCanceled::dispatch($order->books);
        return redirect()->back();
    }
    public function receiveOrder(Order $order){
        $order->pending = false;
        $order->delivered = false;
        $order->processing = true;
        $order->update();
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        try{
            // tao don hang
            $order = new Order;
            $order->fill($request->all());
            $order->user_id = auth()->user()->id;
            $order->transaction_id = Str::random(AppConst::TRANSACTION_CODE);
            $order->save();
            // Attach sach vao don hang
            $books = $request->books;
            foreach($books as $book){
                $item = Book::find($book['id']);
                $order->books()->attach(
                    $item,
                    [
                        'quantity' => $book['pivot']['quantity'],
                        'price' => $book['price'],
                        'discount' => $book['discount']
                    ]
                );
                // cap nhap so luong sach va so luong ban ra
                $item->quantity -= $book['pivot']['quantity'];
                $item->sold += $book['pivot']['quantity'];
                $item->update();
            }
            return response()->json(['success' => true, 'status' => 201]);
        }catch(Exception $e){
            return response()->json(['e' => $e, 'status' => 401]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load('books','user');
        return view('order.order_details')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
