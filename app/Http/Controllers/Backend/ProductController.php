<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    //

    public function getAllProducts(){

        $products = Product::latest()->get();
        return view('backend.product.product_all',compact('products'));


    } // End Method 

    public function AddProduct(){

       // return view('backend.product.product_add');
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add',compact('brands','categories','activeVendor'));

    } // End Method 


    public function StoreProduct(Request $request){


        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('uploads/products/thambnail/'.$name_gen);
        $save_url = 'uploads/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp, 

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals, 

            'product_thambnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(), 

        ]);

        /// Multiple Image Upload From her //////

        $images = $request->file('multi_img');

        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(800,800)->save('uploads/products/multi-image/'.$make_name);
            $uploadPath = 'uploads/products/multi-image/'.$make_name;
            
            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(), 
    
            ]); 
            } // end foreach
    
            /// End Multiple Image Upload From her //////
    
            $notification = array(
                'message' => 'Product Inserted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.product')->with($notification); 


    } // End Method 

    public function EditProduct($id){
         $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
         $brands = Brand::latest()->get();
         $categories = Category::latest()->get(); 
         $products = Product::findOrFail($id);
         $subcategory = SubCategory::where('category_id',$products->category_id)->latest()->get();
         $product_images = MultiImg::where('product_id',$products->id)->latest()->get();
        // dd($product_images[0]->photo_name);
         return view('backend.product.product_edit',compact('brands','categories','activeVendor','products','subcategory','product_images'));
     }// End Method 


     public function UpdateProduct(Request $request,$id){

        $product_id = $id;

        $product = Product::findOrFail($product_id);

        $image = $request->file('product_thambnail');

        if(is_null($image)){
            $save_url = $product->product_thambnail;
        }else{
            @unlink(public_path($product->product_thambnail));
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('uploads/products/thambnail/'.$name_gen);
            $save_url = 'uploads/products/thambnail/'.$name_gen;
        }
        

        Product::findOrFail($product_id)->update([

       'brand_id' => $request->brand_id,
       'category_id' => $request->category_id,
       'subcategory_id' => $request->subcategory_id,
       'product_name' => $request->product_name,
       'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

       'product_code' => $request->product_code,
       'product_qty' => $request->product_qty,
       'product_tags' => $request->product_tags,
       'product_size' => $request->product_size,
       'product_color' => $request->product_color,

       'selling_price' => $request->selling_price,
       'discount_price' => $request->discount_price,
       'short_descp' => $request->short_descp,
       'long_descp' => $request->long_descp, 

       'hot_deals' => $request->hot_deals,
       'featured' => $request->featured,
       'special_offer' => $request->special_offer,
       'special_deals' => $request->special_deals, 

       'product_thambnail' => $save_url,
       'vendor_id' => $request->vendor_id,
       'status' => 1,
       'updated_at' => Carbon::now(), 

   ]);

    /// Multiple Image Upload From her //////

    $new_images = $request->file('multi_img');
    $multi_images = MultiImg::where('product_id',$product->id)->latest()->get();

    if(! is_null($new_images)){

       // delete multi images from db and upload file
       foreach($multi_images as $img){
         @unlink(public_path($img->photo_name));
         MultiImg::find($img->id)->delete();

       }


       //upload and insert new multi images
        foreach($new_images as $img){
            
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(800,800)->save('uploads/products/multi-image/'.$make_name);
            $uploadPath = 'uploads/products/multi-image/'.$make_name;
            
            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(), 

            ]); 
            } // end foreach
        }
        /// End Multiple Image Upload From her //////


    $notification = array(
       'message' => 'Product Updated Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.product')->with($notification); 

}// End Method 


// Multi Image Update 
public function UpdateProductMultiimage(Request $request,$id){

    
    
    $new_image= $request->new_image;

    if(is_null($request->new_image)){
        $notification = array(
            'message' => 'Image is required',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification); 
    }

    
        $imgDel = MultiImg::findOrFail($id);
        unlink(public_path($imgDel->photo_name));

        $make_name = hexdec(uniqid()).'.'.$new_image->getClientOriginalExtension();
        Image::make($new_image)->resize(800,800)->save('uploads/products/multi-image/'.$make_name);
        $uploadPath = 'uploads/products/multi-image/'.$make_name;

    MultiImg::where('id',$id)->update([
        'photo_name' => $uploadPath,
        'updated_at' => Carbon::now(),

    ]); 
   

     $notification = array(
        'message' => 'Product Multi Image Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 

}// End Method 


public function DeleteProductMultiimage($id){

    $image = MultiImg::find($id);

    if(! is_null($image)){

       // delete image from db and upload file
       
         @unlink(public_path($img->photo_name));
         $image->delete();

       }

       $notification = array(
        'message' => ' Image Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 

} /// End Method


public function ChangeStatusProduct($id){

    $product = Product::findOrFail($id);

    if($product->status == 1){

        $product->update([ 
            'status' => 0
        ]);

    }else{
      
        $product->update([ 
            'status' => 1
        ]);

    }

    $notification = array(
        'message' => 'Product Status Updated Successfully',
        'alert-type' => 'success'
    );
 
    return redirect()->route('all.product')->with($notification); 




} //End Method


public function DeleteProduct($id){

    $multi_images = MultiImg::where('product_id',$id)->latest()->get();
    
    if(! is_null($multi_images)){

       // delete multi images from db and upload file
       foreach($multi_images as $img){
         @unlink(public_path($img->photo_name));
         MultiImg::find($img->id)->delete();

       }

    }
    
    $product = Product::findOrFail($id);
    
    @unlink(public_path($product->product_thambnail));
    $product->delete();

    $notification = array(
        'message' => 'Product Deleted  Successfully',
        'alert-type' => 'success'
    );
 
    return redirect()->route('all.product')->with($notification); 
}



}
