<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bravo - MultiVendor eCommerce</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <!-- Ajax CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- PWA -->
    <link rel="manifest" href="{{ asset('pwa/manifest.json') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="PWAGram">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-57x57.png') }}" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-60x60.png') }}" sizes="60x60">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-72x72.png') }}" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-76x76.png') }}" sizes="76x76">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-114x114.png') }}" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-120x120.png') }}" sizes="120x120">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-144x144.png') }}" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-152x152.png') }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-180x180.png') }}" sizes="180x180">
    <meta name="msapplication-TileImage" content="{{ asset('pwa/images/icons/app-icon-144x144.png') }}">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#3f51b5">

    <!-- End PWA -->
    <!-- Favicon 
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
	-->
    <!-- Icons -->
    <link href="{{ asset('adminbackend/assets/css/icons.css') }}" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon-bravo.png') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
</head>

<body>
    <!-- Modal -->
 
    <!-- Quick view -->
        @include('frontend.body.quickview_modal')
    <!-- Quick view -->

    <!-- Header  -->
        @include('frontend.body.header')
    <!-- End Header  -->



    







    <!-- Main Start -->
    <main class="main"> 
       @yield('main')
    </main>   
    <!-- Main Start -->





    <!-- Footer Start -->
    @include('frontend.body.footer')
    <!-- Footer End -->

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
    <script src="{{ asset('frontend/assets/s/plugins/jquery.elevatezoom.js') }}j"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

   <!-- Quick View Modal -->
    <script type="text/javascript">
    
    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        /// Start product view with Modal 
     </script>

     <script >                
            /// Start product view with Modal 
            function productQuickView(id){

               // alert(id);

               $.ajax({
                        type: 'GET',
                        url: '/product/view/modal/'+id,
                        dataType: 'json',
                        success:function(data){
                            console.log(data)
                            $('#qvm_pname').text(data.product.product_name);
                            $('#qvm_pid').val(data.product.id);
                            $('#qvm_qty').val(1);

                            if(data.product.discount_price == null){
                                $('#qvm_pprice').text("");
                                $('#qvm_oldprice').text("");
                                $('#qvm_pdiscount').text("");
                                $('#qvm_pprice').text(data.product.selling_price);

                            }else{
                          
						        amount = parseInt(data.product.selling_price) - parseInt(data.product.discount_price);
						        discount = (amount/parseInt(data.product.selling_price)) * 100;
						
                                $('#qvm_pprice').text("");
                                $('#qvm_oldprice').text("");
                                $('#qvm_pdiscount').text("");
                                $('#qvm_pprice').text(data.product.discount_price);
                                $('#qvm_oldprice').text(data.product.selling_price);
                                $('#qvm_pdiscount').text(Math.round(discount)+"%");
                            }

                            $('#qvm_pbrand').text(data.product.brand.brand_name);
                            $('#qvm_pcategory').text(data.product.category.category_name);
                            $('#qvm_pcode').text(data.product.product_code);
                            $('#qvm_psub').text(data.product.subcategory.subcategory_name);

                            //Image
                            $('#qvm_pimage').attr('src',"/"+data.product.product_thambnail);
                           
                        
                            $('#qvthumbnail').empty();
                            
                            imagesHTML =`<div class='slider-nav-thumbnails' >`;
                             // add thmumbnail image
                             imagesHTML+=`<div style="display: inline-block; margin-right:10px;"><img src="/`+data.product.product_thambnail+`" style="width:80px;height:100px;" onmouseover="replaceMainImgModal(this.src)" alt="product image" /></div>`;   
                             //Show only 3 images 
                            y = data.multiImage.length;
                            if (y > 3) {y =3;}      
                            for (let i = 0; i < y ; i++) {
                                
                                imagesHTML+=`<div style="display: inline-block; margin-right:10px;"><img src="/`+data.multiImage[i].photo_name+`" style="width:80px;height:100px;" onmouseover="replaceMainImgModal(this.src)" alt="product image" /></div>`;
                                    }
                            
                            imagesHTML+=`</div>`
                            $('#qvthumbnail').html(imagesHTML);
                            

                            // Size 
                            
                            if(data.size.length == 0){
                                $('#qvm_sizeArea').hide();
                            }else{
                                $('#qvm_size').empty();
                                $('#qvm_size').append('<option value="" selected="" disabled="">--Choose Size--</option>');
                                for (let i = 0; i < data.size.length; i++) {
                                    $('#qvm_size').append('<option value="'+data.size[i]+'">'+data.size[i]+'</option>');
                                }

                            }

                            //Color 
                            if(data.color.length == 0){
                                $('#qvm_colorArea').hide();
                            }else{
                                $('#qvm_color').empty();
                                $('#qvm_color').append('<option value="" selected="" disabled="">--Choose Color--</option>');
                                for (let i = 0; i < data.color.length; i++) {
                                    $('#qvm_color').append('<option value="'+data.color[i]+'">'+data.color[i]+'</option>');
                                }

                            }

                            // Upper Label 
                           if(data.product.product_qty == 0){
                            
                            $('#qvmin-stock').hide();
                            $('#qvmout-stock').show();

                           }else{
                            $('#qvmout-stock').hide();
                            $('#qvmin-stock').show();
                           
                           }
                                                                
                           
                        }
                     })


                }// end Method
     </script>

     <script>
       
        function addToCartModal(){
           
        var product_name = $('#qvm_pname').text();  
        var id = $('#qvm_pid').val();
        var color = $('#qvm_color option:selected').val();
        var size = $('#qvm_size option:selected').val();
        var quantity = $('#qvm_qty').val(); 

       //alert(size);
        //console.log(quantity)

       $.ajax({
            type: "POST",
            dataType : "json",
            data:{
                color:color, size:size, quantity:quantity,product_name:product_name
            },
            url: "/cart/data/store/"+id,
            success:function(response){
                //close Modal
                $('#qvm_closeModal').click();
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
                     $('#qvm_closeModal').click();
                    // console.log(error);
                    if(error.status == 401){
                          
                          Swal.fire({
                                  toast: true,
                                  position: 'top-end',
                                  icon: 'error',
                                  title: 'Please Login First!',
                                  showConfirmButton: false,
                                  timer: 4000,
                                  showClass: {
                                                  popup: 'animate__animated animate__fadeInDown'
                                              },
                                  hideClass: {
                                                  popup: 'animate__animated animate__fadeOutUp'
                                              }
                                  });
                                  setTimeout(function(){
                                      var url = "{{ route('login') }}";
                                      location.href = url; 
                                  },3000);
                                 
      
                       }else{
                          
                          Swal.fire({
                                  toast: true,
                                  position: 'top-end',
                                  icon: 'error',
                                  title: 'Product can not be added!',
                                  showConfirmButton: false,
                                  timer: 4000,
                                  showClass: {
                                                  popup: 'animate__animated animate__fadeInDown'
                                              },
                                  hideClass: {
                                                  popup: 'animate__animated animate__fadeOutUp'
                                              }
                                  });
                          
      
                       }
                            }
       });


       }// end Add to Cart Modal


     </script>

