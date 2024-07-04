@extends('frontend.app')
@push('css')

@endpush
@section('content')
@php

use App\Models\Information;
use App\Models\BanglaText;
$info = Information::first();
$bangla_text = BanglaText::first();
$data=getProductInfo($product);
@endphp

<style>
    .product-action-wrapper {
        flex-direction: inherit;
    }
    .product_details{
      min-height: 100%;
    }
    .btn-primary {
        color: #fff;
        background-color: #dc3545;
        border: none;
        border-radius: 3px;
        font-size: 18px;
        font-weight:bold;
    }
    .btn-primary:hover{
      background-color: #dc3545;
    }
    
    .btn-success{
      background: #28a745;
      font-weight: bold;
      font-size: 18px;
    }
    .btn-success:hover{
      background: #28a745;
    }

    .btn{
      padding: 11px 26px 9px;
    }
    .current-price-product{
      color: #dc3545;
      font-size: 18px;
      font-weight: 500;
      line-height: 1;
      margin-bottom: 5px;
    }
    /* .product-action-wrapper .product-action .add-to-cart{
      flex: none;
    } */
    .price-old{
    color: #457B9D;
    font-size: 18px;
    font-weight: 400;
    margin-left: 11px;
    -webkit-text-decoration-line: line-through;
    text-decoration-line: line-through;
    -webkit-text-decoration-color: rgba(69, 123, 157, 0.35);
    text-decoration-color: rgba(69, 123, 157, 0.35);
    }
    @media only screen and (max-width: 767px) {
        .product-small-thumb-3{
          display: none;
        }
  }
   
</style>

