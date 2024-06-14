@php $cart = session()->get('cart', []); @endphp       
<!-- Start Cart Area  -->
<style>
.page-header {
    padding-bottom: 1.5rem;
    padding-top: 1.5rem;
    background: #fe8838;
    color: white;
    text-align: center;
}

.axil-product-table thead{
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
  
}
.axil-product-table thead th{
    font-size: 17px;
}
.axil-product-table tbody td{
    border-bottom: 1px solid #dee2e6;
    font-size: 17px;
}

</style>
        <div class="axil-product-cart-area ">
            <div class="page-header mt-3">
                <div class="container">
                <h1 class="text-white">Shopping Cart</h1>
                <div class="page-header__breadcrumb mt-2">
                  <!-- /snippets/breadcrumb.liquid -->
                  <nav class="sf-breadcrumb w-full " role="navigation" aria-label="breadcrumbs">
                    <div class="container">
                      <div class="flex -mx-4 items-center justify-center">
                        
                        <a href="/" class="text-white" title="Back to the home page">
                             Home
                        </a>

                        <span aria-hidden="true" class="sf__breadcrumb-separator py-2">
                        <svg class="w-[12px] h-[12px]" width="10px" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
                        </span>
                          <span class="sf__breabcrumb-page-title p-4">Your Shopping Cart</span>
                      </div>
                    </div>
                  </nav>
                </div>
            </div>
              </div>
            <div class="container">
                <div class="axil-product-cart-wrap">
                    <div class="product-table-heading">
                        <a href="{{ route('front.carts.clearAll') }}" class="cart-clear mt-2 mb-2" style="color: #dc3545 !important;" onclick="return confirm('Are you sure?')"> <span class="badge bg-warning fs-4">Clear Shoping Cart</span></a>
                      
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail">Product</th>
                                    <th scope="col" class="product-title"></th>
                                    <th scope="col" class="product-price">Price</th>
                                    <th scope="col" class="product-quantity">Quantity</th>
                                    <th scope="col" class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @if($cart)
                                
                                @foreach($cart as $key=>$item)
                                    @php
                                    $price =$item['price']*$item['quantity'];
                                    $total +=$price;
                                    @endphp
                                <tr>
                                    <td class="product-remove">
                                        <form method="POST" action="{{ route('front.carts.destroy',[$key])}}" id="cart_remove_form">
                                            <input type="hidden" name="segment" value="{{ request()->segment(1)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="remove-wishlist" type="submit"><i class="fas fa-times"></i></button> 
                                        </form>
                                    </td>
                                    <td class="product-thumbnail"><a href="single-product.php">
                                        <img src=" {{ getImage('products', $item['image'])}} " alt="Digital Product"></a>
                                    </td>
                                    <td class="product-title"><a href="single-product.php"> {{ $item['name']}} {{ $item['size'] ??''}} {{ $item['color']??''}} </a></td>
                                    <td class="product-price" data-title="Price">{{ priceFormate($item['price'])}}</td>
                                    <td class="product-quantity" data-title="Qty">
                                        <div class="pro-qty" data-segment="{{ request()->segment(1)}}" data-href="{{ route('front.carts.edit',[$key])}}">
                                            <span class="dec qtybtn">-</span>
                                            <input type="number" class="quantity-input" value="{{ $item['quantity'] }}">
                                            <span class="inc qtybtn">+</span>
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal">{{ priceFormate($price)}}</td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                            <div class="axil-order-summery mt--80">
                                <h5 class="title mb--20">Order Summary</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                            <tr class="order-subtotal">
                                                <td>Subtotal</td>
                                                <td>{{ priceFormate($total)}}</td>
                                            </tr>
                                            <tr class="order-shipping">
                                                <td>Shipping</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="radio" id="radio1" name="shipping" checked>
                                                        <label for="radio1">Free Shippping</label>
                                                    </div>                                                   
                                                    
                                                </td>
                                            </tr>
                                            {{-- <tr class="order-tax">
                                                <td>State Tax</td>
                                                <td>$0.00</td>
                                            </tr> --}}
                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount">{{ priceFormate($total)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{ route('front.checkouts.index')}}" class="axil-btn btn-bg-primary checkout-btn">ক্যাশ অন ডেলিভারিতে অর্ডার করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Cart Area  -->