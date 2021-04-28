<div class="modal fade text-left" id="add-timesheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new timesheet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
                <label for="new-ts-problems" class="col-form-label">Problems</label>
                <textarea class="form-control" id="new-ts-problems"></textarea>
              </div>
            <div class="form-group">
              <label for="new-ts-plan" class="col-form-label">Plan</label>
              <textarea class="form-control" id="new-ts-plan"></textarea>
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