@extends('frontend.app')
@section('content')
@php
    $order_details = \App\Models\OrderDetails::where('order_id',$order->id)->get();
@endphp

<main class="main-wrapper">
    
    <div class="container-fluid">
        <div class="">
            <div class="vh-10 d-flex justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="border border-1 border-success"></div>
                    <div class="card  bg-white shadow p-5">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                                fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                            </svg>
                        </div>
                        <div class="text-center">
                             <h1 style="margin: 15px 0px;color: #dc3545;">ধন্যবাদ !</h1>
                            <h3 style="color: #0FA298;">আপনার অর্ডারটি গ্রহন করা হয়েছে । </h3>
                            <h3 style="padding: 2% 17%;color: #26244D;">আমাদের একজন বিক্রয় প্রতিনিধি অর্ডারটি নিশ্চিত করার জন্য শীঘ্রই আপনাকে কল করবে! </h3>
                          
                          <p>For Your Order !  Invoice No :<b><a title="Print this invoice" target="_blank" href="{{ route('front.orders.show', [$order->id])}}">#{{$order->invoice_no}}</a></b></p>
                            <a class="btn btn-success" href="{{ route('front.home')}}"> Go To Home</a>
                            <a class="btn btn-success" href="{{ route('front.dashboard.index')}}"> Go To Dashboard</a>
                            <a target="_blank" class="btn btn-success" href="{{ route('front.orders.show', [$order->id])}}">Print Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .row -->
        </div>
    </div>
</main>

@endsection

@push('js')
<script>
    dataLayer.push({ ecommerce: null }); // Clear the previous ecommerce object.
dataLayer.push({
event: "purchase",
ecommerce: {
transaction_id: "{{ $order->invoice_no }}",
value: {{ $order->amount }},
tax: 0.0,
shipping: 50,
currency: "BDT",
coupon: "SALE",
    items: [
         @foreach ($order_details as $key=>$detail)
            @php
                $product = \App\Models\Product::where('id',$detail->product_id)->first(); 
            @endphp
        {
            item_id: "{{ $detail->product_id }}",
            item_name: "{{ $product->name }}",
            affiliation: "",
            coupon: "SUMMER",
            discount: 2.22,
            index: 0,
            item_brand: "",
            item_category: "",
            item_list_id: "2",
            item_list_name: "Related Products",
            item_variant: "",
            location_id: "",
            price: {{ $detail->unit_price }},
            quantity: {{ $detail->quantity }}
        },
        @endforeach
    ],
customer_name: "{{ $order->first_name }}",
customer_phone:  "{{ $order->mobile }}",
customer_address: "{{ $order->shipping_address }}"

}
})
</script>
@endpush