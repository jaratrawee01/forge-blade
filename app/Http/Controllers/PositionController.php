<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['positions']=Position::orderBy('id','asc')->get();
        return view('com.position',$data);
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
        $request->validate(
        [
            'position_work'=>'required|unique:positions'
        ],
        [
            
            'position_work.required'=>"กรุณาป้องชื่อตำแหน่งงาน",
            'position_work.unique'=> "มีข้อมูลในฐานข้อมูลแล้ว"
        ]
        );

        $user = new Position;
        $user->position_work = $request->position_work;
        $user->user_id = Auth::user()->id;
        $user->save();
        return redirect('position')->with('success','บันทึกข้อมูลเรียบร้อย');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
         $user=Position::find($id);
        return view('com.edit_position',['user'=>$user]);
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
        $request->validate(
            [
            'position_work'=>'required|unique:positions'
            ],
            [
                
            'position_work.required'=>"กรุณาป้องชื่อตำแหน่งงาน",
            'position_work.unique'=> "มีข้อมูลในฐานข้อมูลแล้ว"
            ]
            );
        $user = Position::find($id);
        $user->position_work = $request->position_work;
        $user->save();
        return redirect('position')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
   
        $user = Position::find($id);
        $user->delete();
        return redirect('position')->with('success','ลบข้อมูลเรียบร้อย');
    }
}
