<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Catgeory Update</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('admin.sizes.update',[$item->id]) }}" method="POST" id="ajax_form">
      @csrf
      {{ method_field('PATCH') }}
      <div class="modal-body">
          <div class="form-group mb-3">
              <input type="text" class="form-control" name="title" value="{{$item->title}}">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Update</button>
      </div>
    </form>
  </div>
</div>