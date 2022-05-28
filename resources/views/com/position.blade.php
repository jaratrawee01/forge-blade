<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example</title>
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
                        <div class="card-header">ตำแหน่งงาน</div>
                            <div class="card-body">
                                <table class="table table-success ">
                                    <thead >
                                        <tr align='center'>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">ตำแหน่งงาน</th>
                                            <th scope="col">UserID</th>
                                            <th scope="col">created_at</th>  
                                            <th scope="col">Edit+Delete</th>  
                                        </tr>
                                    </thead>
                                    <tbody align='center'>
                                        @php($i=1)
                                        @foreach($positions as $row)
                                        <tr>
                                            <th>{{$i++}}</th>
                                            <td>{{$row->position_work}}</td>
                                            <td>{{$row->user->name}}</td>
                                            <td>{{$row->created_at->diffForHumans()}}</td>
                                            <td>

                                              <form action="{{ route('position.destroy', $row->id) }}" method="post">
                                                    <a href="{{route('position.edit', $row->id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
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
                        <div class="card-header">แบบฟอร์ม</div>
                            <div class="card-body">
                            <form action="{{route('position.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <strong>เพิ่มตำแหน่งงาน</strong>
                                        <input type="text" name="position_work" class="form-control mt-2">
                                        @error('position_work')
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