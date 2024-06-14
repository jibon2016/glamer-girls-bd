  <!-- Start Footer Area  -->
@php
use App\Models\Information;
$info = Information::first();

@endphp

<style>
  .footer-area {
    background: rgb(17 24 39);
  }
  .footer-main {
    border-bottom: 1px solid #ffffff;
  }

  .footer-main {
      border-radius: 100px 100px 0px 0px;
      padding: 30px 0 50px;
  }
  .footer-main .widget-logo {
    display: inline-block;
    margin-bottom: 11px;
   }
   .footer-alt-logo-name {
    background: #ffffff;
    color: #dc3545;
  }

  .footer-alt-logo-name {
      padding: 7px 7px;
      border-radius: 3px;
      font-size: 22px;
  }
  .widget-about h1{
    margin-bottom: 10px !important;
  }
  .footer-main .desc {
    color: #ffffff;
  }
  .footer-main .desc {
      font-size: 14px;
      line-height: 25px;
      margin-bottom: 0px;
      max-width: 250px;
      font-weight: 500;
  }
  .footer-main .widget-title {
    color: #ffffff;
}

.footer-main .widget-title {
    font-size: 18px;
    margin-bottom: 19px;
    padding-bottom: 10px;
    position: relative;
    font-weight: 500;
    margin-top: 12px;
}
.footer-main .widget-title:after {
    background-color: #ffffff;
}

.footer-main .widget-title:after {
    bottom: 0;
    content: "";
    height: 2px;
    left: 0;
    position: absolute;
    width: 46px;
}
.footer-main .widget-nav li {
    font-size: 14px;
    font-weight: 500;
    position: relative;
    transition: all 0.5s ease 0s;
    margin-bottom: 0px;
    font-weight: 500;
}
.footer-main .widget-nav li a {
    color: #ffffff;
}
.footer-bottom-content {
    align-items: center;
    justify-content: space-between;
    text-align: center;
    padding: 10px 0 10px;
}
.footer-bottom-content p {
    color: #ffffff;
}
.footer-bottom-content p {
    font-size: 14px;
}
p:last-child {
    margin-bottom: 0;
}
.widget-item ul{
  padding-left: 0px !important;
  padding-top: 20px;
}
.widget-item ul li{
  margin-top: 0px !important;
}
.copyright a {
  color: #fff;
}
</style>

<footer class="footer-area">
  <div class="footer-main">
    <div class="container">
      <div class="row mb-n6">
        <div class="col-sm-12 col-md-4 col-lg-3">
          <div class="widget-item">
            <div class="widget-about">
              <a class="widget-logo" href="{{ URL::to('/') }}" style="width:120px;background: #fff;">										
                <img src="{{ asset('uploads/img/'.$info->site_logo)}}" alt="Site Logo">
              </a>
              <p class="desc"><i class="fa fa-phone"></i> কল করুনঃ {{$info->owner_phone }}</p>
              <p class="desc"><i class="fa fa-map-marker"></i> ঠিকানাঃ {{$info->address }}</p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-2 offset-lg-1">
          <div class="widget-item">
            <h4 class="widget-title">কোম্পানি</h4>								
            <ul class="widget-nav">										
              <li><a href="#">আমাদের সম্পর্কে</a></li>
              <li><a href="#">টার্মস এন্ড কন্ডিশন</a></li>
              <li><a href="#">যোগাযোগের ঠিকানা</a></li>

            </ul>
          </div>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-2 offset-lg-1 ">
          <div class="widget-item">
            <h4 class="widget-title">ই-কমার্স</h4>								
            <ul class="widget-nav">
              <li><a href="#">সেলস ক্যাম্পেইন</a></li>
              <li><a href="#">ফেভারিট প্রোডাক্ট</a></li>
              <li><a href="#">অর্ডার &amp; রিটার্ন পলিসি</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-2 offset-lg-1 ">
          <div class="widget-item">
            <h4 class="widget-title">কাস্টমার</h4>								
            <ul class="widget-nav">
                
                <li><a href="#">লগইন</a></li>
                <li><a href="#">রেজিস্ট্রেশন</a></li>
                <li><a href="#">অর্ডার ট্র্যাকিং</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container pt-0 pb-0">
      <div class="footer-bottom-content">
        <p class="copyright">Copyright © 2024 All Rights by {{$info->site_name }}.<br>Developed by <i class="fa fa-heart"></i> <a target="_blank" href="#">{{$info->site_name }}</a></p>
      </div>
    </div>
  </div>
</footer>
  
<div class="cart-dropdown" id="cart-dropdown">
    
</div>

    
@include('frontend.partials.js')

</body>

<html>