@extends('backend.app')
@section('content')
 
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
<form  id="order_report_form" method="POST" action="{{ route('admin.fraud.user.submit') }}">
  
    @csrf
  <div class="form-group">
    <label for="mobile">Phone Number</label>
    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Which number you want to fraud list">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Reason </label>
    
    <textarea name="reason" id=""  class="form-control" cols="30" rows="10"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

 <table class="table table-striped">
    <thead>
      <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Reason </th>
        <th>Action </th>
      </tr>
    </thead>
 
   <tbody>
  @php $serialNumber = 1; @endphp   
 @foreach($users as $user)
     <tr>
        <td>{{ $serialNumber++ }}</td>
        <td>{{$user->full_name}}</td>
        <td>{{$user->mobile}}</td>
        <td>{{$user->reason}}</td>
       <td> <a href="#" class="btn btn-danger">Delete </a>
       		<a href="{{route('admin.fraud.user.update', ['id' => $user->id])}}" > </a>
         <a href="#" data-toggle="modal" data-target="#editIpBlockModal{{ $user->id }}" class="btn btn-primary">Edit </a>
       </td>
      </tr>
     
     <div class="modal fade" id="editIpBlockModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editIpBlockModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIpBlockModalLabel">Number in Fraud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.fraud.user.update', ['id' => $user->id]) }}" method="POST" class="edit-form">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="editIp">phone</label>
                            <input type="number" class="form-control" id="editIp" name="mobile" value="{{ $user->mobile }}">
                        </div>
                        <div class="form-group">
                            <label for="editReason">Reason</label>
                            <textarea class="form-control" id="editReason" name="reason">{{ $user->reason }}</textarea>
                        </div>
                        <div class="form-group form-check my-2">
                          <input type="checkbox" name="block" checked class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Block</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 @endforeach    
     </tbody>
  </table>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();
            
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(response) {
                    if (response.success) {

                      Window.location.reload()
                        // Update table row with new data
                        // var row = form.closest('tr');
                        // row.find('.ip-address').text(response.ip_address);
                        // row.find('.reason').text(response.reason);
                        
                        // Close the modal
                        // form.closest('.modal').modal('hide');
                    }
                },
                error: function() {
                    alert('Error updating IP block.');
                }
            });
        });
    });
</script>
@endpush
