<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $order = Order::where('user_id',Auth::id())
        ->where('status',0)
        ->first();
        return view('orders.index',['order'=>$order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $order = Order::where('user_id',Auth::id())->where('status',0)->first();
        if ($order){
            $orderDetail = $order->order_details()->where('product_id', $product->id)->first();
            if($orderDetail){
                $amountNew = $orderDetail->amount + 1;
                $orderDetail->update([
                    'amount' => $amountNew
                ]);
            }else{
                $prepareOrderDetail = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'amount' => 1,
                    'price' => $product->price,
                ];
                $orderDetail = OrderDetail::create($prepareOrderDetail);
            }
        }else{

            $prepareOrder = [
                'status' => 0,
                'user_id' => Auth::id()
            ];
    
            $order = Order::create($prepareOrder);
    
            
            $prepareOrderDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'amount' => 1,
                'price' => $product->price,
            ];
            $orderDetail = OrderDetail::create($prepareOrderDetail);
        }
        $totalRaw = 0;
        $total = $order->order_details->map(function ($orderDetail) use ($totalRaw){
            $totalRaw += $orderDetail->amount * $orderDetail->price;
            return $totalRaw;
       })->toArray();

        $order->update([
            'total' => array_sum($total)
        ]);

        return redirect()->route('product.index')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
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
        $orderDetail = $order->order_details()->where('product_id', $request->product_id)->first();
            
        if($request->value = "checkout"){
            $order->update([
                'status' => 1
            ]);
        }else{
            if($orderDetail){
                if($request->value == "increase"){
                    $amountNew = $orderDetail->amount + 1;
                    
                }else{
                    $amountNew = $orderDetail->amount - 1;
                }
                $orderDetail->update([
                    'amount' => $amountNew 
               ]);

               $totalRaw = 0;
               $total = $order->order_details->map(function ($orderDetail) use ($totalRaw){
                   $totalRaw += $orderDetail->amount * $orderDetail->price;
                   return $totalRaw;
              })->toArray();
       
               $order->update([
                   'total' => array_sum($total)
               ]);
        }

    }

        return redirect()->route('orders.index');
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
