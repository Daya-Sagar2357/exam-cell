 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form method="" action="seatingarrangement">
    <button>SEATING ARRANGEMENT</button>
</form>
<form method="" action="SeatingPlan">
    <button>SEATING PLAN</button></form>
<form method="" action="questionpaper">
<button>QUESTION PAPER OPENING FORM</button></form>
<form method="" action="invigilationduty">
<button>INVIGILATION DUTY</button></form>

<br>
<?php
/*foreach (array_keys($h) as $session) {
  print "Date and Session: ";
  print($session);
  echo "<br>";
  foreach (array_keys($h[$session]) as $room){
        echo "<br>";
      print "Room:";
    print($room);
    echo "<br>";
    foreach (array_keys($h[$session][$room]) as $subcols){
      print("Row");
      print($subcols);
      echo "<table>";
      foreach (array_keys($h[$session][$room][$subcols]) as $stud)
      {
        echo "<tr>";
         $column=json_encode($h[$session][$room][$subcols][$stud]);

         echo  "<td>$column</td>";
          echo "</tr>";
      }
      echo "</table>";

    }

  }
 }*/
?>
</body>
</html>