<style>
        @media only screen and (min-width: 320px) and (max-width: 767px) {
        .cart-dropdown{
            width: 72%;
        }
        .cart-dropdown .cart-content-wrap {
                padding: 15px 15px;
        }
        .cart-dropdown .cart-header .header-title{
            font-size: 16px;
        }

    }
    .cart-dropdown .cart-header .cart-close{
            background: none;
            color: #457B9D;
            font-size: 18px;
        }
        .cart-dropdown .cart-header{
            border-bottom: 1px solid rgba(129, 129, 129, 0.2);
        }
        .cart-dropdown .cart-footer{
            border: none;
        }
        .cart-subtotal{
            padding: 15px 0;
            border-top: 1px dashed #e5e5e5;
            border-bottom: 1px dashed #e5e5e5;
        }
        .cart-dropdown .cart-footer .cart-subtotal{
            font-size: 15px;
        }
    .cart-header h3{
        color: #dc3545 !important;
        font-weight: 500;
        font-size: 16px;
    }
    .cart-checkout-btn {
        padding: 36px 0 30px;
    }
    .cart-checkout-btn a {
    width: 100%;
    display: block;
    margin: 10px 0 0;
    text-align: center;
    padding: 8px 8px 6px;
    text-transform: uppercase;
    font-size: 15px;
    font-weight: 600;
    border-radius: 3px;
    transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
}
.btn-primary {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
.cart-dropdown{
    z-index: 10000000;
}

</style>

<div class="cart-content-wrap">
    <div class="cart-header">
        <h3 class="header-title">শপিং কার্ট</h3>
        <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
    </div>
    <div class="cart-body">
        <ul class="cart-item-list">
            @php
                $total=0;
            @endphp
            @if($cart)
            
            @foreach($cart as $key=>$item)
                @php
                $total +=$item['price']*$item['quantity'];
                @endphp
            <li class="cart-item">
                <div class="item-img">
                    <a href="{{ route('front.products.show',[$key])}}">
                      <img src="{{ getImage('products', $item['image'])}}" alt="Commodo Blown Lamp">
                    </a>
                    <form method="POST" action="{{ route('front.carts.destroy',[$key])}}" id="cart_remove_form">
                        <input type="hidden" name="segment" value="{{ $segm }}">
                        @csrf
                        @method('DELETE')
                        <button class="close-btn" type="submit"><i class="fas fa-times"></i></button> 
                    </form>
                    
                </div>
                <div class="item-content">
                    <p class="item-title"><a href="{{ route('front.products.show',[$item['product_id']])}}">{{ $item['name']}} {{ $item['size'] ??''}} {{ $item['color']??''}}</a></p>
                    <div class="item-price"><span class="currency-symbol"></span> {{ priceFormate($item['price'])}}</div>
                    <div class="pro-qty item-quantity" data-segment="{{ $segm }}" data-href="{{ route('front.carts.edit',[$key])}}">
                        <span class="dec qtybtn">-</span>
                        <input type="number" class="quantity-input" value="{{ $item['quantity']}}">
                        <span class="inc qtybtn">+</span>
                    </div>
                </div>
            </li>
            @endforeach
            @else
            <li class="cart-item">
                {{-- <div class="alert alert-warning"> Your Cart Is Empty !!</div> --}}
            </li>
            @endif
            
        </ul>
    </div>
    
        <div class="cart-footer">
            <p class="cart-subtotal ">
                <span class="subtotal-title">টোটাল প্রাইস:</span>
                <span class="subtotal-amount">{{ priceFormate($total)}}</span>
            </p>
     
            <div class="cart-checkout-btn">
                <a class="btn btn-primary" href="{{ route('front.checkouts.index')}}">অর্ডার করুন &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    
</div>