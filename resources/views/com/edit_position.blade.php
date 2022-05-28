<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ชื่อผู้ใช้ {{Auth::user()->name}}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="container">
                <div class="row">
                @if (session("success"))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif
                    <form action="{{route('position.update',$user->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group my-3">
                                    <strong>Name</strong>
                                    <input type="text" name="position_work" value="{{$user->position_work}}" class="form-control">
                                    @error('position_work')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary my-3">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

</html>