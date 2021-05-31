<html>
    <head>
    </head>
    <body>
        Allocate seats.
        <table border="1">  
      <tbody>  
         <tr>  
            <td>ID</td>  
            <td>RegisterNumber</td>
            <td>StudentName</td>  
            <td>RegisteredInstitution</td> 
            <td>BranchName</td> 
            <td>ExamDefinition</td> 
            <td>Slot</td> 
            <td>Course</td> 
            <td>ExamDate</td> 
            <td>ExamTime</td> 
            <td>Session</td> 
         </tr>  
         <?php  
         foreach ($h->result() as $row)  
         {  
            ?><tr>  
            <td><?= $row->ID;?></td>  
            <td><?= $row->RegisterNumber;?></td>
            <td><?= $row->StudentName;?></td>   
            <td><?= $row->RegisteredInstitution;?></td> 
            <td><?= $row->BranchName;?></td> 
            <td><?= $row->ExamDefinition;?></td> 
            <td><?= $row->Slot;?></td> 
            <td><?= $row->Course;?></td> 
            <td><?= $row->ExamDate;?></td> 
            <td><?= $row->ExamTime;?></td> 
            <td><?= $row->Session;?></td>
            </tr>  
         <?php }  
         ?>  
      </tbody>  
   </table>
    </body>
</html>

