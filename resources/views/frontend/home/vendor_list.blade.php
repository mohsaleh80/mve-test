<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
                    <h3 class="">All Our Vendor List </h3>
                    <a class="show-all" href="{{route('vendor.all')}}" target="_blank">
                        All Vendors
                        <i class="fi-rs-angle-right"></i>
                    </a>
    </div>

 @php
$vendors = App\Models\User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->limit(4)->get();
@endphp

        <div class="row vendor-grid">
            @foreach($vendors as $vendor)
                    <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center" >
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="{{route('vendor.details',$vendor->id)}}" target="_blank">
                                        <img class="default-img" src="{{ asset($vendor->photo) }}" alt="" style="height:150px;"/>
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Mall</span>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                                        <div class="product-category">
                                            <span class="text-muted">Since <span class="text-brand">{{ $vendor->created_at->format("Y") }}</span></span>
                                        </div>
                                        <h4 class="mb-5"><a href="{{route('vendor.details',$vendor->id)}}" target="_blank">{{ $vendor->name }}</a></h4>
                                        <div class="product-rate-cover">
                     @php
                          $products = App\Models\Product::where('vendor_id',$vendor->id)->get();
                          
                     @endphp
                                        <span class="font-small total-product">{{count($products)}} products</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /> <strong>Email:</strong><span>{{$vendor->email}}</span></li>
                                    </ul>
                                </div>
                                <a href="{{ $vendor->website }}" class="btn btn-xs" target="_blank">Visit Store <i class="fi-rs-arrow-small-right"></i></a>
                                
                            </div>
                        </div>
                    </div>
                    <!--end vendor card-->
                    
             @endforeach   
        </div> 
</div>