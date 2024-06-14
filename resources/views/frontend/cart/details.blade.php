@php $cart = session()->get('cart', []); @endphp
<style>
    .checkout-cart-area {
        background: #fff;
        border-radius: 3px;
        padding: 10px;
        margin-bottom: 0px;
        min-height: 75vh;
    }
    .cart-table-wrap .cart-table table tbody > tr td {
        padding: 5px 5px 5px 0px;
    }
    .checkout-cart-area .td-product-image {
        width: 100px;
    }
    .cart-table-wrap .cart-table table tbody > tr td.product-thumbnail a {
      display: block;
     }
     .cart-table-wrap .cart-table table tbody > tr td.product-thumbnail a img {
      height: 80px;
      width: 80px;
    }
    .checkout-cart-area .td-product-name {
      padding: 0px;
      margin: 0px;
      font-size: 15px !important;
      font-weight: 500;
    }
    .checkout-cart-area .td-product-quantity {
      padding: 0px;
      margin: 0px;
      font-size: 14px !important;
    }
    .checkout-cart-area .td-product-price {
    padding: 0px;
    margin: 0px;
    font-size: 13px !important;
    font-weight: 400;
  }
  .price-color {
    color: #dc3545 !important;
  }
  .cart-table-wrap .cart-table table tbody > tr td.product-remove a {
    font-size: 18px;
    color: #FF5A5A;
    display: inline-block;
  }
  .checkout-cart-area .total-table {
    border-top: 2px solid #f85606;
  }
  .checkout-cart-area .total-table td {
    padding: 0px;
    font-size: 14px;
  }
  .checkout-cart-area .val-total-amount, .checkout-cart-area .val-delivery-charge, .checkout-cart-area .val-sub-total-amount {
    text-align: right;
    font-style: normal;
  }
  .checkout-cart-area .total-table td {
    padding: 0px;
  }
  .checkout-cart-area .val-sub-total-amount {
      font-size: 16px !important;
  }
  .price-toggle-wrap a.active {
    background-position: center;
    background: #eee;
    color: #dc3545;
  }
  .price-toggle-wrap a {
    font-size: 14px;
    font-weight: 500;
    padding: 5px 10px 1px 10px;
    float: left;
    border-radius: 0px;
    margin: 0px 0px;
    background-position: center;
    position: relative;
    overflow: hidden;
    background-color: #ffffff;
    border: 1px solid #eee;
    color: #555;
    -webkit-transition: all 0.25s linear;
    transition: all 0.25s linear;
  }
  .btn-primary {
    color: #fff;
    background-color: #28a745;
    border-color:#28a745;
    font-weight: bold;
    font-size: 23px;
  }

  .checkout-cart-area .total-table .btn {
    border-radius: 5px;
    font-size: 13px;
    padding: 8px;
  }
  .btn-primary:hover{
    background-color:#009933 !important;
    border-color: #009933;
  }
</style>


<div class="cart-table-wrap checkout-cart-area border p-2">
  <div class="cart-table table-responsive">
    <table>							
      <tbody>			
        @php
        $total=0;
        $discount=0;
        @endphp
        @foreach($cart as $key=>$item)
        @php
        $price=$item['price']*$item['quantity'];
        $total +=$price;
        $discount +=$item['discount']*$item['quantity'];
        @endphp
        <tr>
            <td class="product-thumbnail td-product-image">
              <a href="{{ route('front.products.show', [$item['product_id'] ]) }}">
                <img class="" src="{{ getImage('products', $item['image']) }}" alt="Image" width="85" height="85">
              </a>
            </td>
            <td class="product-name">
              <p class="td-product-name">{{ $item['name']}}</p>
              <p class="td-product-quantity">Quantity: {{ $item['quantity'] }} x {{ priceFormate($item['price'])}}</p>
              <p class="td-product-price price-color"> {{ priceFormate($price) }}</p>
            </td>										
            <td class="product-remove">
               <a data-href="{{ route('front.carts.destroy',[$key])}}" style="display:none;" class="btn remove_item" type="button"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach                   
      </tbody>
    </table>
  </div>
  <table class="total-table">							
    <tbody>
    <input type="hidden" id="product_total_price" value="{{$total}}"/>
      <tr><td class="lbl-total-amount">টোটাল প্রাইস</td><td class="val-total-amount" id="val-total-amount">{{ priceFormate($total)}}</td></tr>
      <tr><td class="lbl-delivery-charge">ডেলিভারি চার্জ</td><td class="val-delivery-charge" id="val-delivery-charge">{{ priceFormate('50')}}</td></tr>
      <tr><td class="lbl-sub-total-amount">সর্বমোট টাকা</td><td class="val-sub-total-amount price-color" id="val-sub-total-amount">{{ priceFormate($total +50)}}</td></tr>
      <tr>
        {{-- <td colspan="2">
          <section class="section pricing-tab-toggle-section mt-4">
            <div class="price-toggle-wrap clearfix mb-0 w-100">	
                <a href="javascript:void(0)" class="active">ক্যাশ অন ডেলিভারি</a>
            </div>
            											
          </section>
        </td> --}}
      </tr>									
    </tbody>
  </table>
</div>

