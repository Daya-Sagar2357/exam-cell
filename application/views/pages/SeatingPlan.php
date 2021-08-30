 <head>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  </head>
<?php
foreach(array_keys($h) as $session){
          foreach(array_keys($h[$session]) as $room){
            echo "<br>";
            echo "<center><h3> LBS INSTITUTE OF TECHNOLOGY FOR WOMEN </h3></center>";
            echo "<center><h4> APJ ABDUL KALAM TECHNOLOGICAL UNIVERSITY(APJKTU)</h4></center>";
            echo "<center><h4>SEATING PLAN</h4></center>";
            echo "<div style=' border:1px solid black;margin:5px; padding: 10px;'>";
            echo "<br><h5>";  
            print "Date and Session: ";
            print($session);
            echo "<br>";
            print "Room: ";
            print($room);
            echo "</h3><br>";
            echo "<br>";
            echo "<div style=' padding: 10px; margin:5px;' class='row'>";
            foreach(array_keys($h[$session][$room]) as $subcols){
              echo "<div class='col' style='border:1px solid black;padding: 20px;' >";
              print "Row: ";
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
        ?>