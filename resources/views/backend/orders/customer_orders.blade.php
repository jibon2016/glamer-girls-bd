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
.btn.btn-sm{
        font-size: 12px;
}    
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Customer Orders Info</li>
                </ol>
            </div>
            <h4 class="page-title">Orders info</h4> 
        </div>
    </div>
</div>   
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-12 text-dark">
                        <div class="mb-2 text-center text-uppercase fs-4 ">Customer Information</div>
                        <table class="table table-striped table-responsive">
                            <tbody class="text-center">
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>{{ $user?->full_name }}</td>
                                </tr>
                                <tr>
                                <th scope="row">Phone</th>
                                <td>{{ $number}}</td>
                                </tr>
                                <tr>
                                <th scope="row">Address</th>
                                <td>{{ $user?->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-responsive text-center table-bordered mt-5  border-secondary">
                            <thead>
                                <th>Curier</th>
                                <th>Total</th>
                                <th class="table-success">Delivered</th>
                                <th class="table-danger">Pending</th>
                                <th>Success </th>
                            </thead>
                            <tbody class="text-center">
                                @if (isset($courier[2]))
                                    <tr>
                                        <th scope="row">Pathao</th>
                                        @php
                                            $pathaoTotal = $courier[2]['delivered'] + $courier[2]['pending'];
                                        @endphp
                                        <td>{{ $pathaoTotal }}</td>
                                        <td class="table-success">{{ $courier[2]['delivered'] }}</td>
                                        <td class="table-danger">{{ $courier[2]['pending'] }}</td>
                                        <td>{{ ($courier[2]['delivered'] * 100)/($courier[2]['delivered'] + $courier[2]['pending'])  }}%</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th scope="row">Pathao</th>
                                        @php
                                            $pathaoTotal = 0
                                        @endphp
                                        <td>{{ $pathaoTotal }}</td>
                                        <td class="table-success">0</td>
                                        <td class="table-danger">0</td>
                                        <td>0</td>
                                    </tr>
                                @endif
                                @if (isset($courier[5]))
                                    <tr>
                                        <th scope="row">SteadFast</th>
                                        @php
                                            $sfTotal = $courier[5]['delivered'] + $courier[5]['pending'];
                                        @endphp
                                        <td>{{ $sfTotal }}</td>
                                        <td class="table-success">{{ $courier[5]['delivered'] }}</td>
                                        <td class="table-danger">{{ $courier[5]['pending'] }}</td>
                                        <td>{{ ($courier[5]['delivered'] * 100)/($courier[5]['delivered'] + $courier[5]['pending']) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th scope="row">SteadFast</th>
                                        @php
                                            $sfTotal = 0;
                                        @endphp
                                        <td>{{ $sfTotal }}</td>
                                        <td class="table-success">0</td>
                                        <td class="table-danger">0</td>
                                        <td>0</td>
                                    </tr>
                                @endif
                                @if(isset($courier[6]))
                                <tr>
                                    <th scope="row">RedX</th>
                                    @php
                                        $redxTotal = $courier[6]['delivered'] + $courier[6]['pending'];
                                    @endphp
                                    <td>{{ $redxTotal }}</td>
                                    <td class="table-success">{{ $courier[6]['delivered'] }}</td>
                                    <td class="table-danger">{{ $courier[6]['pending'] }}</td>
                                    <td>{{ ($courier[6]['delivered'] * 100)/($courier[6]['delivered'] + $courier[6]['pending']) }}</td>
                                </tr>
                                @else
                                    <tr>
                                        <th scope="row">RedX</th>
                                        @php
                                            $redxTotal = 0;
                                        @endphp
                                        <td>{{ $redxTotal }}</td>
                                        <td class="table-success">0</td>
                                        <td class="table-danger">0</td>
                                        <td>0</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->



@endsection 

@push('js')
<script>
$(document).ready(function(){

});
</script>
@endpush