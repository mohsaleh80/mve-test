<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CartController extends Controller
{
    //

    public function AddToCart(Request $request, $id){
      
        $product = Product::findOrFail($id);

        

        if(is_null($product->discount_price)){
          $price = intVal($product->selling_price);
        }else{
          $price = intVal($product->discount_price);
        }

        Cart::add(['id' => $id,
                   'name' =>  $request->product_name,
                   'qty' => $request->quantity, 
                   'price' => $price,
                   'weight' => 1, 
                   'options' => ['size' => $request->size,
                                 'color' => $request->color,
                                 'image' => $product->product_thambnail,
                                 'slug' => $product->product_slug]
                  ]
                );

              
             /*  if (Auth::check()) {

                
              
                    if(Cart::restore(strval(Auth::user()->id))){
                        
                          Cart::instance('default')->merge(strval(Auth::user()->id), $keepDiscount, $keepTaxrate, $dispatchAdd, 'default'); 
                      }else{
                       
                          Cart::store(strval(Auth::user()->id));
                      }               
                }
                */

        return response()->json(['success' => 'Product Added to Your Cart' ]);      

    } // End Add To Cart

    



    public function AddMiniCart(){

        if (Auth::check()) { 
           if(Cart::content()->count() > 0){
                   //Cart::instance('default')->merge(strval(Auth::user()->id), $keepDiscount, $keepTaxrate, $dispatchAdd, 'default'); 
             
              }

            }

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));

      

        
    }// End Method


    public function RemoveMiniCart($rowId){
      
                
        Cart::remove($rowId);

    
        
        return response()->json(['success' => 'Product Removed From Cart']);

    }// End Method


    public function MyCart(){

        return view('frontend.cart.view_mycart');

    }// End Method

    
    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));

    }// End Method

    public function RemoveCart($rowId){
      
                
        Cart::remove($rowId);

    
        
        return response()->json(['success' => 'Product Removed From Cart']);

    }// End Method

    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        
        Cart::update($rowId, $row->qty -1);

        return response()->json(['success' => 'Product QTY Updated']);

    }// End Method

    public function CartIncrement($rowId){

        $row = Cart::get($rowId);
        
        Cart::update($rowId, $row->qty +1);

        return response()->json(['success' => 'Product QTY Updated']);

    }// End Method




    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)
                        ->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

             

        if ($coupon) {
            $sub_total = Cart::total();
            $discount_amount =  round(Cart::total() * ($coupon->coupon_discount/100)); 
            $total_amount   =   round(Cart::total() - $discount_amount) ; 

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => $discount_amount , 
                'sub_total' => $sub_total,
                'total_amount' => $total_amount
            ]);

            return response()->json(
                array(
                'coupon' => $coupon,
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => $discount_amount , 
                'sub_total' => $sub_total,
                'total_amount' => $total_amount,
                'validity' => true,                
                'success' => 'Coupon Applied Successfully'

            ));


        } else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    }// End Method



    public function CouponreApply(Request $request){

       // $coupon = Coupon::where('coupon_name',$request->coupon_name)
       //                 ->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

             

        if (Session::has('coupon')) {

            $coupon = Coupon::where('coupon_name',Session('coupon')['coupon_name'])
                       ->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            
            $sub_total = Cart::total();
            $discount_amount =  round(Cart::total() * ($coupon->coupon_discount/100)); 
            $total_amount   =   round(Cart::total() - $discount_amount) ; 

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => $discount_amount , 
                'sub_total' => $sub_total,
                'total_amount' => $total_amount
            ]);

            return response()->json(
                array(
                'coupon' => $coupon,
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => $discount_amount , 
                'sub_total' => $sub_total,
                'total_amount' => $total_amount,
                'validity' => true,                
                'success' => 'Coupon Applied Successfully'

            ));


        } else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    }// End Method


}
