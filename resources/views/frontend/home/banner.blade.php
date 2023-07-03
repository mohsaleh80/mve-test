<section class="banners mb-25">
    <div class="container">
        <div class="row">


            @php
              $banner = App\Models\Banner::orderBy('banner_title','ASC')->limit(3)->get();
            @endphp

            @foreach($banner as $item)
            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{ asset($item->banner_image ) }}" alt="" />
                    <div class="banner-text">
                        <h4> 
                            @php
                            $title  = $item->banner_title;
                                $pieces = explode("-", $title);
                               
                            @endphp
                            {{$pieces[0]}}<br />
                            {{$pieces[1]}}
                        </h4>
                        <a href="{{ $item->banner_url }}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
           <!-- 
            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <img src="{{ asset('frontend/assets/imgs/banner/banner-2.png') }}" alt="" />
                    <div class="banner-text">
                        <h4>
                            Make your Breakfast<br />
                            Healthy and Easy
                        </h4>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-md-none d-lg-flex">
                <div class="banner-img mb-sm-0 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <img src="{{ asset('frontend/assets/imgs/banner/banner-3.png') }}" alt="" />
                    <div class="banner-text">
                        <h4>The best Organic <br />Products Online</h4>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</section>