<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::latest()->get();

        return view('backend.category.category_all',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.category_add');
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
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_path= 'uploads/category/';
        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }
        Image::make($image)->resize(300,300)->save($save_path.$name_gen);
        $save_url = $save_path.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url, 
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('category.all')->with($notification); 
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
        $category = Category::findOrFail($id);

        return view('backend.category.category_edit',compact('category'));
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
            'category_name' => 'required|max:191',
           
        ]);   


        $category = Category::find($id);  

        if($request->file('category_image')){

            $image = $request->file('category_image');
            //remove exisiting image
            if(file_exists($category->category_image)){
                @unlink(public_path($category->category_image));
            }
            

            //generate new name for new image
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path= 'uploads/category/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            Image::make($image)->resize(300,300)->save($save_path.$name_gen);
            $save_url = $save_path.$name_gen;
            //update image
            $category->category_image = $save_url;
        }
        
        //update name
        $category->category_name = $request->category_name;
        $category->category_slug =  strtolower(str_replace(' ', '-',$request->category_name));

        $category->save();

        $notification = array(
            'message' => 'Category updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('category.all')->with($notification); 
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
        $category = Category::find($id);

        //remove exisiting image
        if(file_exists($category->category_image)){
            @unlink(public_path($category->category_image));
        }


        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function delete($id)
    {
        //
        $category = Category::find($id);

        //remove exisiting image
        if(file_exists($category->category_image)){
            @unlink(public_path($category->category_image));
        }


        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}
