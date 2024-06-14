@extends('frontend.app')
@section('content')
    
<main class="main-wrapper"> 

<!-- Start Desktop Slider Area -->
<div class="desktop-slide slider axil-main-slider-area main-slider-style-2" style="margin-top: 15px;">
    <div class="container-fluid" style="margin-top: 15px;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($sliders as $key=>$s)
                <div class="carousel-item  {{ $key==0 ?'active':''}}">
                  	<a href="{{$s->link}}">
                    	<img src="{{ getImage('sliders', $s->image) }}" class="d-block w-100" alt="..." />
                  	</a>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<!-- End Slider Area -->

<!-- Start Mobile Slider Area -->
<div class="mobile-slide slider axil-main-slider-area main-slider-style-2" style="padding-top: 18px;">
    <div class="container-fluid">
        <div id="McarouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($sliders as $key=>$s)
                <div class="carousel-item  {{ $key==0 ?'active':''}}">
                  	<a href="{{$s->link}}">
                  		<img src="{{ getImage('sliders', $s->mobile_image) }}" style="display:none" class="d-block w-100" alt="..." />
                    </a>
                </div>
                @endforeach
            </div>            
        </div>
    </div>
</div>
<!-- End Slider Area -->
<div class="desktop home-menu mt-0">
    <div class="container-fluid mb-4 my-lg-5 slider_cat">
        <div class="header-navbar header_navbar">
            <div class="header-main-nav">
                <div class="popular_product">   
                    <b></b>    
                    <span>জনপ্রিয় ক্যাটাগরি</span>    
                    <b></b>    
                </div>
                <!-- Start Mainmanu Nav -->
                <nav class="mainmenu-nav">
                    <ul class="mainmenu">   
                        @if (!empty($cats))
                            @foreach ($cats as $popularCat)
                                <li class="menu-item-has-children">
                                    <div class="border border-muted cat-image">
                                        <a href="{{ route('front.products.index')}}?category_id={{ $popularCat->id}}&sub_category_id=">
                                        <img class="img-fluid" src="{{ getImage('categories', $popularCat->image)}}" alt="{{ $popularCat->name}}">
                                        </a>
                                        <a class="title_cat" href="{{ route('front.products.index')}}?category_id={{ $popularCat->id}}&sub_category_id=" style="font-family: 'Hind Siliguri', sans-serif">{{ $popularCat->name }}</a>
                                    </div>
                                </li>
                            @endforeach 
                        @endif
                    </ul>
                </nav>
                <!-- End Mainmanu Nav -->
            </div>
        </div>
    </div>
</div>


    <div class="container-fluid" style="margin-bottom: 20px;padding-left: 5px;padding-right: 5px;">
        <div class="bg-gradient container-fluid" style="background: #dc3545 !important;border-radius:5px;">
            <div class="col-12 product-header">
                <div class="section_title text-light">
                    <div class="row">
                        <div class="col-md-12 col-12 view_left">
                            <a href="#" style="color: #218A41;"> 
                                <h4 class="p-1 m-0 prodCatcus" style="text-align:left;color: #ffffff;padding-left: 22px !important;font-family: 'Hind Siliguri', sans-serif">
                                    <span style="width: auto;">প্রয়োজনীয় প্রোডাক্ট</span>
                                </h4> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Category Area  -->
    <div class="mobile-gap-trending"></div>
        <div class="container-fluid">    
            <div class="slick-single-layout" >
                <div class="row row--15">
                    @foreach($products as $product)
                    <div class="col-lg-2 col-md-3 col-6 mb--30">
                        @include('frontend.products.partials.product_section')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

<!-- End Expolre Product Area  -->
</main>

@endsection

@push('js')

<script type="text/javascript">

    $(document).ready(function(){
        getTrending();
        function getTrending(){
            let url='{{ route("front.trendingProduct")}}';
            $.ajax({
                url: url,
                method: 'GET',
                data:{},
                dataType :"JSON",
                success: function (res) {
                    if (res.success) {
                        $('div#trending_data').html(res.html);
                    }
                   
                }
            });
        }
    });
</script>
@endpush