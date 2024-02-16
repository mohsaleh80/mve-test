@extends('frontend.master_dashboard')
@section('main')

<main class="main">
 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h4 class="heading-2 mb-10">Your Cart</h4>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are products in your cart</h6>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">

                                    </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="cartPage">



                            </tbody>
                        </table>
                    </div>


                    <div class="row mt-50">

                        <div class="col-lg-5">
                          
                            @if(Session::has('coupon'))

                          {{-- Coupon  {{ Session('coupon')['coupon_name'] }} Applied --}} 
                            
                            @else

                            <div class="p-40" id="couponApply">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">HAPPYLEARNING Promo Code</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                    <input class="font-medium mr-15 coupon" id="coupon_name" placeholder="Enter Your Coupon">
                                    <a  onclick="applyCoupon()" class="btn btn-success" ><i class="fi-rs-label mr-10"></i>Apply</a>
                                    </div>
                                    
                                     
                                </form>
                                
                            </div>
                            <!--
                            <div id="CouponMsg" style="display:none">
                                       <br/>
                                       <p style="color:#ff0000;" id="CouponMsgContent"> </p> 
                            </div>
                            -->
                            @endif
                           
                        </div>


                        <div class="col-lg-7">
                             <div class="divider-2 mb-30"></div>



                            <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end" id="cartTotalCalc"></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>

                                    
                                     <tr>
                                        <td class="cart_total_label" >
                                            <h6 class="text-muted" >Coupon Name</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end" id="CouponMsgContent">
                                            @if(Session::has('coupon'))
                                             {{ Session('coupon')['coupon_name']}}
                                            @else
                                            
                                            @endif
                                        </h4</td> </tr> 

                                        <tr >
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Discount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end" id="couponDiscount">
                                            @if(Session::has('coupon'))
                                            {{ Session('coupon')['coupon_discount']}} %
                                            @else
                                             0 %
                                            @endif
                                           </h4</td> </tr> 
                                           
                                        <tr >
                                        <td class="cart_total_label">
                                            <h6 class="text-muted" >Discount Amount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end" id="couponDiscountAmount">
                                            @if(Session::has('coupon'))
                                            $ {{ Session('coupon')['discount_amount']}}
                                            @else
                                            $ 0
                                            @endif
                                        </h4</td> </tr> <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                        
                                    
                                        
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        
                                        
                                        
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end" id="cartTotalCalcFinal">
                                            
                                            </h4>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>


    </main>

 

@endsection

 