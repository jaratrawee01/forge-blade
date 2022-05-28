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
                <table class="table table-warning mt-4">
                    <thead >
                        <tr align='center'>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">อีเมล</th>
                            <th scope="col">เข้าสู่ระบบ</th>
                            <th scope="col">แก้ไข+ลบข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody align='center'>
                        @php($i=1)
                        @foreach($users as $row)
                        <tr>
                            <th>{{$i++}}</th>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->created_at->diffForHumans()}}</td>
                            <td>
                                <form action="{{ route('user.destroy', $row->id) }}" method="post">
                                    <a href="{{route('user.edit', $row->id)}}" class="btn btn-warning">แก้ไขข้อมูล</a>
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
</x-app-layout>