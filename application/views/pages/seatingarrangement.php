<html>
<head>
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
</head>
<body>
<div id="Print">
<center><h2> LBS INSTITUTE OF TECHNOLOGY FOR WOMEN </h1></center>
<center><h3> APJ ABDUL KALAM TECHNOLOGICAL UNIVERSITY(APJKTU)</h2></center>
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
    echo "<table>";
    echo "<tr>";
         $column=json_encode($h[$session][$room]);
          print  "<td>$column</td>";
          echo "</tr>";
      
      echo "</table>";

    }
    
  echo "<br>";
  }
/*$b=array();
foreach ($g as $m) {
  foreach($m as $u)
    array_push($b, $u);
}
foreach ($b as $j) {
  
    foreach (array_keys($h) as $session) {
      $d=array();
      foreach (array_keys($h[$session]) as $room){
      foreach (array_keys($h[$session][$room]) as $stud)
      {   $i=json_encode($j);
       $column=json_encode($h[$session][$room]);
       print_r($column);
        if(strpos($column, $j)!= false)
          array_push($d, $column);
          print_r($d);

      }
        }}}*/

?>
</div>
<form></form><input  type="button" id="btnPrint" onclick="window.print()" value="Print"></button></form>
</body>
</html>
