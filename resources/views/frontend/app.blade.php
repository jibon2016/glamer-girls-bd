<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.head')
<style>
    .axil-product>.thumbnail .label-block .product-badget {
        padding: 6px 18px 5px;
    }
    
    @media only screen and (max-width: 991px) {
        .header-brand a img {
            max-height: 35px;
            width: 142px !important;
        }
        .brand_img {
            width: 60% !important;
        }
        .header_action {
            width: 21% !important;
        }
        .header-brand {
            text-align: center;
        }
    }
    
</style>


<body class="sticky-header" style="max-width: 1600px;margin: 0 auto;border: 1px solid darkgray; box-shadow: 0 0 12px rgb(0 0 0 / 42%);">
    <a href="#top" class="back-to-top" id="backto-top" style="background: #dc3545;"><i class="fal fa-arrow-up"></i></a>
    @include('frontend.partials.header')
    @yield('content')

@include('frontend.partials.footer')