<main class="main-wrapper">
    <!-- Start Shop Area  -->
    <div class="axil-single-product-area p pb--0 bg-color-white">
        <div class="single-product-thumb mb--5">
            <div class="container-fluid p-2 mobile_show">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-10 order-lg-2">
                                <div class="single-product-thumbnail-wrap zoom-gallery">
                                    <div class="single-product-thumbnail product-large-thumbnail-3 img-section">
                                        <div class="thumbnail">
                                            <a href="{{ getImage('products', $product->image)}}" class="popup-zoom">
                                                <img src="{{ getImage('products', $product->image)}}" alt="{{ $product->name}} Images">
                                            </a>
                                        </div>

                                        @foreach($product->images as $im)
                                        <div class="thumbnail">
                                            <a href="{{ getImage('products', $im->image)}}" class="popup-zoom">
                                                <img src="{{ getImage('products', $im->image)}}" alt="{{ $product->name}} Images">
                                            </a>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                  
                                  	@if($product->discount_type)
                                    <div class="label-block">
                                        <div class="product-badget" style="background: #c2050b;">{{$product->discount_type=='fixed'?'Tk :':''}}{{$product->discount}} {{$product->discount_type=='fixed'?'':'%'}} OFF</div>
                                    </div>
                                  	@endif
                                    <div class="product-quick-view position-view">
                                        <a href="{{ getImage('products', $product->image)}}" class="popup-zoom">
                                            <i class="far fa-search-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 order-lg-1">
                                <div class="product-small-thumb-3 small-thumb-wrapper">
                                    <div class="small-thumb-img">
                                        <img src="{{ getImage('products', $product->image)}}" alt="{{ $product->name}} image">
                                    </div>
                                    @foreach($product->images as $im)
                                    <div class="small-thumb-img">
                                        <img src="{{ getImage('products', $im->image)}}" alt="{{ $product->name}} image">
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                      <div class="product_details border p-2">
                        <div class="single-product-content">
                            <div class="inner" style="color:#000">   
                                <div class="product-meta">
                                  	<div style="margin-bottom:10px;margin-top: 10px;">
                                      <h2 class="product-title" >{{ $product->name}}</h2>
                                  	</div>
                                  	<div style="">
                                      <div class="product-price-variant">
                                        <span class="price current-price-product">
                                        @php  
                                          $curr = $info->currency;                   
                                        @endphp

                                        @if($curr == 'BDT')
                                          BDT {{ $data['price'] }}               
                                         @endif                                 
                                        
                                        </span>
                                         @if ($product->regular_price > 0.0)
                                          <span class="price-old">{{ $product->regular_price}}</span>
                                        @endif
                                        <p> <b>SKU:</b>{{ $product->sku}}</p>
                                        @if($data['discount_amount'] > 0 && $data['old_price'] >0)
                                        <del><span class="price old-price" style="font-size:14px;margin-left:10px">                                          
                                         
                                        @php  
                                          $curr = $info->currency;                   
                                        @endphp

                                        @if($curr == 'BDT')
                                           {{ $data['old_price'] }}                
                                         @endif 
                                          
                                          </span></del>
                                        @endif

                                        @if($product->discount_type)
                                        <span class="price old-price" style="font-size:16px;margin-left:12px;background: #c2050b;padding:4px;color:#fff">{{$product->discount}} {{$product->discount_type=='fixed'?'Tk':'%'}} OFF </span>
                                        @endif
                                      </div>
                                  	</div>
                                  	                                  	
                                </div>                             	
                                
                                </div>                               
                                <div class="col-md-12">
                                <form method="POST" action="{{ route('front.carts.store')}}" id="cart_form">
                                    @csrf
                                    @if($product->type=='single')
                                    <input type="hidden" name="variation_id" value="{{ $product->variation->id ?? ''}}">
                                    @else
                                    <div class="product-variations-wrapper">
                                        <div class="product-variation product-size-variation">
                                            <div class="sizes" id="sizes">
                                                @foreach($product->variations as $v)
                                                  @if($v->weight->title == '0.5 gm' && $v->size->title == 'free')
                                                  @else
                                                    <div class="size" value="{{$v->id}}">
                                                        
                                                         @if($v->weight->title == '0.5 gm')
                                                         @else
                                                         {{ $v->weight->title }}
                                                         @endif
                                                    </div>
                                                @endif    
                                                @endforeach
                                            </div>
                                            <input type="hidden" id="size_value" name="variation_id">
                                        </div>
                                    </div>
				
                                    @endif
                           
                                     <input class="qty1 qty-input" type="hidden" name="quantity" value="1" />
                                      <div class="product-action-wrapper" style="margin-bottom: 15px;">
                                        <!-- Start Quentity Action  -->
                                        <input type="hidden" name="product_id" value="{{ $product->id}}">
                                        @if($product->after_discount != '0')
                                        <input type="hidden" name="price" id="price_val" value="{{ $product->after_discount }}">
                                        @else
                                        <input type="hidden" name="price" id="price_val" value="{{ $product->sell_price }}">
                                        @endif
                                        <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
                                        <style>
                                          .product-details-pro-qty {
                                                align-items: center;
                                                display: flex;
                                            }
                                            .pro-qty {
                                                display: inline-block;
                                                position: relative;
                                            }
                                            .pro-qty input {
                                              width: 100px;
                                              height: 30px;
                                              font-size: 16px;
                                              border: 1px solid #ccc;
                                              border-radius: 3px;
                                              color: #505050;
                                              padding: 0 0px 0;
                                              text-align: center;
                                          }
                                          .pro-qty .dec {
                                                right: 0;
                                                padding-right: 18px;
                                            }

                                            .pro-qty .qty-btn {
                                                cursor: pointer;
                                                position: absolute;
                                                line-height: 21px;
                                                color: #1D3557;
                                                top: 50%;
                                                transform: translate(0%, -50%);
                                                font-size: 18px;
                                                text-align: center;
                                                transition: all 0.5s ease 0s;
                                                -webkit-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select: none;
                                            }
                                            .pro-qty .inc {
                                                left: 0;
                                                padding-left: 18px;
                                            }
                                        </style>
                                        <div class="row" style="display: none;">
                                          <div class="col-2 mt-4">
                                            পরিমান
                                          </div>
                                          <div class="col-10 mt-4">
                                            <div class="product-details-pro-qty d-nones">
                                              <div class="pro-qty">
                                                <input type="text" class="qty qty-input quantity-input" title="Quantity" value="1" name="quantity">
                                                <div class="dec qty-btn decrease-qty quantity-button">-</div>
                                                <div class="inc qty-btn increase-qty quantity-button">+</div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                       
                                        <ul class="product-action d-flex-center " style="margin-top: 10px;">
                                            <li class="add-to-cart" style="margin: 0px;">
                                                @if($product->is_free_shipping == 0)
                                                <button class="btn btn-primary mb-3" >অর্ডার করুন </button>
                                                @else
                                                <button class="btn btn-primary mb-3" > অর্ডার করুন</button>
                                                @endif
                                            </li>
                                        </ul>
                                      </div>
                                  </form>
                              </div>
                                <div class="col-md-12">
                                  <form method="POST" action="{{ route('front.carts.store')}}" id="cart_form">
                                    @csrf
                                    @if($product->type=='single')
                                    <input type="hidden" name="variation_id" value="{{ $product->variation->id ?? ''}}">
                                    @else
                                    <div class="product-variations-wrapper">
                                        <div class="product-variation product-size-variation">
                                            <div class="sizes" id="sizes">
                                                @foreach($product->variations as $v)
                                                  @if($v->weight->title == '0.5 gm' && $v->size->title == 'free')
                                                  @else
                                                    <div class="size" value="{{$v->id}}">
                                                        
                                                         @if($v->weight->title == '0.5 gm')
                                                         @else
                                                         {{ $v->weight->title }}
                                                         @endif
                                                    </div>
                                                @endif    
                                                @endforeach
                                            </div>
                                            <input type="hidden" id="size_value" name="variation_id">
                                        </div>
                                    </div>
				
                                    @endif
                           
                                     <input class="qty1 qty-input" type="hidden" name="quantity" value="1" />
                                      <div class="product-action-wrapper" style="margin-bottom: 15px;">
                                        <!-- Start Quentity Action  -->
                                        <input type="hidden" name="product_id" value="{{ $product->id}}">
                                        @if($product->after_discount != '0')
                                        <input type="hidden" name="price" id="price_val" value="{{ $product->after_discount }}">
                                        @else
                                        <input type="hidden" name="price" id="price_val" value="{{ $product->sell_price }}">
                                        @endif
                                        @if($product->delivery_charge)
                                          <input type="hidden" name="delivery_charge" value="{{ $product->delivery_charge }}">
                                        @endif
                                        <input type="hidden" name="is_stock" value="{{ $product->is_stock }}">
                                        <style>
                                          .product-details-pro-qty {
                                                align-items: center;
                                                display: flex;
                                            }
                                            .pro-qty {
                                                display: inline-block;
                                                position: relative;
                                            }
                                            .pro-qty input {
                                              width: 100px;
                                              height: 30px;
                                              font-size: 16px;
                                              border: 1px solid #ccc;
                                              border-radius: 3px;
                                              color: #505050;
                                              padding: 0 0px 0;
                                              text-align: center;
                                          }
                                          .pro-qty .dec {
                                                right: 0;
                                                padding-right: 18px;
                                            }

                                            .pro-qty .qty-btn {
                                                cursor: pointer;
                                                position: absolute;
                                                line-height: 21px;
                                                color: #1D3557;
                                                top: 50%;
                                                transform: translate(0%, -50%);
                                                font-size: 18px;
                                                text-align: center;
                                                transition: all 0.5s ease 0s;
                                                -webkit-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select: none;
                                            }
                                            .pro-qty .inc {
                                                left: 0;
                                                padding-left: 18px;
                                            }
                                        </style>
                                        <div class="row" style="display: none;">
                                          <div class="col-2 mt-4">
                                            পরিমান
                                          </div>
                                          <div class="col-10 mt-4">
                                            <div class="product-details-pro-qty d-nones">
                                              <div class="pro-qty">
                                                <input type="text" class="qty qty-input quantity-input" title="Quantity" value="1" name="quantity">
                                                <div class="dec qty-btn decrease-qty quantity-button">-</div>
                                                <div class="inc qty-btn increase-qty quantity-button">+</div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                       
                                        <ul class="product-action d-flex-center " style="margin-bottom: 10px;">
                                            <li class="add-to-cart" style="margin: 0px;">
                                                @if($product->is_free_shipping == 0)
                                                <button class="btn btn-success text-white" >Order Now</button>
                                                @else
                                                <button class="btn btn-success text-white" > Order Now</button>
                                                @endif
                                            </li>
                                        </ul>
                                      </div>
                                  </form>
                              </div>
                        </div>
                        <a href="tel: {{$info->owner_phone}}" class="btn btn-warning fs-4 d-block mt-3 mb-2"><i class='fas fa-phone-alt'></i> &nbsp;&nbsp; <span><?php echo $info->owner_phone; ?></span></a>
                  

                </div>
                </div>
                  <style>
                  .product-details h1,h2,h3,h4,h5,h6 {
                    font-size: 15px !important;
                    line-height: 22px;
                    color: #505050;
                  }
                </style>
                <div class="col-lg-4">
                    <div class="product-details border p-3">
                      <p class="product-details-title border-bottom mb-3">প্রোডাক্টের ডিটেইলস</p>
                      <p class="product-details-text">
                           {!! $product->body !!}
                      </p>
                  </div>
                
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
        <!-- End .single-product-thumb -->

       
      
    <!-- End Shop Area  -->
