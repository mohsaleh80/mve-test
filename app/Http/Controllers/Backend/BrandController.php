<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::latest()->get();

        return view('backend.brand.brand_all',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.brand.brand_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_path= 'uploads/brand/';
        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }
        Image::make($image)->resize(300,300)->save($save_path.$name_gen);
        $save_url = $save_path.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url, 
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('brand.all')->with($notification); 
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
        //
        $brand  = Brand::findOrFail($id);

        return view('backend.brand.brand_edit',compact('brand'));
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
        //
       
        $validated = $request->validate([
            'brand_name' => 'required|max:191',
           
        ]);   


        $brand = Brand::find($id);  

        if($request->file('brand_image')){

            $image = $request->file('brand_image');
            //remove exisiting image
            if(file_exists($brand->brand_image)){
                @unlink(public_path($brand->brand_image));
            }
            

            //generate new name for new image
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path= 'uploads/brand/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            Image::make($image)->resize(300,300)->save($save_path.$name_gen);
            $save_url = $save_path.$name_gen;
            //update image
            $brand->brand_image = $save_url;
        }
        
        //update name
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug =  strtolower(str_replace(' ', '-',$request->brand_name));

        $brand->save();

        $notification = array(
            'message' => 'Brand updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('brand.all')->with($notification); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $brand = Brand::find($id);

        //remove exisiting image
        if(file_exists($brand->brand_image)){
            @unlink(public_path($brand->brand_image));
        }


        $brand->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }
}
