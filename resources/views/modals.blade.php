<div id="addCall" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Add Call</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('calls.store')}}" id="call_form">
        <input type="hidden" value="" name="type">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Person Name</label>
            <input type="text" class="form-control" name="person_name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone No</label>
            <input type="text" class="form-control" name="phone">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Company</label>
            <input type="text" class="form-control" name="company">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">City</label>
            <input type="text" class="form-control" name="city">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Website</label>
            <input type="text" class="form-control" name="website">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Date & Time</label>
            <input type="text" class="form-control date_time_picker" id="date_time_picker" name="date_time">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No Of Calls</label>
            <input type="number" class="form-control" name="no_of_calls">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Remarks</label>
            <textarea class="form-control" name="remarks"></textarea>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>