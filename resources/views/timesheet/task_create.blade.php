<div class="modal fade text-left" id="add-task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" class="register-form" id="add-task-form" enctype="multipart/form-data" action="{{route('add_task')}}">
            @csrf
            <div class="form-group">
              <label for="content" class="col-form-label">Content</label>
              <textarea class="form-control" id="content"></textarea>
            </div>
            <div class="form-group">
                <label for="end_date"><i class="col-form-label"></i></label>
                <input type="text" class="form-control" name="end_date" id="end_date" placeholder="Choose date">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>