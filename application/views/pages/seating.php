<link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/sample.css">

<pre>
<div style='margin-left:30px;'><h2 class='container'>Generated Seating</h2>
<p>(Scroll down way below to get a more intuitive idea of the generated seating)</p>

<div class="example-parent">
  <div class="example-origin" id="draggables">
  </div>
</div>

<?php

    echo "<h1>Before editing:</h1>";
    echo "(Here, 'Sub Column' is the Rows 0 to 4 mentioned above)";
    //haven't added 'after editing:' to UI, use js_array_final if needed, for the same.
    //'before editing' was used more or less to get the IDs using getElementById("reg_no") for doing the js stuff
    //refer to that part in the UI (scroll wayyy down) to see get a clearer picture of what exactly will be edited while dragging and dropping the individual reg nos.
  foreach(array_keys($h) as $session){
    foreach(array_keys($h[$session]) as $room){
      echo "<div name='whole' style='border:1px solid black;margin:30px; padding: 20px;'> <br><h3>";
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
//script to enable drag and drop edit through UI to the generated seating

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

//tempAllStud is created to further create tempArray, which is an array of arrays, with each inner array being columns of students
//like ['LBT20CS020', 'LBT20CS021', 'LBT20CS022', 'LBT20CS023', 'LBT20CS024', 'LBT20CS025', 'LBT20CS026'],
// ['LBT20EC020', 'LBT20EC021', 'LBT20EC022', 'LBT20EC023', 'LBT20EC024', 'LBT20EC025', 'LBT20EC026'] and so on, without any other information like session, room etc, for ease of enabling dynamic drag and drop through UI.
//this tempArray is later mapped to js_final_array after each drag and drop in the UI
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
  temp.push(elements.innerHTML);
}
column1 = temp;

let column2 = [];

const draggables = document.getElementById('draggables');

function clear() {
  draggables.innerHTML = "";
}

let colId = 0;
function render() {

//check out the seating_sample.png in img folder for a better idea on what "sub-columns" in UI means
//each array in the final array, as well as in the tempArray, is 'sub-columns'.

var tempCount = 0;
var dropzoneId = [];
let k=0;
let b = 0;

var sessAndRoom = new Array();
for(var x in js_array){
  for(var y in js_array[x]){
      sessAndRoom.push(x.toString().concat("  "+y.toString()))
  }
}

    let ii = 0;
for(let i = 0 ; i < totalColumnCount ; i ++ ){
  let br = document.createElement("div");
  br.innerHTML = "<h4>Sub-column: " + b+"</h4>";
  if(b===0){
    let div2 = document.createElement("div");
    div2.innerHTML = "<h2> "+sessAndRoom[ii]+"</h2>";
    ii+=1;
    draggables.appendChild(div2);
  }
  if(colPerClass===b+1) {
    b = 0;
  }
  else b+=1;
  draggables.appendChild(br);

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
  
  let br2 = document.createElement("br");
  draggables.appendChild(br2);

  tempCount += 1;
  if (tempCount == colPerClass){
    //break into new set of columns
    tempCount = 0;
  }

}  

}

function createDropzone(i,idx) {
  let dropzone = document.createElement("div");
  // dropzone.innerHTML=i.toString()+" "+idx.toString();
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
let js_array_final = {};

js_array_final = js_array;

let m = 0;
for(var x in js_array){
  for(var y in js_array[x]){
      for(var z in js_array[x][y]){
      js_array_final[x][y][z] = tempArray[m];
      m+=1;
      }
  }
}
console.log(js_array_final);

//use this js_array_final to pass to other functions like doc generation, staff allocation etc.
//js_final_array is the final seating at any point in time, including mid-change in UI through drag and drop
//json decode back to php array if necessary

}

render();


</script>

</div>