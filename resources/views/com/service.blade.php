<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
</head>

<body>
    <x-app-layout>
    <div class="py-12">
        <div class="container">
                @if (session("success"))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">ตำแหน่งบริการ</div>
                            <div class="card-body">
                                <table class="table table-primary">
                                    <thead >
                                        <tr align='center'>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ภาพประกอบ</th>
                                            <th scope="col">ชื่อบริการ</th>
                                            <th scope="col">created_at</th>  
                                            <th scope="col">Edit+Delete</th>  
                                        </tr>
                                    </thead>
                                    <tbody align='center'>
                                        @php($i=1)
                                        @foreach($services as $row)
                                        <tr>
                                            <th>{{$i++}}</th>
                                            <td>
                                            <img src="{{asset($row->service_image)}}" alt="" width="80px" height="80px">
                                            </td>
                                            <td>{{$row->service_name}}</td>
                                            <td>{{$row->created_at->diffForHumans()}}</td>
                                            <td>
                                            <form action="{{ route('service.destroy', $row->id) }}" method="post">
                                                    <a href="{{route('service.edit', $row->id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">ลบข้อมูล</button>
                                                </form> 
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์มบริการ</div>
                            <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <strong>ชื่อบริการ</strong>
                                        <input type="tsxt" name="service_name" class="form-control mt-2">
                                        @error('service_name')
                                        <div class="alert alert-danger my-2">{{$message}}</div>
                                         @enderror 
                                    </div>
                                    <div class="form-group mt-3">
                                        <strong>ภาพปรพกอบ</strong>
                                        <input type="file" name="service_image" class="form-control mt-2">
                                        @error('service_image')
                                        <div class="alert alert-danger my-2">{{$message}}</div>
                                         @enderror
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary mt-4">บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    </x-app-layout>
</body>

</html>