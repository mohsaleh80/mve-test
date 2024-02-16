@extends('frontend.master_dashboard')
@section('main')

<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Wishlist  
                </div>
            </div>
        </div>
        <div class="container mb-30 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="mb-50">
                        <h1 class="heading-2 mb-10">Your Wishlist</h1>
                        <h6 class="text-body" id="ajaxWishListCount">There are {{$wishQty}} products in this list</h6>
                    </div>
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">

                                    </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="wishlistProducts">
                                @foreach($wishlist as $wish)
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">

                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="{{asset($wish['product']['product_thambnail'])}}" alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="{{'/product/details/'.$wish['product']['id'].'/'.$wish['product']['product_slug']}}" target="_blank">
                                            {{$wish['product']['product_name']}}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        @if($wish['product']['discount_price'] == null)
                                            <h3 class="text-brand">{{$wish['product']['selling_price']}}</h3>
                                        @else
                                           <h3 class="text-brand">{{$wish['product']['discount_price']}}</h3>
                                        @endif
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        @if($wish['product']['product_qty'] > 0)
                                        <span class="stock-status in-stock mb-0"> In Stock </span>
                                        @else
                                        <span class="stock-status out-stock mb-0"> Out Stock </span>
                                        @endif
                                        
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        @if($wish['product']['product_qty'] > 0)
                                        <!--<button class="btn btn-sm">Add to cart</button>-->
                                        <a aria-label="Quick view"  data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$wish['product']['id']}}" onclick="productQuickView(this.id)" class="btn btn-sm  hover-up" ><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                        @else
                                        <button class="btn btn-sm btn-secondary">Contact Us</button>
                                        @endif
                                        
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a type="submit" id="{{$wish->id}}" onclick="wishListRemove(this.id)" class="text-body"><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                <!--
                                <tr>
                                    <td class="custome-checkbox pl-30">
                                        
                                    </td>
                                    <td class="image product-thumbnail"><img src="assets/imgs/shop/product-4-1.jpg" alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="shop-product-right.html">Angie’s Boomchickapop Sweet & Salty </a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h3 class="text-brand">$3.21</h3>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <span class="stock-status out-stock mb-0"> Out Stock </span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <button class="btn btn-sm btn-secondary">Contact Us</button>
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a href="#" class="text-body"><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>
                                -->


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



@endsection