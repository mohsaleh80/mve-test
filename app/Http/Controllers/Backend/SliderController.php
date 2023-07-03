<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    //

    public function index()
    {
        //
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_all',compact('sliders'));
    } // end Method

    public function create()
    {
        //
        return view('backend.slider.slider_add');
    }// end Method


    public function store(Request $request)
    {
        //
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_path= 'uploads/slider/';
        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }
        Image::make($image)->resize(2376,807)->save($save_path.$name_gen);
        $save_url = $save_path.$name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url, 
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('slider.all')->with($notification); 
    } // End Method


    public function edit($id)
    {
        //
        $slider = Slider::findOrFail($id);

        return view('backend.slider.slider_edit',compact('slider'));
    } // End Method


    public function update(Request $request, $id)
    {
        //
        


        $slider = Slider::find($id);  

        if($request->file('slider_image')){

            $image = $request->file('slider_image');
            //remove exisiting image
            if(file_exists($slider->slider_image)){
                @unlink(public_path($slider->slider_image));
            }
            

            //generate new name for new image
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path= 'uploads/slider/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            Image::make($image)->resize(2376,807)->save($save_path.$name_gen);
            $save_url = $save_path.$name_gen;
            //update image
            $slider->slider_image = $save_url;
        }
        
        //update name
        $slider->slider_title = $request->slider_title;
        $slider->short_title = $request->short_title;

        $slider->save();

        $notification = array(
            'message' => 'Slider updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('slider.all')->with($notification); 
    }



    public function delete($id)
    {
        //
        $slider = Slider::find($id);

        //remove exisiting image
        if(file_exists($slider->slider_image)){
            @unlink(public_path($slider->slider_image));
        }


        $slider->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}
