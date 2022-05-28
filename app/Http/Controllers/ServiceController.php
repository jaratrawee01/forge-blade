<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services']=Service::get();
        return view('com.service',$data);
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
                'service_name'=>'required|unique:services',
                'service_image'=>'required|mimes:jpg,jpeg,png'
            ],
            [
                
                'service_name.required'=>"กรุณาป้องชื่อตำแหน่งงาน",
                'service_name.unique'=> "มีข้อมูลในฐานข้อมูลแล้ว",
                'service_image.required'=>"กรุณาใส่ภาพประกอบตำแหน่งงาน",
                
            ]
            );
             //การเข้าระหัสภาพ
             $service_image = $request->file('service_image');
             //grnerate ชื่อภาพ
             $name_gen=hexdec(uniqid());
            //การดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;

            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/services/';
            $full_path = $upload_location.$img_name;

            Service::insert([
                'service_name'=>$request->service_name,
                'service_image'=>$full_path,
                'created_at'=>Carbon::now()
            ]);
            $service_image->move($upload_location,$img_name);
            return redirect('service')->with('success','บันทึกข้อมูลเรียบร้อย');
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
        $service = Service::find($id);
        return view('com.edit_service',compact('service'));
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
                'service_name'=>'required|max:255',
            ],
            [
                
                'service_name.required'=>"กรุณาป้องชื่อตำแหน่งงาน",
                
            ]);
             $service_image = $request->file('service_image');

            //อัพเดดภาพและชื่อ
            if ($service_image) {

                //grnerate ชื่อภาพ
                $name_gen=hexdec(uniqid());

                //การดึงนามสกุลไฟล์ภาพ
                 $img_ext = strtolower($service_image->getClientOriginalExtension());
                $img_name = $name_gen.'.'.$img_ext;
 
                //อัพโหลดและบันทึกข้อมูล
                 $upload_location = 'image/services/';
                 $full_path = $upload_location.$img_name;

                 //อัพเดดข้อมูล
                Service::find($id)->update([
                    'service_name'=>$request->service_name,
                    'service_image'=>$full_path,
                ]);

             //ลบภาพเก่าอัพภาพใหม่
            $old_image = $request->old_image;
            unlink($old_image);
            $service_image->move($upload_location,$img_name);

             return redirect('service')->with('success','อัพเดดภาพเรียบร้อย');

            }else{
                //อัพเดดชื่ออย่างเดียว
                   //อัพเดดข้อมูล
                   Service::find($id)->update([
                    'service_name'=>$request->service_name,
                ]);
                return redirect('service')->with('success','อัพเดดชื่อบริการเรียบร้อย');
            }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Service::find($id);
        $user->delete();
        return redirect('service')->with('success','ลบข้อมูลเรียบร้อย');

/*         $img = Service::find($id)->service_image;
        unlink($img);
        
        //ลบจากฐานข้เอมูล
        $delete = Service::find($id)->delete();
        return redirect('service')->with('success','ลบข้อมูลเรียบร้อย'); */
    }

}

