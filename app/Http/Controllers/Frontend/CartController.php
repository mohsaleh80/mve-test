<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

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
                                 'image' => $product->product_thambnail]
                  ]
                );

               

        return response()->json(['success' => 'Product Added to Your Cart' ]);      

    } // End Add To Cart



    public function AddMiniCart(){

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
}
