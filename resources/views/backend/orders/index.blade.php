@extends('backend.app')
@section('content')

<style>
  .ps-2, .page-title {
      color: black !important;
  }
 .disable-click{
    pointer-events:none;
}
.status_color{
  color: #fff;
  border-radius: 5px;
  text-align: center;
}
.badge-primary{
    color: #fff;
    background: #007bff;
}
.badge-success {
    color: #fff;
    background-color: #28a745;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.badge-warning {
    color: #212529;
    background-color: #ffc107;
}
.badge-info {
    color: #fff;
    background-color: #17a2b8;
}
.badge-dark {
    color: #fff;
    background-color: #343a40;
}
.badge{
  font-size: 14px !important;
}
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Order List</li>
                </ol>
            </div>
            <h4 class="page-title">Order List</h4> 
        </div>
    </div>
</div>   
<!-- end page title --> 
<style>
    .btn.btn-sm{
        font-size: 12px;
    }    
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">

                    <div class="col-xl-7 text-left">
                        <div class="#" style="">
                            @can('product.create')
                                <a href="{{ route('admin.orders.create')}}" class="btn btn-sm btn-danger mb-1"><i class="mdi mdi-basket me-1"></i> Add New Order</a>
                            @endcan
                            
                            <a class="btn_modal btn btn-sm btn-info mb-1" href="{{ route('admin.orderStatusUpdateMulti')}}"><i class="mdi mdi-plus me-1"></i>
                               Status Change
                            </a>
                            
                            @can('product.delete')
                                <a class="multi_order_delete btn btn-sm btn-danger mb-1" href="{{ route('admin.deleteAllOrder')}}"><i class="mdi mdi-plus me-1"></i>
                                    Delete All
                                </a>
                            @endcan
                            @php $isPending = \App\Models\Order::where(['status' => 'pending'])->first(); @endphp
                            <a class="multi_order_print btn btn-sm btn-success mb-1" href="{{ route('admin.orderList')}}"><i class="mdi mdi-plus me-1"></i>
                                Print
                            </a>                            
                         
                          <a class="send_to_steadfast btn btn-sm btn-success mb-1" href="{{ route('admin.createSteadfastParcel')}}">
                            Send to Steadfast
                          </a>
                          <a class="pathao_content btn btn-sm btn-info mb-1" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Send to Pathao
                          </a>
                         
                          <div class="col-md-4 d-none">
                            <select class="select2" name="redx_status">
                              <option value="" disabled selected>Choose Courier Status</option>
                              <option value="">All</option>
                              <option value="yes">Yes ({{$yes_count}})</option>
                              <option value="no">No ({{$no_count}})</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="col-xl-4 d-none">
                        <div class="text-xl-end mt-xl-0 mt-2">                        
                            <a type="button" href="{{ route('admin.orderExport')}}" class="btn btn-light mb-2">Export</a>
                        </div>
                    </div><!-- end col-->
                </div>   
              
              <div class="d-none d-md-block d-lg-block">
                <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between" id="filter_form">
              <div class="col-12 d-flex justify-content-between align-items-center">
           
                <div class="d-flex">              
                  
                  @foreach(getOrderStatus() as $key=>$value)
                  <label class="ps-2">
                    <input type="radio" class="order_sts"  name="status" value="{{$key}}"/>                    
                    @if(Auth::user()->hasRole('worker'))
                    
                    {{$value}} ({{\App\Models\Order::whereHas('details.product', function($q) {
                    	$q->whereNotNull('name');
                    })->where('status', $key)->where('assign_user_id', Auth::user()->id)->count()}})
                    
                    @else
                    
                    {{$value}} ({{\App\Models\Order::whereHas('details.product', function($q) {
                    	$q->whereNotNull('name');
                    })->where('status', $key)->count()}})
                    
                    @endif                 
                    
                    
                  </label>
                  @endforeach                  
                  
                                                 
                </div>
                 
                <div class="col-4">
                    <label for="inputPassword2" class="visually-hidden">Search</label>
                    <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="q">
                  </div>
                
                  <!-- <div class="col-5 d-none">
                                <div class="d-flex align-items-center ">
                                    <label for="status-select" class="me-2">Status</label>
                                    <select class="form-select" id="status-select" name="status">
                                        <option selected value="">Choose...</option>
                                        {{--<option value="pending" {{$status=='pending' ?'selected':''}}>Pending</option>
                                        <option value="Processing" {{$status=='Processing' ?'selected':''}}>Processing</option>
                                        <option value="complete" {{$status=='complete' ?'selected':''}}>Complete</option>--}}
                                        @foreach(getOrderStatus() as $key=>$value)
                                            <option value="{{$key}}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> !-->
                
                  <div class="col-auto">
                    <label for="submit" class="visually-hidden">Submit</label>
                    <input type="button" class="form-control btn btn-sm btn-dark py-1" id="submit_search" value="Submit">
                  	</div>
     				</div>
                </form>   
              </div>

              <div class="col-sm-12 mt-2" id="rcvd_order">
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>                                    
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input check_all" value="">
                                      </label>
                                    </div>
                                </th>

                              	<th style="width:7%">Action</th>
                                <th>Invoice ID</th>
                                <th>Date Order</th>
                                <th>Customers</th>
                                <th>Product SKU</th>
                                <th>Status</th>
                                <th>View Order</th>
                              	<th style="width:15%">Courier</th>
                                <th>Amount</th>
                               <!-- <th>Discount</th> -->
                               
                               <!-- <th>Due</th> -->
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="order_checkbox" value="{{ $item->id}}">                                    
                                </td>

                              	<td>
                                    <a href="{{$item->status === 'pending' ? 'javascript:void(0)' : route('admin.orders.show',[$item->id])}}" target="{{$item->status === 'pending' ? '' : '_blank'}}" class="action-icon " title="{{$item->status === 'pending' ? 'pending invoice will not be printed' : 'Print Invoice'}}"> <i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a href="{{ route('admin.orders.edit',[$item->id])}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    @can('order.delete')
                                    <a href="{{ route('admin.orders.destroy',[$item->id])}}" class="delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                    @endcan
                                </td>
                                <td style="color: #000;">#{{$item->invoice_no}}</td>
                              	<td style="color: #000;">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                <td style="color: #000;">{{$item->first_name.' '.$item->last_name}}<br>
                                    {{$item->shipping_address}}<br>
                                    {{$item->mobile}} @if ($item->order_serial) ({{ $item->order_serial}}) @endif <a class="btn btn-sm btn-primary" href="tel:{{$item->mobile}}"><span>Call</span></a>
                                </td>
                              <td>
                                  
                                  <?php
                                    foreach($item->details as $detail)
                                    {
                                        if(!isset($detail->product['sku']) || $detail->product['sku'] == '')
                                        {
                                            ?> <span style="color: red;">Unavailable</span> <?php
                                            
                                        } else 
                                        {
                                            echo $detail->product['sku'];
                                        }
                                    }
                                  ?>
                                
                                </td>
                                <td style="width:15%">
                                    <a class="btn_modal" href="{{ route('admin.orderStatus', $item->id)}}">
                                        @if ($item->status == 'pending')
                                        <span class="badge badge-primary">{{$item->status}}</span>
                                        @elseif ($item->status == 'processing')
                                        <span class="badge badge-info">{{$item->status}}</span>
                                        @elseif ($item->status == 'on_the_way')
                                        <span class="badge badge-dark">{{$item->status}}</span>
                                        @elseif ($item->status == 'on_hold')
                                        <span class="badge badge-warning">{{$item->status}}</span>
                                        @elseif ($item->status == 'complete')
                                        <span class="badge badge-success">{{$item->status}}</span>
                                        @elseif ($item->status == 'cancell')
                                        <span class="badge badge-danger">{{$item->status}}</span>
                                        @else
                                        <span class="badge badge-info">{{$item->status}}</span>
                                        @endif
                                    </a>
                                    <a class="reload-status btn btn-sm btn-success" href="{{$item->courier_tracking_id}}"><i class="mdi mdi-refresh"></i></a>
                                </td>
                                <td><a href="{{ route('admin.orders.view', $item->id)}}" target="_blank">
                                        
                                        <span class="badge badge-info">View Order</span>                              
                                    </a>
                                </td>

                                <td style="color: #000;">{{ $item->courier?$item->courier->name:''}} <br> {{ $item->courier_tracking_id ?? ''}}
                              		<br> {{ $item->area_name ?? ''}}
                              	</td>
								            <td style="color: #000;">
                                  @php 
                                    $final_amount = $item->final_amount;                                    
                                    $fa = intval($final_amount);                                    
                                   echo $fa;                                    
                                  @endphp                             
                              </td>  
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  	 </div>
                    <p>{!! urldecode(str_replace("/?","?",$items->appends(Request::all())->render())) !!}</p>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="pathao_content_model">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pathao Content </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
        <div class="modal-body">
            
            <div class="div-group mb-2">
                <label>City</label>
                <select class="form-control city-zone" name="city" id="pathao_city" required>
                </select>
                <input class="order_id" type="hidden" name="order_id" value="">
            </div>

            <div class="div-group mb-2">
                <label>Zone</label>
                <select class="form-control pathao-zone" name="zone" id="zone" required>
                </select>
            </div>

            <div class="div-group mb-2">
                <label>Area</label>
                <select class="form-control pathao-area" name="area" id="area" required>
                </select>
            </div>

            <div class="div-group mb-2">
                <label>Weight</label>
                <input type="text" class="form-control" name="weight" id="weight">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="{{ route('admin.createPathaoParcel')}}" class="send_to_pathao btn btn-primary"> Submit</a>
        </div>
    </div>
  </div>