<style>
  .page-header-title {
    font-size: 16px;
    font-weight: 500;
    border-radius: 2px;
    padding: 6px;
    color: #505050;
    background: #f7f7f7;
    border-bottom: 2px solid #dc3545;
}
.product-details{
    background: #fff;
    border-radius: 3px;
}
.single-product-thumb h2.product-title {
    font-size: 18px;
    font-weight: 500;
    line-height: 1.2;
}
</style>
    <!-- Start Recently Viewed Product Area  -->
    <div class="axil-product-area bg-color-white pt--10">
        <div class="container-fluid">
          <div class="col-12 mt-4">
						<p class="page-header-title">রিলেটেড প্রোডাক্টস</p>
					</div>
            <div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                <div class="slick-single-layout" id="relative_data">
                    
                </div>
                <!-- End .slick-single-layout -->
            </div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script type="text/javascript">

//   $(document).on('submit','form#cart_submit', function(e) {   
//     e.preventDefault();
    
//     let url=$(this).attr('action');
// 	let method=$(this).attr('method');
// 	let data= $(this).serialize();
	
// 	$.ajax({
// 	    url: url,
//         method: method,
//         data: data,
//         success: function (res) {
//             if (res.success) {
//                 toastr.success(res.msg);
//                 if (res.view) {
//                 	$(document).find('div#cart_section').html(res.view);
//                 }

