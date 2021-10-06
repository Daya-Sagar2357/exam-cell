<link rel = "stylesheet" type = "text/css" 
href = "<?php echo base_url(); ?>css/sampletemp.css">
<pre>
<div style='margin-left:30px;'><h2 class='container'>Generated Seating</h2>


<div class="parent">
    <div>
  <div class="origin" id="draggables"></div>
  </div>
</div>

<script>

    
//code to get subcolumnPerColumn from edit in navbar page or to get from js variable idk
$templist = [2, 1, 2]; var colPerClass = 0;
for (var i in $templist) {
    colPerClass += $templist[i];
}

var js_array = <?php echo json_encode($h); ?>;

// const parent = document.getElementById('parent');

const draggables = document.getElementById('draggables');

function render(){
    // Object.entries(js_array).forEach(([sess, room]) => {
    //     Object.entries(room).forEach(([room, col]) => {
    //         Object.entries(col).forEach(([key, ids]) => {
    //             draggables.appendChild(createDropZone(-1));
    //             ids.forEach((col, idx) => {
    //                 let div = document.createElement("div")
    //                 draggables.appendChild(div);
    //                 div.innerHTML = col;
    //                 div.draggable="true";
    //                 div.addEventListener("dragstart", (event) => {
    //                 event
    //                     .dataTransfer
    //                     .setData('text/plain', col);
    //                 console.log("Dragging", col);
    //                 });
    //                 div.setAttribute("class", "dropped-item");
    //                 draggables.appendChild(createDropZone(idx));
    //             });
    //         });
    //     });
    // });
    var roomCount = 0;
    var totalColumnCount = 0;
    var totStudCount = 0;
    Object.entries(js_array).forEach(([sess, room]) => {
        Object.entries(room).forEach(([room, col]) => {
            // console.log(col);
            roomCount += 1;
            Object.entries(col).forEach(([key, ids]) => {
                totalColumnCount += 1;
                // console.log(ids);
                ids.forEach((col, idx) => {
                    totStudCount += 1;
                });
            });
        });
    });
}

function createDropZone(idx){
    let dropzone = document.createElement("div");
    dropzone.setAttribute("class", "dropzone");
    dropzone.setAttribute("style", "background-color:#84b7d1")
    dropzone.addEventListener(
        "dragover",
        (event) => event.preventDefault()
    );
    dropzone.addEventListener(
        "drop",
        (event) => handleDrop(event, idx)
    );
    return dropzone;
}

function handledrop(event, idx){

}

render();

</script>

</div>