
  <h1 class = 'container'>
		Edit classroom orientation
	</h1>
    <div class='container pt-3'>
   
    <div class="card">
  <div class="card-body">
    <em>Here, you can change the capacity of classrooms, orientation of seats per column etc.</em>
  </div>
</div>    

<img src="<?php echo base_url();?>img/seating_sample.png" class="img-fluid" alt="Responsive image">

    <div class="card" style="width: 100%;height: auto;object-fit: cover; margin-top: 25px;">
  <div class="card-body">
  <h4 class="card-title">Seating sample</h4>
    <p class="card-text">The default arrangement is such that there are three columns, each containing 7+7, 6, and 7+7 (sub-columns) students each, where 20 of them (7, 6, 7) will be writing one subject, and 14 (7, 7), another subject.</p>
  </div>
</div>

<form  action="<?php echo base_url();?>get_started.php" method="post">
  <div style="width: 100%;height: auto;object-fit: cover; margin-top: 25px;" class="form-group">
    <label for="columnEdit">Edit number of columns</label>
    <input type="text" name="column_count" class="form-control" id="columnEdit" placeholder="3">
  </div>
</form>
<form>
  <div style="width: 100%;height: auto;object-fit: cover; margin-top: 25px;" class="form-group">
    <label for="subcolumnCountEdit">Edit number of Sub-columns</label>
    <input type="text" class="form-control" id="subcolumnCountEdit" placeholder="5">
  </div>
</form>
<form>
  <div style="width: 100%;height: auto;object-fit: cover; margin-top: 25px;" class="form-group">
    <label for="subcolumnPerColumnEdit">Edit sub_columns in each column</label>
    <input type="text" class="form-control" id="subcolumnPerColumnEdit" placeholder="2, 1, 2">
  </div>
</form>
<form>
  <div style="width: 100%;height: auto;object-fit: cover; margin-top: 25px;" class="form-group">
    <label for="rowCountEdit">Edit number of rows in each sub-column</label>
    <input type="text" class="form-control" id="rowCountEdit" placeholder="7, 7, 6, 7, 7">
  </div>
</form>
<p class="text-justify"><em>Refer above image for terms such as sub-column, row, column etc.</em></p>
<button type="submit" style = "margin-bottom: 30px" class="btn btn-primary">Submit</button>
</div>

</html> 