//                 if (res.item) {
//                 	$(document).find('span.cart-count').text(res.item);
//                 }
              
//                 if(res.url){
//                 	document.location.href = res.url;
//                 } else {
//                     window.location.reload();
//                 }
                
//             }else{
//                 toastr.error(res.msg);
//             }
//         },
//         error:function (response){
//             $.each(response.responseJSON.errors,function(field_name,error){
//                 toastr.error(error);
//             })
//         }
// 	}); 
 
// }); 
    
    $('li.size').click(function(){

        $('li.size').removeClass('active');
   
        $(this).addClass('active');
        
    });


    $('li.color').click(function(){

        $('li.color').removeClass('active');
        $(this).addClass('active');
    
    });
  
  	$(document).ready(function(){
        getRelatedProduct();
        
        function getRelatedProduct(){
            let url ='{{ route("front.products.relativeProduct",[$product->id])}}';
            $.ajax({
                url: url,
                method: 'GET',
                data:{},
                dataType :"JSON",
                success: function (res) {

                    if (res.success) {
                        $('div#relative_data').html(res.html);
                    }
                   
                }
            });
        }

    });
</script>
  <script type="text/javascript">
//   $(document).ready(function(){
//       $('#sizes .size').on('click', function(){
//           $('#sizes .size').removeClass('active');
//           $(this).addClass('active');
//           var value = $(this).attr('value');
//           $("#size-value").val(value);
//           $("#size_value1").val(value);
        
//       }) 
//     });

