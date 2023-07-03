@extends('frontend.master_dashboard')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<main class="main pages mb-80">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Vendors List
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="archive-header-2 text-center">
                <h1 class="display-2 mb-50">Vendors List</h1>
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form method="POST" action="{{route('vendor.search')}}">
                                    @csrf
                                    <input type="text" name="vendor_name" placeholder="Search vendors (by name)..." />
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-50">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We have <strong class="text-brand">{{$vendorsCount}}</strong> vendors now</p>
                        </div>
                        <div class="sort-by-product-area">
                          <!-- Show-->
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <select name="show_flag" class="form-select" id="inputVendor">
                                            <option value="0" @if ($show_flag ==0) selected @endif></option>
                                            <option value="1" @if ($show_flag ==1) selected @endif>1</option>
                                            <option value="2" @if ($show_flag ==2) selected @endif>2</option>
                                            <option value="3" @if ($show_flag ==3) selected @endif>3</option>
                                            <option value="4" @if ($show_flag ==4) selected @endif>4</option>
                                            
                                    </select>
                                    </div>
                                </div>
                                
                            </div>
                          <!-- End Show -->  
                          <!-- Sort-->
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <select name="sort_flag" class="form-select" id="inputVendor">
                                            <option value="0" @if ($sort_flag ==0) selected @endif></option>
                                            <option value="1" @if ($sort_flag ==1) selected @endif>Name : Asc</option>
                                            <option value="2" @if ($sort_flag ==2) selected @endif>Name : DESC</option>
                                            <option value="3" @if ($sort_flag ==3) selected @endif>Join Date</option>
                                    </select>
                                    </div>
                                </div>
                                
                            </div>
                          <!-- End sort   -->  
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
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
                                        <li><img class="mr-5" src="{{asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>{{$vendor->address}}</span></li>
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
                <!--end vendor card-->
                
            </div>
            @if($show_flag == 0)
            {{ $vendors->links() }}
            @endif
            <!-- Pagination
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>   -->
        </div>
    </div>
</main>



<script type="text/javascript">
  		
    $(document).ready(function(){
      $('select[name="sort_flag"]').on('change', function(){
        var sort_flag = $(this).val();
      //alert(sort_flag);
      

       if (sort_flag) {

           
            var url = "{{ route('vendor.sort',':sort_flag') }}";
            url = url.replace(':sort_flag', sort_flag);
            
        
            location.href = url;
        } 
       
      });
    });
  </script>

<script type="text/javascript">
  		
    $(document).ready(function(){
      $('select[name="show_flag"]').on('change', function(){
        var show_flag = $(this).val();
      //alert(show_flag);
      

       if (show_flag) {

           
            var url = "{{ route('vendor.show',':show_flag') }}";
            url = url.replace(':show_flag', show_flag);
            
        
            location.href = url;
        } 
       
      });
    });
  </script>
  
@endsection