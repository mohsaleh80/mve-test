<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="qvm_closeModal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider" >
                                <img src="" alt="product image" id="qvm_pimage"/>
                                <!--
                                <figure class="border-radius-10">
                                <img src="{{ asset('frontend/assets/imgs/shop/product-16-2.jpg') }}" alt="product image" />
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="{{ asset('frontend/assets/imgs/shop/product-16-1.jpg') }}" alt="product image" />
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="{{ asset('frontend/assets/imgs/shop/product-16-3.jpg') }}" alt="product image" />
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="{{ asset('frontend/assets/imgs/shop/product-16-4.jpg') }}" alt="product image" />
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="{{ asset('frontend/assets/imgs/shop/product-16-5.jpg') }}" alt="product image" />
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="{{ asset('frontend/assets/imgs/shop/product-16-6.jpg') }}" alt="product image" />
                                </figure>
                                <figure class="border-radius-10">
                                    <img src="{{ asset('frontend/assets/imgs/shop/product-16-7.jpg') }}" alt="product image" />
                                </figure>
                            -->
                            </div>
                            <!-- THUMBNAILS  -->
                            <div id="qvthumbnail">
                                <div class="slider-nav-thumbnails" >
                                    
                                    <!--
                                    <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}" alt="product image" /></div>
                                    <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-5.jpg') }}" alt="product image" /></div>
                                    <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-6.jpg') }}" alt="product image" /></div>
                                    <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-7.jpg') }}" alt="product image" /></div>
                                    <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-8.jpg') }}" alt="product image" /></div>
                                    <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-9.jpg') }}" alt="product image" /></div>
                                    -->
                                </div>
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <span class="stock-status out-stock" id="qvmout-stock">Out of Stock</span>
                            <span class="stock-status in-stock" id="qvmin-stock"> Available </span>
                            <h5 class="title-detail"><a href="#" class="text-heading" id="qvm_pname"></a></h5>
                            <!--
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div>
                            -->
                            <div class="attr-detail attr-size mb-30" id="qvm_sizeArea">
                                <strong class="mr-10" style="width:50px;">Size : </strong>
                               
                            
                                <select class="form-control unicase-form-control" id="qvm_size" name="size">
                                    <option selected="" disabled="">--Choose Size--</option> 
                                    <option value="small">S</option>
                                    <option value="medium">M</option>
                                    <option value="large">L</option>
                                    
                                </select>
                            </div>
                            <div class="attr-detail attr-size mb-30" id="qvm_colorArea">
                                <strong class="mr-10" style="width:60px;">Color : </strong>
                               
                            
                                <select class="form-control unicase-form-control" id="qvm_color" name="color">
                                    <option selected="" disabled="">--Choose Color--</option> 
                                    <option value="B">B</option>
                                    <option value="R">R</option>
                                    <option value="G">G</option>
                                    
                                </select>
                            </div>
                            
                            
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="qvm_pprice"></span>
                                    <span>
                                        <span class="save-price font-md color3 ml-15" id="qvm_pdiscount"></span>
                                        <span class="old-price font-md ml-15" id="qvm_oldprice"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                
                                <div class="detail-qty border radius">
                                    <a href="javascript:QVMqtyDown()" class="qty-down" ><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" id="qvm_qty" class="qty-val" value="1" min="1">
                                    <a href="javascript:QVMqtyUp()" class="qty-up" ><i class="fi-rs-angle-small-up" ></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" value="" id="qvm_pid" />
                                    <button type="submit" class="button button-add-to-cart" onclick="addToCartModal()"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Brand: <span class="text-brand" id="qvm_pbrand"></span></li>
                                            <li class="mb-5">Category:<span class="text-brand" id="qvm_pcategory"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">SKU: <span class="text-brand" id="qvm_pcode"></span></li>
                                            <li class="mb-5">SubCategory: <span class="text-brand" id="qvm_psub"></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

function QVMqtyUp(){
       
       var qty = parseInt(document.getElementById("qvm_qty").value);
       qty = qty+1;
       document.getElementById("qvm_qty").value= qty;
       
        
    }

    function QVMqtyDown(){
       
       var qty = parseInt(document.getElementById("qvm_qty").value);
       qty = qty - 1;
       // min value = 1;
       if(qty == 0){ qty = 1;}
       document.getElementById("qvm_qty").value= qty;
       
        
    }
</script>

<script>

          
        
    function replaceMainImgModal(srcImg){

        //alert(srcImg);
        $('#qvm_pimage').attr('src',srcImg);
    }

</script>
