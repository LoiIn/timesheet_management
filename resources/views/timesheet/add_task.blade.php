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
          <form>
            <div class="form-group">
                <label for="new-task-id" class="col-form-label">Content</label>
                <input type="text" value="" placeholder="Time exist" class="form-control" id="new-task-id">
            </div>
            <div class="form-group">
              <label for="new-task-content" class="col-form-label">Content</label>
              <textarea class="form-control" id="new-task-content"></textarea>
            </div>
            <div class="form-group">
                <label for="new-task-time" class="col-form-label">Content</label>
                <input type="text" value="" placeholder="Time exist (hours)" class="form-control" id="new-task-exist">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Submit</button>
        </div>
      </div>
    </div>
  </div>