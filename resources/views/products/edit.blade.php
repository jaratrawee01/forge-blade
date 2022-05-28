<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<x-app-layout>
    <div class="py-12">
            @if (session("success"))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('product.update', $product->id )}}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="">ชื่อสินค้า</label>
                        <input class="form-control mt-2" type="text" name="name" value="{{$product->name}}" >
                        <label for="" class="mt-2">ราคาสินค้า</label>
                        <input class="form-control mt-2" type="number" name="price" value="{{$product->price}}" >
                        <button class="btn btn-dark mt-3" type="submit">อัพเดด</button>
                    </form>  
                </div>
            </div>
        </div>       
    </div>
    </x-app-layout>
</body>
</html>