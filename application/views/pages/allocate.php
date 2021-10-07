 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <title>Home</title>
  </head>
  <body >
  <h1 class = 'container'>
		Seating Allocation
	</h1>
    <div class='container pt-3'>
   
    <div class='row'>
	<form method="post">
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">Upload</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile01">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    </div>
		<button id="submit_button" type="button" class="btn btn-primary">Submit</button>
     <button id="generate_button" type="button" class="btn btn-primary" onClick = "location.href='<?php echo base_url();?>get_started/allocate'">Generate</button>
        
	</form>
</div>
<pre>
<p id = "submitted_prompt"></p>
<p id = "note"></p>
<p id = "rooms"></p>
    </div>

<h1 class = 'container'>
    Staff Allocation
  </h1>
    <div class='container pt-3'>
   
    <div class='row'>
  <form method="post">
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">Upload</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile01">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    </div>
    <button id="submit_button" type="button" class="btn btn-primary">Submit</button>
     <button id="generate_button" type="button" class="btn btn-primary">Generate</button>
        
  </form>
</div>

      <script>
      var button_generate = document.getElementById("generate_button");
      var button_submit = document.getElementById("submit_button");
      var submitted = document.getElementById("submitted_prompt");
      var rooms = document.getElementById("rooms");
      var note = document.getElementById("note");
      //code to get subcolumnPerColumn from edit in navbar page
      var subcolumnPerColumn = [2, 1, 2];
      var tempsublist = subcolumnPerColumn;
      
      button_submit.onclick = function(){
        rooms.innerHTML="";
        submitted.innerHTML = "<em>(((This code doesn't work yet :/ )))Your file has been submitted. Click Generate seating button to generate the seating allocation.</em>";
      };


      </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  </body>
</html>