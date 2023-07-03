<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::latest()->get();

        return view('backend.banner.banner_all',compact('banners'));
    }


    public function create()
    {
        //
        return view('backend.banner.banner_add');
    }// end Method

    


    public function store(Request $request)
    {
        //
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_path= 'uploads/banner/';
        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }
        Image::make($image)->resize(768,450)->save($save_path.$name_gen);
        $save_url = $save_path.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url, 
        ]);

        $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('banner.all')->with($notification); 
    } // End Method


    public function edit($id)
    {
        //
        $banner = Banner::findOrFail($id);

        return view('backend.banner.banner_edit',compact('banner'));
    } // End Method


    public function update(Request $request, $id)
    {
        //
        $banner = Banner::find($id);  

        if($request->file('banner_image')){

            $image = $request->file('banner_image');
            //remove exisiting image
            if(file_exists($banner->banner_image)){
                @unlink(public_path($banner->banner_image));
            }
            

            //generate new name for new image
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path= 'uploads/banner/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            Image::make($image)->resize(768,450)->save($save_path.$name_gen);
            $save_url = $save_path.$name_gen;
            //update image
            $banner->banner_image = $save_url;
        }
        
        //update name
        $banner->banner_title = $request->banner_title;
        $banner->banner_url= $request->banner_url;

        $banner->save();

        $notification = array(
            'message' => 'Banner updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('banner.all')->with($notification); 
    }


    public function delete($id)
    {
        //
        $banner = Banner::find($id);

        //remove exisiting image
        if(file_exists($banner->banner_image)){
            @unlink(public_path($banner->banner_image));
        }


        $banner->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}
