{{-- <div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #0EA3AC;">
            <a href="{{url('admin/products')}}">
                <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="Campaign Sent"> Total Products </h5>
                        <h3 class="my-2 py-1 text-light">{{ number_format($products,0)}}</h3>
                        
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <div id="campaign-sent-chart" data-colors="#3688fc"></div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
            </a>
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #2DAC37;">
            <a href="{{url('admin/orders')}}">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="New Leads"> Total Order</h5>
                        <h3 class="my-2 py-1 text-light">{{ number_format($orders,0)}}</h3>
                       
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <div id="new-leads-chart" data-colors="#42d29d"></div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
            </a>
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #F5BD08;">
            
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-dark fw-normal mt-0 text-truncate" title="Deals">Total User</h5>
                        <h3 class="my-2 py-1 text-dark">{{ number_format($users,0)}}</h3>
                        
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <div id="deals-chart" data-colors="#3688fc"></div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #C9213B;">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="Booked Revenue">Today Sell</h5>
                      	<h3 class="my-2 py-1 text-light">৳ {{ number_format($today_sell,2)}}</h3>
                        
                    </div>
                    <!--<div class="col-6">-->
                    <!--    <div class="text-end">-->
                    <!--        <div id="booked-revenue-chart" data-colors="#42d29d"></div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    
    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #133F5C;">
            <a href="{{ route('admin.settings.index') }}">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="Booked Revenue">Site Info</h5>
                      	<h3 class="my-2 py-1 text-light">Settings</h3>
                        
                    </div>
                    
                </div> <!-- end row-->
            </div> <!-- end card-body -->
            </a>
        </div> <!-- end card -->
    </div> <!-- end col -->
            <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #EB5F5E;">
    <a href="{{ url('admin/order-report') }}">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="Booked Revenue">Report</h5>
                      	<h3 class="my-2 py-1 text-light">View Report</h3>
                        
                    </div>
                    
                </div> <!-- end row-->
            </div> <!-- end card-body -->
            </a>
        </div> <!-- end card -->
    </div> <!-- end col -->
    </a>
    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #893CFB;">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="Booked Revenue">This Month Revenue</h5>
                      	<h3 class="my-2 py-1 text-light">৳ {{ number_format($current_month_sell,2)}}</h3>
                        
                    </div>
                    
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    <div class="col-md-6 col-xl-3">
        <div class="card" style="background-color: #893CFB;">
            <div class="card-body py-2">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="text-light fw-normal mt-0 text-truncate" title="Booked Revenue">Last Month Revenue</h5>
                      	<h3 class="my-2 py-1 text-light">৳ {{ number_format($prev_month_sell,2)}}</h3>
                        
                    </div>
                    
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
  
    <!-- end col-->
</div>
<!-- end row--> --}}

<div class="row">

    <div class="col-md-2 col-4 mb-1 p-1">
        <a href="{{ route('admin.products.create')}}">
            <div class="bg-white p-0 pb-2 pt-3 text-center service-box">
                <i class="fas fa-cloud-upload-alt service-icon"></i>
                <p class="m-0 pt-1 mb-2 service-name"><span class="d-sn-1">প্রোডাক্ট</span>আপলোড</p>				
            </div>
        </a>
    </div>
    <div class="col-md-2 col-4 mb-1 p-1">
        <a href="{{ route('admin.products.index')}}">
            <div class="bg-white p-0 pb-2 pt-3 text-center service-box">
                <p class="m-0 icon-value">{{ number_format($products,0) }}</p>	
                <p class="m-0 pt-1 mb-2 service-name"><span class="d-sn-1">টোটাল</span>প্রোডাক্ট</p>				
            </div>
        </a>
    </div>
    <div class="col-md-2 col-4 mb-1 p-1">
        <a href="#">
            <div class="bg-white p-0 pb-2 pt-3 text-center service-box">
                <p class="m-0 icon-value">{{ number_format($users,0)}}</p>	
                <p class="m-0 pt-1 mb-2 service-name"><span class="d-sn-1">টোটাল</span>কাস্টমার</p>				
            </div>
        </a>
    </div>
    <?php
    $date = date('Y-m-d');
    $today_orders = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->count();
    ?>
    <div class="col-md-2 col-4 mb-2 p-1">
        <a href="#">
            <div class="bg-white p-0 pb-2 pt-3 text-center service-box">
                <p class="m-0 icon-value">{{ $today_orders}}</p>	
                <p class="m-0 pt-1 mb-2 service-name"><span class="d-sn-1">আজকের</span>অর্ডার</p>				
            </div>
        </a>
    </div>
    <div class="col-md-2 col-4 mb-2 p-1">
        <a href="#">
            <div class="bg-white p-0 pb-2 pt-3 text-center service-box">
                <p class="m-0 icon-value">{{ number_format($orderPending,0)}}</p>	
                <p class="m-0 pt-1 mb-2 service-name"><span class="d-sn-1">পেন্ডিং</span>অর্ডার</p>				
            </div>
        </a>
    </div>
    <div class="col-md-2 col-4 mb-2 p-1">
        <a href="#">
            <div class="bg-white p-0 pb-2 pt-3 text-center service-box">
                <p class="m-0 icon-value">{{ number_format($orderProcessing,0)}}</p>	
                <p class="m-0 pt-1 mb-2 service-name"><span class="d-sn-1">প্রসেসিং</span>অর্ডার</p>				
            </div>
        </a>
    </div>	
</div>