$('#sizes .size').on('click', function(){
           $('#sizes .size').removeClass('active');
           $(this).addClass('active');
        //   $('#add_here').addClass('hide_span');
           let value = $(this).attr('value');
           $.ajax({
               type: 'get',
               url: '{{ route("front.get-variation_price") }}',
               data: {value},
               success: function(res)
               {
                   $('.current-price-product').text('৳'+res.price);
                   $('#price_val').val(res.price);
                   $('#price_val1').val(res.price);
                   console.log(res);
               }
           });
         
           $("#size_value").val(value);
           $("#size_value1").val(value);
        
       });
    
    $('.increase-qty').on('click', function () {
            var proQty = $('.qty1').val();  
            var qtyInput = $(this).siblings('.qty');
            
            var newQuantity = parseInt(qtyInput.val()) + 1;
            
            $('.qty1').val(newQuantity);
            // proQty.val(newQuantity);
            qtyInput.val(newQuantity);
        });
    
        $('.decrease-qty').on('click', function () {
            var qtyInput = $(this).siblings('.qty');
            var newQuantity = parseInt(qtyInput.val()) - 1;
            if (newQuantity > 0) {
                qtyInput.val(newQuantity);
            }
            if(parseInt(qtyInput.val() != '0'))
            {
                $('.qty1').val(newQuantity);    
            }
            
        });
    
    
    $(".rating-component .star").on("mouseover", function () {
  var onStar = parseInt($(this).data("value"), 10); //
  $(this).parent().children("i.star").each(function (e) {
    if (e < onStar) {
      $(this).addClass("hover");
    } else {
      $(this).removeClass("hover");
    }
  });
}).on("mouseout", function () {
  $(this).parent().children("i.star").each(function (e) {
    $(this).removeClass("hover");
  });
});

$(".rating-component .stars-box .star").on("click", function () {
  var onStar = parseInt($(this).data("value"), 10);
  var stars = $(this).parent().children("i.star");
  var ratingMessage = $(this).data("message");

  var msg = "";
  if (onStar > 1) {
    msg = onStar;
  } else {
    msg = onStar;
  }
  $(document).find('#review').val(onStar);
  $('.rating-component .starrate .ratevalue').val(msg);
  

 
  $(".fa-smile-wink").show();
  
  $(".button-box .done").show();

  if (onStar === 5) {
    $(".button-box .done").removeAttr("disabled");
  } else {
    $(".button-box .done").attr("disabled", "true");
  }

  for (i = 0; i < stars.length; i++) {
    $(stars[i]).removeClass("selected");
  }

  for (i = 0; i < onStar; i++) {
    $(stars[i]).addClass("selected");
  }

  $(".status-msg .rating_msg").val(ratingMessage);
  $(".status-msg").html(ratingMslick-slideressage);
  $("[data-tag-set]").hide();
  $("[data-tag-set=" + onStar + "]").show();
});

$(".feedback-tags  ").on("click", function () {
  var choosedTagsLength = $(this).parent("div.tags-box").find("input").length;
  choosedTagsLength = choosedTagsLength + 1;

  if ($(this).hasClass("choosed")) {
    $(this).removeClass("choosed");
    choosedTagsLength = choosedTagsLength - 2;
  } else {
    $(this).addClass("choosed");
    $(".button-box .done").removeAttr("disabled");
  }

  console.log(choosedTagsLength);

  if (choosedTagsLength <= 0) {
    $(".button-box .done").attr("enabled", "false");
  }
});



$(".compliment-container .fa-smile-wink").on("click", function () {
  $(this).fadeOut("slow", function () {
    $(".list-of-compliment").fadeIn();
  });
});


$(".done").on("click", function () {
  $(".rating-component").hide();
  $(".feedback-tags").hide();
  $(".button-box").hide();
  $(".submited-box").show();
  $(".submited-box .loader").show();

  setTimeout(function () {
    $(".submited-box .loader").hide();
    $(".submited-box .success-message").show();
  }, 1500);
});


  dataLayer.push({ ecommerce: null }); // Clear the previous ecommerce object.
  dataLayer.push({
  event: "view_item",
  ecommerce: {
      currency: "BDT",
      value:  {{ $data['price'] }},
      items: [
          {
              item_id: "{{ $product->id}}",
              item_name: "{{ $product->name}}",
              discount: 0,
              item_brand: "",
              item_category: "vesoj",
              item_list_id: "2",
              price: {{ $data['price'] }},
              quantity: 1
          }
          ]
      }
  });
</script>
@endpush