</div>
@endsection 

@push('js')
<script src="{{ asset('backend/js/order.js')}}"></script>
<script>
$(document).ready(function(){

    $('.pathao_content').on('click', function(){
        var order = $('input.order_checkbox:checked').map(function(){
            return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select Atleast One Order!');
        }  
        $('.order_id').val(order_ids);
        $.ajax({
            type:'GET',
            url:"pathao-city-list",
            success:function(res){
                var html = '<option value=""> Select Option </option>';
                const citys = res.data.data;
                citys.map((city) => {
                    html += '<option value="'+ city.city_id +'">'+ city.city_name +'</option>'
                })
                $(".city-zone").append(html);
            }
        });
    })



    $("#pathao_city").on('change', function(){
        var cityValue = $('#pathao_city').val();
        $.ajax({
            type:'GET',
            url:"zones-by-city/" + cityValue,
            success:function(res){
                var html = '<option value=""> Select Option </option>';
                const zones = res.zones;
                zones.map((zone) => {
                    html += '<option value="'+ zone.zone_id +'">'+ zone.zone_name +'</option>'
                })
                $(".pathao-zone").append(html);
            }
        });
    })

    $("#zone").on('change', function(){
        var zoneValue = $('#zone').val();
        $.ajax({
            type:'GET',
            url:"areas-by-zone/" + zoneValue,
            success:function(res){
                var html = '<option value=""> Select Option </option>';
                const areas = res.areas;
                areas.map((area) => {
                    html += '<option value="'+ area.area_id +'">'+ area.area_name +'</option>'
                })
                $(".pathao-area").append(html);
            }
        });
    })
    
    $("select[name='redx_status']").on('change', function(){
        getOrderList();
    });   
    
    $("select[name='courier_type']").on('change', function(){
        getOrderList();
    });  
    
    $('.order_sts').on('click', function(){
        getOrderList();
    });
    
    function getOrderList()
    {
        var statusValue = $("input[name='status']:checked").val();
        var redx_status = $("select[name='redx_status']").val();
        var courier_type = $("select[name='courier_type']").val();
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.status_wise_order') }}",
            data: {statusValue, redx_status, courier_type},
            success: function(res){
                if(res.success == true){            
                $('#rcvd_order').html(res.view);             	
                }
            }     
        }); 
    }
    
    $('#submit_search').on('click', function(){
      var searchValue = $("input[name='q']").val();
      $.ajax({
        type: 'GET',
      	url: "{{ route('admin.searchOrder') }}",
        data: {searchValue},
        success: function(res){
      		if(res.success == true){            
              $('#rcvd_order').html(res.view);             	
            }
        }     
      });
      
    });

    $(".check_all").on('change',function(){
      $(".order_checkbox").prop('checked',$(this).is(":checked"));
    });

    $(document).on('submit', 'form#order_status_update_form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        let status=$(document).find('select#multi_status').val();
    
        var order = $('input.order_checkbox:checked').map(function(){
          return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select An Order First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{status,order_ids},
           success:function(res){
               if(res.status==true){
                toastr.success(res.msg);
                window.location.reload();
                
            }else if(res.status==false){
                toastr.error(res.msg);
            }
           }
        });
    
    });

    $(document).on('submit', 'form#order_assign_form', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        let assign_user_id=$(document).find('select#assign_user_id').val();
    
        var order = $('input.order_checkbox:checked').map(function(){
          return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select An Order First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{assign_user_id,order_ids},
           success:function(res){
               if(res.status==true){
                toastr.success(res.msg);
                window.location.reload();
                
            }else if(res.status==false){
                toastr.error(res.msg);
            }
           }
        });
    
    });

    $(document).on('click', 'a.multi_order_delete', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    
        var order = $('input.order_checkbox:checked').map(function(){
          return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select An Order First !');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url:url,
           data:{order_ids},
           success:function(res){
               if(res.status==true){
                toastr.success(res.msg);
                window.location.reload();
                
            }else if(res.status==false){
                toastr.error(res.msg);
            }
           }
        });
    
    }); 
    
    $(document).on('click', 'a.multi_order_print', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    
        var order = $('input.order_checkbox:checked').map(function(){
          return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select Atleast One Order!');
            return ;
        }
        
        $.ajax({
           type:'GET',
           url,
           data:{order_ids},
           success:function(res){
               if(res.status==true){
                   console.log(res.items, res.info);                          
                   var myWindow = window.open("", "_blank");                   
  				   myWindow.document.write(res.view);                   
                // toastr.success(res.msg);
                // window.location.reload();
                   
            }else if(res.status==false){
                toastr.error(res.msg);
            }
           }
        });
    
    }); 
  
  
  //Redx Courier Service
  $(document).on('click', 'a.send_to_redx', function(e){
        e.preventDefault();
    // 	var statusValue = $("input[name='status']:checked").val();
        var url = $(this).attr('href');
    	let link = $(this);
        var order = $('input.order_checkbox:checked').map(function(){
          return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select Atleast One Order!');
            return ;
        }        
    	
        // else if(statusValue != 'on_the_way'){
        //     toastr.error('Only On The Way Orders are Accepted!');
        //     return ;
        // }
    	
        
        $.ajax({
           type:'GET',
           url,
           data:{order_ids},
           beforeSend: function(){
             link.addClass('disable-click');
             link.text('Please wait...');
           },
           success:function(res){
               link.removeClass('disable-click');
               link.text('Send to Redx');
               if(res.status){               
                toastr.success(res.msg);
                   
            }else{
                toastr.error(res.msg);
            }
           }
        });
    
    });
  
  //Pathao Courier Service
  $(document).on('click', 'a.send_to_pathao', function(e){
        e.preventDefault();
    	var statusValue = $("input[name='status']:checked").val();
        var order_ids = $(".order_id").val().split();
        var url = $(this).attr('href');
    	let link = $(this);

        var city = $('#pathao_city').val();
        var zone = $('#zone').val();
        var area = $('#area').val();
        var weight = $('#weight').val();
        var address = $('#area option:selected').text() +", "+ $('#zone option:selected').text()+ ", " +$('#pathao_city option:selected').text();


        if(order_ids.length ==0){
            toastr.error('Please Select Atleast One Order!');
            $("#exampleModal").modal('hide');
            return ;
        } 

    	
        
        $.ajax({
            type:'GET',
            url,
            data:{order_ids, city, zone, area, weight, address},
            beforeSend: function(){
                link.addClass('disable-click');
                link.text('Please wait...');
            },
            success:function(res){
                link.removeClass('disable-click');
                link.text('Send to Pathao');
                if(res.status){       
                $("#exampleModal").modal('hide');        
                toastr.success(res.msg);
            }else{
                $("#exampleModal").modal('hide');
                toastr.warning(res.error);
                console.log(res.errors);
            }},
            error:function(error){
                $("#exampleModal").modal('hide');
                console.log(error);
            }
        });
    
    });

  //Steadfast Courier Service
    $(document).on('click', 'a.send_to_steadfast', function(e){
        e.preventDefault();
    	var statusValue = $("input[name='status']:checked").val();
        var url = $(this).attr('href');
    	let link = $(this);
        var order = $('input.order_checkbox:checked').map(function(){
          return $(this).val();
        });
        var order_ids=order.get();
        
        if(order_ids.length ==0){
            toastr.error('Please Select Atleast One Order!');
            return ;
        }        
    	
        // else if(statusValue != '0'){
        //     toastr.error('Only On The Way Orders are Accepted!');
        //     return ;
        // }
    	
        
        $.ajax({
           type:'GET',
           url,
           data:{order_ids},
           beforeSend: function(){
             link.addClass('disable-click');
             link.text('Please wait...');
           },
           success:function(res){
               link.removeClass('disable-click');
               link.text('Send to Steadfast');
               if(res.status){               
                toastr.success(res.msg);
                   
            }else{
                toastr.error(`Invoice :${res.invoice} something went wrong!`);
              	console.log(res.errors);
            }
           }
        });
    
    });
    $(document).on('click', 'a.reload-status', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
    	let link = $(this);
        if (url) {
            $.ajax({
            type:'GET',
            url:"get-courier-status/" + url,
            beforeSend: function(){
                link.addClass('disable-click');
            },
            success:function(res){
                console.log(res);
                link.removeClass('disable-click');
                if(res.status){               
                    toastr.success(res.success);
                    window.location.reload();
                }else{
                    toastr.error(`Invoice :${res.invoice} something went wrong!`);
                    console.log(res.errors);
                }
            }
            });
        }else{
            toastr.warning("This Order not have Consignment ID");
        }
    });


    $(document).on('click','a.delete', function(e) {
    var form=$(this);
    e.preventDefault(); 
    swal({
      title: "Are you sure?",
      text: "You want To Delete!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#006400",
      confirmButtonText: "Yes, do it!",
      cancelButtonText: "No, cancel plz!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {

        var url=$(form).attr('href');

        $.ajax({
            type: 'DELETE',
            url: url,
            data: {"_token": "{{ csrf_token() }}"},
            success: function(res) {
                
                if(res.status==true){
                    toastr.success(res.msg);
                    if(res.url){
                        document.location.href = res.url;
                    }else{
                        window.location.reload();
                    }
                }else if(res.status==false){
                    toastr.error(res.msg);
                }
                
            },
            error:function (response){
                
            }
        });
      } else {
        swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
    });
});
  
    

})
  
</script>
@endpush