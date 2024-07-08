<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt Print</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            box-shadow: 0 0 1in -0.25in rgb(0,0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 82mm;
            background: #fff;
        }
        .bold{
            font-weight: bold;
        }
        .my-2{
            margin: 5px 0px;
        }
        .text-sm{
            font-size: 12px;
        }
        .border-b{
            border-bottom: 1px solid #222;
        }
        table th{
            padding: 0px 5px;
            border: 1px solid #333;
        }
        .text-left{
            text-align: left;
        }

    </style>
</head>
<body>
    <center>
        <div class="logo">
            <img width="100px" height="60px" src="{{asset('/uploads/img/'. $info->site_logo)}}" alt="">
        </div>
        <div class="info">
            <h4  class="border-b">Contact Us</h4>
            <p class="my-2 text-sm"><b>Address: </b>{{$info->address}}</p>
            <p class="my-2 text-sm"><b>Email: </b>{{$info->owner_email}}</p>
            <p class="my-2 text-sm"><b>Phone: </b>{{$info->owner_phone}}</p>
            <p class="my-2 text-sm"><b>Invoice Id: </b>#12345</p>
            <p class="my-2 text-sm"><b>Date: </b>{{dateFormate($item->date)}}</p>
        </div>
    </center>
    <section>
        <table class="border">
            <thead class="border">
                <th>SL</th>
                <th>Item</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
            </thead>
            <tbody>
                @foreach ($item->details as  $key => $product )
                <tr>
                    <td>{{ $key +1 }}</td>
                    <td class="text-sm">{{ $product->product->name}}  {{ $product->productsize?$product->productsize->title:''}}</td>
                    <td>
                        <?php
                            if(!isset($product->variation->weight->title) || $product->variation->weight->title == null)
                            {
                                echo '';
                            } else {        
                                echo $product->variation->weight->title;                               
                            }
                        ?>
                    </td>
                    <td>
                        @if (!empty($product->variation->price))
                            {{ $product->variation->price }}
                        @else                        
                            {{ $product->product->sell_price}}
                        @endif
                    </td>
                    <td>{{ $product->quantity}}</td>  
                    {{-- <td>&#2547; 680</td> --}}
                    @php 
                    $total = 0;
                    $row_total = 0;
                    if (!empty($product->variation->price)) {
                        $row_total = $product->variation->price * $product->quantity;
                        $total += $row_total;
                    }
                    else{
                        $row_total = $product->product->sell_price * $product->quantity;
                        $total += $row_total;
                    }
                    @endphp
                    <td>{{ priceFormate($row_total)}}</td>
                </tr>
                @endforeach
                
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Sub-Total</td>
                    <td>:</td>
                    <td>{{ priceFormate($total)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Discount:</td>
                    <td>:</td>
                    <td>{{ priceFormate($item->discount)}}</td>
                </tr>
                <tr class="border-b">
                    <td></td>
                    <td></td>
                    <td colspan="2">Delivery Charge</td>
                    <td>:</td>
                    <td>{{ ($item->delivery_charge_id == 0) ? '0' : priceFormate($item->shipping_charge)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2">Total:</td>
                    <td>:</td>
                    <td>{{ priceFormate($item->final_amount)}}</td>
                </tr>
            </tbody>
        </table>
    </section>
    <section>
        <center>
            <p class="my-2">
                <strong>** Thank you for visiting **</strong><br>
                <span class="my-2">Printed on: {{ date('d-m-y:h:i:sa') }}</span>
            </p>
        </center>
        
    </section>
</body>
</html>