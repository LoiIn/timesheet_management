<div class="row mt-5">
    <div class="col-lg-6 offset-lg-3">
        <form action="" > 
            @csrf
            <div class="row">
              <div class="col-5 form-group">
                <input type="text" class="form-control" id="search-username" placeholder="Username">
              </div>
              <div class="col-3 form-group" id="search-role">
                <select class="form-control search-select">
                    <option>roles</option>
                    <option>admin</option>
                    <option>manager</option>
                    <option>member</option>
                </select>
              </div>
              <div class="col-2 form-group" id="search-month">
                <select class="form-control search-select">
                    <option>month</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
              </div>  
              <div class="col-2 form-group">
                <a name="" id="search-btn" class="btn btn-outline-success" href="#" role="button">Search</a>
              </div>  
            </div>
        </form>
        
    </div>
</div>