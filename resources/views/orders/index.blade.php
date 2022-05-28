<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                       <thead>
                            <tr align='center'>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>จัดการ</th>
                            </tr>
                       </thead>
                       <tbody>
                    @if($order)
                        @foreach ($order->order_details as $item)
                          <tr align='center'>
                               <td>{{$item->product_name}}</td>
                               <td>{{$item->price}}</td>
                               <td>{{$item->amount}}</td>
                               <td>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <form action="{{ route('orders.update',$order->id)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" value="decrease" name="value">
                                                <input type="hidden" value="{{$item->product_id}}" name="product_id">
                                                <button class="btn btn-danger" type="submit">-</button>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('orders.update',$order->id)}}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" value="increase" name="value">
                                                <input type="hidden" value="{{$item->product_id}}" name="product_id">
                                                <button class="btn btn-success" type="submit">+</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                          <tr>
                              <td></td>
                              <td>ราคารวม</td>
                              <td>{{$order->total}}</td>
                              <td class="text-center">
                              <form action="{{ route('orders.update',$order->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" value="checkout" name="value">
                                    <button class="btn btn-primary" type="submit">checkout</button>
                                </form> 
                              </td>
                          </tr>
                        @endif
                       </tbody>
                    </table>
                </div>
            </div>
        </div>       
    </div>
    </x-app-layout>
</body>
</html>