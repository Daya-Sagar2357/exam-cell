
<script>
    //code to get subcolumnPerColumn from edit in navbar page or to get from js variable idk
    $templist = [2, 1, 2];  
</script>
<pre>
<div style='margin-left:30px;'><h2 class='container'>Generated Seating</h2>
<script>
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}
</script>
<?php
        foreach(array_keys($h) as $session){
          foreach(array_keys($h[$session]) as $room){
            echo "<div style='border:1px solid black;margin:30px; padding: 20px;'>";
            echo "<br><h3>";  
            print "Room: ";
            print($room);
            echo "<br>";
            print "Date and Session: ";
            print($session);
            echo "</h3><br>";
            echo "<br>";
            echo "<pre>";
            echo "<div style=' padding: 20px; margin:10px;' class='row'>";
            foreach(array_keys($h[$session][$room]) as $subcols){
              echo "<div ondrop='drop(event)' ondragover='allowDrop(event)' class='col' style='border:1px solid black;padding: 20px;' >";
              print "Sub Column: ";
              print($subcols + 1);
              echo "<br>";  
              foreach(array_keys($h[$session][$room][$subcols]) as $stud){
                print "   ";
                echo "<br>";  
                if ($h[$session][$room][$subcols][$stud] != null){
                  echo "<div id = 'blah' ondragstart='drag(event)' class='' style=' border:1px solid black;' draggable = 'false'>";
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
?>

</div>