<script>
       
    function addToCartDetails(id){
       

    var product_name = $('#details_pname').text();     
    var id = id;
    var color = $('#details_color option:selected').val();
    var size = $('#details_size option:selected').val();
    var quantity = $('#detailsQuanitity').val();
     

   //alert(id);
    //console.log(quantity)

   $.ajax({
        type: "POST",
        dataType : "json",
        data:{
            color:color, size:size, quantity:quantity,product_name:product_name
        },
        url: "/cart/data/store/"+id,
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
            
                // console.log(error.status);
                 if(error.status == 401){
                          
                    Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Please Login First!',
                            showConfirmButton: false,
                            timer: 4000,
                            showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                            hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                            });
                    setTimeout(function(){
                                            var url = "{{ route('login') }}";
                                            location.href = url; 
                                        },3000);
                           

                 }else{
                    
                    Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Product can not be added!',
                            showConfirmButton: false,
                            timer: 4000,
                            showClass: {
                                            popup: 'animate__animated animate__fadeInDown'
                                        },
                            hideClass: {
                                            popup: 'animate__animated animate__fadeOutUp'
                                        }
                            });
                    

                 }
                 

                           
                        }
                        
   });


   }// end Add to Cart Details

   


 </script>

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


<!--  /// Start Wishlist Add -->
<script type="text/javascript">
        
    function addToWishList(product_id){
        //alert(product_id);

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/"+product_id,
            success:function(data){
                wishlistCount();
                 // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end', 
                        showConfirmButton: false,
                        timer: 3000 
                    })
                    if ($.isEmptyObject(data.error)) {
                            
                            Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success, 
                            })
                    }else{
                    
                        Toast.fire({
                                    type: 'error',
                                    icon: 'error',
                                    title: data.error, 
                                    })
                        }
                    // End Message  
            }
        })
    }
</script>
<!--  /// End Wishlist Add -->

<!--  /// Start Load Wishlist Data -->
<script type="text/javascript">
        
    function wishlistCount(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-count/",
            success:function(response){

               // alert(response.wishQty);
                $('#userWishListCount').text(response.wishQty); 

            }
        })
    }

    wishlistCount();
</script>

<!--  /// End Load Wishlist Count -->

    <!--  /// Start Wishlist Remove -->
<script type="text/javascript">
        
    function wishListRemove(id){
       
        //alert(id);
        $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/"+id,
                success:function(data){
                wishlistAfterRemove();
                wishlistCount();
                     // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    icon: 'success', 
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    icon: 'error', 
                    title: data.error, 
                    })
                }
              // End Message  
                }
            })
        

    }
 // Wishlist Remove End
    
</script>

<!--  /// Start Load Wishlist Data -->
<script type="text/javascript">
        
    function wishlistAfterRemove(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-product/",
            success:function(response){

                var rows = ""
                   $.each(response.wishlist, function(key,value){

                   rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30">
                            
                        </td>
                        <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thambnail}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="/product/details/${value.product.id}/${value.product.product_slug}" target="_blank">
                                ${value.product.product_name} </a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                        ${value.product.discount_price == null
                        ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                        :`<h3 class="text-brand">$${value.product.discount_price}</h3>`
                        }
                            
                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${value.product.product_qty > 0 
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :`<span class="stock-status out-stock mb-0"> Out Stock  </span>`
                            } 
                           
                        </td>
                        <td class="text-right" data-title="Cart">
                            ${value.product.product_qty > 0 
                                ? `<button class="btn btn-sm">Add to cart</button>`
                                :`<button class="btn btn-sm btn-secondary">Contact Us</button>`
                                        
                            }
                                        
                        </td>
                       
                        <td class="action text-center" data-title="Remove">
                            <a  type="submit" id="${value.id}" onclick="wishListRemove(this.id)" class="text-body"><i class="fi-rs-trash"></i></a>
                        </td>
                    </tr> ` 
       });

       $('#wishlistProducts').html(rows);
       $('#ajaxWishListCount').html(`There are ${response.wishQty} products in this list`);

            }
        })
    }
</script>


</body>

<!-- PWA -->
<script>
    if (window.matchMedia('(display-mode: standalone)').matches) { 
      // if webapp installed, remove 'target' attribute of links
      document.querySelectorAll('a[target=_blank]').forEach(function(a) {
         a.removeAttribute('target');
      });
    }
    </script>
    <!-- End PWA -->

</html>