<style 
 type="text/css">
  * {
  box-sizing: border-box;
}
@media print{
  input#btnPrint{
    display:none ;
  }
}
.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.colum {
  flex: 50%;
  padding: 5px;
}
   table{
border:1px solid black;
border-spacing: 0 80px;
border-collapse:collapse;
border:  1px solid black;

}
th,td{
width: 100 px;
text_align:  center;

border:1px solid black;
}
 </style>
<center><h3> LBS INSTITUTE OF TECHNOLOGY FOR WOMEN </h3></center>
<center><h4> APJ ABDUL KALAM TECHNOLOGICAL UNIVERSITY(APJKTU)</h4></center>
<center><h5> INVIGILATION DUTY LIST</h5></center>
<?php
foreach (array_keys($h) as $session) {
  echo "<b>";
  print "Date and Session: ";
  print($session);
  echo "</b>";
  echo "<br>";
  foreach (array_keys($h[$session]) as $room){
    echo "<br>";
    print "Room:";
    print($room);
    echo "<br>";
    echo "<table>";echo "<tr>";
        foreach(array_keys($h[$session][$room]) as $subcols){
      
          $column=$h[$session][$room][$subcols];
           echo  "<td>$column</td>";  }
           echo "</tr>";
         
      
      echo "</table>";

    }
  }