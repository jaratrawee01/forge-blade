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
                @if (session("success"))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="col-12">
                    <a href="{{route('product.create')}}" class="btn btn-primary">สร้างสินค้า</a>
                    <div class="row mt-3">
                        @foreach ($product as $item)
                         <div class="col-4">
                           <form action="{{ route('orders.store') }}" method="post">
                               @csrf
                                <div class="card p-2 mt-3">
                                    <div class="card-header ">สินค้า</div>
                                        <div class="card-body">
                                            <input type="hidden" name="product_id" placeholder="" value="{{ $item->id}}"
                                            <h5>ชื่อสินค้า : {{ $item->name }}</h5>
                                            <p> ราคา: {{ $item->price }} ฿</p>
                                            <button class="btn btn-secondary" type="submit">ชื้อ</button>
                                        </div>                  
                                </div> 
                           </form>
                            <form action="{{ route('product.destroy', $item->id) }}" method="post">
                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning mt-2">แก้ไขข้อมูล</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2">ลบข้อมูล</button>
                            </form>
                         </div>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>       
    </div>
    </x-app-layout>
</body>
</html>