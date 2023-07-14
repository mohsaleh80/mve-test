<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Dashboard - MVE </title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon 
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
	    -->
	    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon-bravo.png') }}" />
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
        <!-- Toaster -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
        <!-- Toaster   -->
    </head>
    
    <body>

        <!-- Header -->
        @include('frontend.body.header')
        <!--End header-->

        <main class="main pages">
        @yield('user')
        </main>



        @include('frontend.body.footer')

        <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>

     <!-- Vendor JS-->
   <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
   <!-- Template  JS -->
   <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
   <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
   <!-- Toaster -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

!--  /// Start Load Wishlist Data -->
<script type="text/javascript">
        
    function wishlistCount(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-count/",
            success:function(response){

                //alert(response.wishQty);
                $('#userWishListCount').text(response.wishQty); 

            }
        })
    }

    wishlistCount();
</script>

<!--  /// End Load Wishlist Count -->


<script type="text/javascript">
    
    function miniCart(){
       $.ajax({
           type: 'GET',
           url: '/product/mini/cart',
           dataType: 'json',
           success:function(response){
               console.log(response)

               var miniCart = "";
               $.each(response.carts, function(key,value){

                miniCart += `<li>
                                 <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image}" /></a>
                                 </div>
                                 <div class="shopping-cart-title" style="margin: -73px 14px 14px 85px; ">
                                    <h4><a href="shop-product-right.html">${value.name}</a></h4>
                                    <h4><span>${value.qty}× </span>$${value.price}</h4>
                                 </div>
                                 <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                    <a type="submit" onclick="miniCartRemove(this.id)" id="${value.rowId}"><i class="fi-rs-cross-small"></i></a>
                                  </div>
                               </li>    
                               <hr>        
                            `;
               });

               $('#miniCartShow').html(miniCart);
               $('#cartQty').text(response.cartQty);
               $('#cartTotal').text("$"+response.cartTotal);
           }
       })
    }

    // call function
    miniCart();
</script>

<script >

  function miniCartRemove(rowId){

       //alert(rowId);
       $.ajax({
        type: 'GET',
        url: '/minicart/product/remove/'+rowId,
        dataType:'json',
        success:function(response){

                //call miniCart
                miniCart();
                //display Sweet Alert Message
                Swal.fire({     
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.success,
                                showConfirmButton: false,
                                timer: 4000,
                                showClass: {
                                                popup: 'animate__animated animate__fadeInDown'
                                            },
                                hideClass: {
                                                popup: 'animate__animated animate__fadeOutUp'
                                            }
                            });
            },
         error: (error) => {
                     
                     Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Product not removed!',
                                showConfirmButton: false,
                                timer: 4000,
                                showClass: {
                                                popup: 'animate__animated animate__fadeInDown'
                                            },
                                hideClass: {
                                                popup: 'animate__animated animate__fadeOutUp'
                                            }
                                });


                          }//end error


    }); //end ajax

  } // removeMiniCart

</script>

    </body>

    </html>    