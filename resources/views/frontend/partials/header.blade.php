@php
use App\Models\Information;
use App\Models\Category;
$information = Information::first();
$categories = Category::where('parent_id', null)->get();
@endphp
<style>
    .header-action>ul>li>a:hover{
        color: #000;
    }
    .header-action .shopping-cart .cart-dropdown-btn .cart-count{
        background: transparent !important;
        color: #000;
        border: 1px solid #000;
    }
        .axil-product>.thumbnail>a{
            border-radius: 0px;
        }
        .axil-product>.thumbnail>a img{
            border-radius: 0px;
        }
        .axil-product{
            border: none;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }
        .axil-product .cart-action li.select-option button{
            width: 95%;
            border-radius: 4px;
        }
        hr{
            display: none;
        }
        body.open .closeMask{
            z-index: 0;
        }
        .popular_product {
            align-items: center;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
            position: relative;
            width: 100%;
            margin-top: 5%;
            margin-bottom: 2%;
            color: #014F00;
        }

        .popular_product b {
            background-color: currentColor;
            display: block;
            flex: 1;
            height: 2px;
            opacity: .1;
        }

        .popular_product span {
            font-size: 24px;
            font-family: 'Hind Siliguri', sans-serif;
            margin-bottom: 0px;
            color: #dc3545;
            font-weight: 800;
        }

        .slide-arrow {
            position: absolute !important;
            z-index: 9999 !important;
            top: 50% !important;
            width: 50px !important;
        }
        .slick-arrow i {
            font-size: 20px;
            color: black;
        }

        .slick-slider .prev-arrow {
            left: 20px !important;
        }

        .slick-slider .next-arrow {
            right: 20px !important;
        }

        @media only screen and (min-width: 320px) and (max-width: 375px) {
            .cat-image {
                height: 90px !important;
                width: 90px !important;
            }
            .cat-image a {
                padding: 0px !important;
                font-size: 80% !important;
            }
            .slider_cat {
                padding-left: 5px !important;
                padding-right: 5px !important;
            }
        }
        @media only screen and (min-width: 320px) and (max-width: 767px) {
            .mainmenu p{
                display: block;
                text-transform: capitalize;
                color: #505050;
                padding: 7px 20px 7px 20px;
                position: relative;
                font-size: 16px;
                transition: all 0.3s ease-in-out;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                border-bottom: 1px dashed #eee;
                font-weight: 500;
            }
        }
        


        @media only screen and (min-width: 376px) and (max-width: 470px) {
            .cat-image {
                height: 103px !important;
                width: 103px !important;
            }
            .cat-image a {
                padding: 0px !important;
                font-size: 80% !important;
            }
            .slider_cat {
                padding-left: 5px !important;
                padding-right: 5px !important;
            }
        }

        @media only screen and (min-width: 1000px) and (max-width: 1101px) {
            .cat-image {
                height: 90px !important;
                width: 90px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }
        
        @media only screen and (min-width: 1102px) and (max-width: 1200px) {
            .cat-image {
                height: 100px !important;
                width: 100px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }
        
        @media only screen and (min-width: 1201px) and (max-width: 1300px) {
            .cat-image {
                height: 112px !important;
                width: 112px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }
        
        @media only screen and (min-width: 1301px) and (max-width: 1400px) {
            .cat-image {
                height: 122px !important;
                width: 122px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }
        
        @media only screen and (min-width: 1401px) and (max-width: 1500px) {
            .cat-image {
                height: 131px !important;
                width: 131px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }
        
        @media only screen and (min-width: 1501px) and (max-width: 1600px) {
            .cat-image {
                height: 142px !important;
                width: 142px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }
        
        @media only screen and (min-width: 1601px) and (max-width: 2700px) {
            .cat-image {
                height: 145px !important;
                width: 145px !important;
            }
            .cat-image a {
                padding: 0px !important;
            }
            .cat-image .title_cat{
                font-size: 80% !important;
            }
        }

        @media only screen and (max-width: 768px) {
            .cat-image img{
                display: block !important;
            }
        }

        @media only screen and (min-width: 768px) {
            .row>[class*=col] {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }
        
        @media only screen and (max-width: 767px) {
            .row>[class*=col] {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }

        .view_all a {
            margin-right: 10% !important;
        }

        .view_left a > h4 {
            margin-top: 3px !important;
        }
        .cat-image {
            height: 128px;
            width: 128px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            padding: 2px;
            background: #ffe8c5;
            transition: 0.3s;
            margin-bottom: 10px;
        }

    .mainmenu .img-fluid {
        width: 50px;
        height: 50px !important;
        border-radius: 10px;
        transition: .5s ease-in-out !important;
        border: none !important;
    }

    .cat-image:hover {
        color: white;
        background: #dc3545;
    }

    .cat-image:hover a {
        color: white;
    }

    .cat-image a {
        padding: 6px;
        font-weight: 700;
    }

    .carousel-inner {
        box-shadow: 1px 1px 10px 0px #dc3545 !important;
        border-radius: 7px;
    }

    @media (max-width: 380px){

    .header_navbar .mainmenu-nav {
        padding: 0px;
    }
    }

    @media (max-width: 992px) {
        .header_navbar .mainmenu-nav {
            display: block;
            position: static;
            top: 0;
            bottom: 0;
            width: 100%;
            /* background-color: var(--color-white); */
            z-index: 100;
            transition: all .3s ease-in-out;
            padding: 20px 30px 10px;
            visibility: visible;
            opacity: 1;
            gap: 10px;
        }
    }

    @media only screen and (max-width: 767px) {
        .header-main-nav .mainmenu-nav {
            right: none;
            left: -250px;
            padding: 0px;
        }
    }

    @media (max-width: 992px) {
        .header_navbar .mainmenu-nav .mainmenu {
            gap: 10px;
        }
    }


    @media (max-width: 992px) {
        .header_navbar .mainmenu-nav .mainmenu {
            display: flex;
            height: 100%;
            overflow-y: hidden;
            margin: 0;
        }  
    }

    @media only screen and (max-width: 767px) {
        .header-main-nav .mainmenu-nav .mainmenu {
            padding: 10px;
            padding-top: 0;
            padding-bottom: 20px;
        }
    }

    @media (max-width: 575px) {
        .header_navbar .mainmenu-nav .mainmenu>li {
            width: 30%;
        }
    }


    @media (max-width: 992px) {
        .header_navbar .mainmenu-nav .mainmenu>li {
            margin: 0px 0 !important;
            transform: translateY(20px);
            opacity: 1;
            transition: all .3s ease-in-out;
            padding-top: 0;
        }
    }
    .mobile-close-btn {
        background-color: rgba(0, 0, 0, 0);
        position: absolute;
        top: 4px;
        right: 15px;
        height: 35px;
        width: 35px;
        border-radius: 38px;
        color: #fff;
        font-size: 20px;
    }

    
</style>
<header class="desktop header axil-header header-style-5">
    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu" style="background: #fff;max-width: 1600px;margin: 0 auto;">
        <div class="container-fluid" style="padding-top: 10px;">
            <div class="row header-navbar">
                <div class="col-3 d-flex">
                    <div class="header-brand" style="margin-left: 4%;">
                        <a href="{{ URL::to('/') }}" class="logo logo-dark">
                            <img src="{{ asset('uploads/img/'.$information->site_logo)}}" alt="Site Logo">
                        </a>
                        <a href="{{ URL::to('/') }}" class="logo logo-light">
                            <img src="{{ asset('uploads/img/'.$information->site_logo)}}" alt="Site Logo">
                        </a>
                    </div>
                </div>
                <div class="col-5">
                    <form action="{{ route('front.products.index')}}">
                        <div class="mobilesearch col-12">
                            <div class="header-top-dropdown dropdown-box-style">
                                <div class="axil-search">
                                    <button type="submit" class="icon wooc-btn-search">
                                        <i class="far fa-search"></i>
                                    </button>
                                    <input type="search" class="placeholder product-search-input" name="q" id="search2" value="{{ request('q') ??''}}" maxlength="128" placeholder="What are you looking for...." autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
                @php
                    $cats=\App\Models\Category::whereNull('parent_id')->with('subcats')->get();
                @endphp
                <div class="more-dp col-3" style="text-align: center;">
                    <div class=" more-btn" style="font-family: 'Hind Siliguri', sans-serif">সমস্ত ক্যাটাগরি <i class="fas fa-angle-down"></i>
                    </div>
                        <ul class="mainmenu">
                            @foreach($cats as $cat)   
                                <li class="menu-item-has-children">
                                    <a href="{{ route('front.products.index')}}?category_id={{ $cat->id}}">
                                        {{ $cat->name }} @if($cat->subcats->count() > 0)<i style="margin-left: 20px;" class="fas fa-angle-down"></i> @endif                                        
                                    </a>
                                    @if($cat->subcats->count())
                                        <ul class="axil-submenu">
                                            @foreach($cat->subcats as $sub)
                                                 <li><a href="{{ route('front.products.index')}}?category_id={{ $cat->id}}&sub_category_id={{ $sub->id}}">{{ $sub->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul> 
                </div>
                <div class="col-1">
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="shopping-cart">
                                <a href="{{ route('front.carts.index')}}?segment={{request()->segment(1)}}"
                                style="font-family: 'Hind Siliguri', sans-serif;"
                                class="cart-dropdown-btn search_icon">
                                    <span class="cart-count" style="font-family: 'Hind Siliguri', sans-serif">{{ getTotalCart()}}</span>
                                    Cart <i class="flaticon-shopping-cart"></i> 
                                </a>                          
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="desktopnav container-fluid" style="border-bottom: 1px solid #f2f2f2;background-color:#ededef">
                  
        </div>
        
        
    </div>
    <!-- End Mainmenu Area -->
</header>
  <!-- Start Header -->
  <header class="mobile header axil-header header-style-5">
    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <ul class="mainmenu">
                        <li class="axil-mobile-toggle">
                            <button class="menu-btn mobile-nav-toggler">
                                <i class="flaticon-menu-2"></i>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-4 brand_img">
                    <div class="header-brand">
                        <a href="{{ URL::to('/') }}" class="logo logo-dark">
                            <img src="{{ asset('uploads/img/'.$information->site_logo)}}" alt="Site Logo">
                        </a>                      
                        <a href="{{ URL::to('/') }}" class="logo logo-light">
                            <img src="{{ asset('uploads/img/'.$information->site_logo)}}" alt="Site Logo">
                        </a>
                    </div>
                    
                </div>
                <div class="col-6 header_action">
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="shopping-cart">
                                <a  class="search_icon" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size: 20px;">
                                    <i class="far fa-search"></i> 
                                </a>
                            </li>
                            <li class="shopping-cart">
                                
                                <a href="{{ route('front.carts.index')}}?segment={{request()->segment(1)}}"
                                    style="font-family: 'Hind Siliguri', sans-serif;"
                                    class="cart-dropdown-btn search_icon">
                                        <span class="cart-count" style="background: #fff !important;font-family: 'Hind Siliguri', sans-serif">{{ getTotalCart()}}</span>
                                         <i class="flaticon-shopping-cart"></i> 
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="header-navbar">
                
                <div class="header-main-nav">
                    <!-- Start Mainmanu Nav -->
                    <nav class="mainmenu-nav">
                        <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                        <div class="mobile-nav-brand">
                            <ul class="action-list">
                                <a href="#" class="logo">
                                    <p class="text-white">প্রোডাক্ট ক্যাটাগরি</p>
                                </a>
                            </ul>
                        </div>                       
                   
                        <ul class="mainmenu">  
                            @foreach($cats as $cat)   
                                @if ($cat->subcats->count() < 1)
                                    <p>                        
                                        <a href="{{ route('front.products.index')}}?category_id={{ $cat->id}}" >
                                        {{ $cat->name}}
                                        </a>
                                    </p>
                                @else
                                    <p>                        
                                        <a class="" data-bs-toggle="collapse" id="dropdownMenuButton1" href="{{ route('front.subCategories',[$cat->url])}}#collapseExample_{{$cat->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        {{ $cat->name}}
                                        @if($cat->subcats->count() > 0)
                                        <i class="fas fa-angle-down" style="float:right;font-size: 22px;font-weight: 500;color: #457B9D;"></i>
                                        @endif
                                        </a>
                                    </p>
                                @endif
                                <div class="collapse" id="collapseExample_{{$cat->id}}">
                                    @if($cat->subcats->count())
                                    <ul style="margin:0; padding:0">
                                        @foreach($cat->subcats as $sub)
                                            <li style="margin:0; padding:0;border-bottom: 1px dashed #eee;">
                                                <a  class="dropdown-item" style="font-size: 15px;margin-left: 25px;" href="{{ route('front.products.index')}}?category_id={{ $cat->id}}&sub_category_id={{ $sub->id}}">{{ $sub->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>  
                                    @endif								
                                </div>  
                            @endforeach            
                        </ul>
                    </nav>
                    <!-- End Mainmanu Nav -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
    <div class="collapse" id="collapseExample">
    <form action="{{ route('front.products.index')}}">
        <div class="mobilesearch col-12">
            <div class="header-top-dropdown dropdown-box-style">
                <div class="axil-search">
                    <button type="submit" class="icon wooc-btn-search">
                        <i class="far fa-search"></i>
                    </button>
                    <input type="search" class="placeholder product-search-input" name="q" id="search2" value="{{ request('q') ??''}}" maxlength="128" placeholder="What are you looking for...." autocomplete="off">
                </div>
            </div>
        </div>
    </form>
</div>
</header>