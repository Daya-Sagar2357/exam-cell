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
     <button id="generate_button" type="button" class="btn btn-primary">Generate</button>
        
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
      var temp = "<?php 
        echo "<pre>";
        //code to get subcolumnPerColumn from edit in navbar page or to get from js variable idk
        $templist = [2, 1, 2];
        foreach(array_keys($h) as $session){
          foreach(array_keys($h[$session]) as $room){
            echo "<div style=' border:1px solid black;margin:10px; padding: 20px;'>";
            echo "<br><h3>";  
            print "Date and Session: ";
            print($session);
            echo "<br>";
            print "Room: ";
            print($room);
            echo "</h3><br>";
            echo "<br>";
            echo "<div style=' padding: 20px; margin:10px;' class='row'>";
            foreach(array_keys($h[$session][$room]) as $subcols){
              echo "<div class='col' style='border:1px solid black;padding: 20px;' >";
              print "Sub Column: ";
              print($subcols + 1);
              echo "<br>";  
              foreach(array_keys($h[$session][$room][$subcols]) as $stud){
                print "   ";
                echo "<br>";  
                if ($h[$session][$room][$subcols][$stud] != null){
                  echo "<div class='' style=' border:1px solid black; ' draggable = 'true'>";
                }
                else{
                  echo "<div>";
                }
                  print($h[$session][$room][$subcols][$stud]);
                  echo "</div>";
              }
              echo "</div>";
            }
            echo "</div></div>";
        } 
        echo "<br>";  
      }
        ?>";
      
      button_submit.onclick = function(){
        rooms.innerHTML="";
        submitted.innerHTML = "<em>Your file has been submitted. Click Generate seating button to generate the seating allocation.</em>";
      };

      button_generate.onclick = function(){
        submitted.innerHTML = "";
        rooms.innerHTML = temp;
        note.innerHTML = "<em>Note that the number of subcolumns belonging to each column is " + subcolumnPerColumn + " respectively, as divided by the borders.<br>(Refer picture in the Edit option in the navigation bar for clarity on terms such as subcolumns)</em>";
      };

      </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  </body>
</html>