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
              <label for="new-task-content" class="col-form-label">Content</label>
              <textarea class="form-control" id="new-task-content"></textarea>
            </div>
            <div class="form-group">
                <label for="new-task-end-date"><i class="col-form-label"></i></label>
                <input type="text" class="form-control" name="new-task-end-date" id="new-task-end-date" placeholder="Choose date">
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