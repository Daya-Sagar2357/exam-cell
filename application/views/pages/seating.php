<link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/sample.css">

<pre>
<div style='margin-left:30px;'><h2 class='container'>Generated Seating</h2>

<div class="example-parent">
  <div class="example-origin" id="draggables">
  </div>

  <!-- <div
    class="example-dropzone"
    id="droppables"
  >
  </div> -->
</div>

<?php

    // foreach(array_keys($h) as $session){
    //   foreach(array_keys($h[$session]) as $room){
    //     foreach(array_keys($h[$session][$room]) as $subcols){
    //       foreach(array_keys($h[$session][$room][$subcols]) as $stud){
    //           echo "<div>";
    //           print($h[$session][$room][$subcols][$stud]);
    //           echo "</div>";
    //       }
    //       echo "<br>";
    //     }
    //   }    
    // }

  foreach(array_keys($h) as $session){
    foreach(array_keys($h[$session]) as $room){
      echo "<div style='border:1px solid black;margin:30px; padding: 20px;'> <br><h3>";
      print "Room: ";
      print($room);
      echo "<br>";
      print "Date and Session: ";
      print($session);
      echo "</h3><br> <br> <pre> <div style=' padding: 20px; margin:10px;' class='row'>";
      foreach(array_keys($h[$session][$room]) as $subcols){
        echo "<div id = 'cols' class='col' style='border:1px solid black;padding: 20px;' >";
        print "Sub Column: ";
        print($subcols + 1);
        echo "<br>";  
        foreach(array_keys($h[$session][$room][$subcols]) as $stud){
          print "   ";
          echo "<br>";  
          if ($h[$session][$room][$subcols][$stud] != null){
            echo "<div name = 'reg_no' class='' style=' border:1px solid black;' >";
          }
          else{
            echo "<div>";
          }
            print ($h[$session][$room][$subcols][$stud]);
            echo "</div>";
        }
        echo "</div>";
      }
      echo "</div></div>";
    } 
  echo "<br>"; 
  }

?>

<script>

var colPerClass = 0;
var js_array = <?php echo json_encode($h); ?>;
//code to get subcolumnPerColumn from edit in navbar page or to get from js variable idk
$templist = [2, 1, 2];  
for (var i in $templist) {
    colPerClass += $templist[i];
}

var roomCount = 0;
var colLengths =new Array();
var tempAllStud = new Array();
var totalColumnCount = 0;
var totStudCount = 0;
  Object.entries(js_array).forEach(([sess, room]) => {
      Object.entries(room).forEach(([room, col]) => {
          // console.log(col);
          roomCount += 1;
          Object.entries(col).forEach(([key, ids]) => {
              totalColumnCount += 1;
              colLengths.push(ids.length);
              ids.forEach((col, idx) => {
                  totStudCount += 1;
                  tempAllStud.push(col);
              });
          });
      });
  });

var tempArray = new Array();
for ( let i = 0 ; i < totalColumnCount ; i ++) {
  tempArray[i] = new Array();
}
var k = 0;
for ( let i = 0 ; i < totalColumnCount ; i ++) {
  for (let j = 0 ; j < colLengths[i] ; j ++ ){
      tempArray[i][j] = tempAllStud[k];
      k += 1;
  }
}
// console.log(tempArray);


// let column1 = ['Hi', 'quick', 'brown', 'fox'];
let temp = [];
let column1 = document.getElementsByName('reg_no');
var iterator = column1.values();
for (let elements of iterator) {
  // console.log(elements.innerHTML);
  temp.push(elements.innerHTML);
}
column1 = temp;

let column2 = [];

const draggables = document.getElementById('draggables');
// const droppables = document.getElementById('droppables');

function clear() {
  draggables.innerHTML = "";
  // droppables.innerHTML = "";
}

let colId = 0;
function render() {

  //add code to convert tempArray back to megalist format $h[$session][$room][$subcols][$stud]

var tempCount = 0;
var dropzoneId = [];
let k=0;
for(let i = 0 ; i < totalColumnCount ; i ++ ){
  //add them into colPerClass number of columns
  draggables.appendChild(createDropzone(k, 0, colId));
  k+=1;
  tempArray[i].forEach((col, idx) => {
    let div = document.createElement("div")
    draggables.appendChild(div);
    div.innerHTML = col;
    div.draggable="true";
    div.addEventListener("dragstart", (event) => {
      event
        .dataTransfer
        .setData('text/plain', col);
      console.log("Dragging", col, i, idx);
      colId = i;
    });
    div.setAttribute("class", "dropped-item");
    draggables.appendChild(createDropzone(i,idx+1));
  });
  let br = document.createElement("br");
  draggables.appendChild(br);
  tempCount += 1;
  if (tempCount == colPerClass){
    //break into new set of columns
    tempCount = 0;
  }

}  

}

function createDropzone(i,idx) {
  let dropzone = document.createElement("div");
  dropzone.innerHTML=i.toString()+" "+idx.toString();
  dropzone.setAttribute("class", "dropzone");
  dropzone.setAttribute("style", "background-color:#e2f2bd")
  dropzone.setAttribute("id",i.toString()+" "+idx.toString());
  dropzone.addEventListener(
    "dragover",
    (event) => event.preventDefault()
  );
  dropzone.addEventListener(
    "drop",
    (event) => handleDrop(event, i,idx)
  );
  // document.write("<br>");
  return dropzone;
}

function handleDrop(event, i,idx) {
  var col = event.dataTransfer.getData('text');

  let index = -1;

  for(let j = 0 ; j < tempArray[colId].length; j ++){
    if (tempArray[colId][j]===col) index = j;
  }

  if(tempArray[colId][index]==null) return;

  tempArray[colId] = tempArray[colId].filter(c => c !== col);

  if(idx===0){
    tempArray[i] = [
    col,
    ...tempArray[i].slice(idx)
  ];
  }
  else{
    if(colId===i){
      if(idx>index){
        tempArray[i] = [
        ...tempArray[i].slice(0, idx-1),
        col,
        ...tempArray[i].slice(idx-1)
        ];
      }
      else{
          tempArray[i] = [
          ...tempArray[i].slice(0, idx),
          col,
          ...tempArray[i].slice(idx)
          ];
      }

    }
    else{
      tempArray[i] = [
      ...tempArray[i].slice(0, idx),
      col,
      ...tempArray[i].slice(idx)
      ];
    }

  }

  clear();
  render();

//code to map tempArray to megalist format to json decode back to php array


}

render();


</script>

</div>