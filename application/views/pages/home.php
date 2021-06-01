<html>
    <head>
    </head>
    <body>
       
    <?php 
            class MasterListEntry {
               public $ID;
               public $RegisterNumber;
               public $StudentName;
               public $RegisteredInstitution;
               public $BranchName;
               public $ExamDefinition;
               public $Slot;
               public $Course;
               public $ExamDate;
               public $ExamTime;
               public $Session;

               function __construct($ID, $RegisterNumber, $StudentName, $RegisteredInstitution, $BranchName, $ExamDefinition,  $Slot,  $Course,  $ExamDate, $ExamTime, $Session) {
                  $this->ID = $ID;
                  $this->RegisterNumber = $RegisterNumber;
                  $this->StudentName = $StudentName;
                  $this->RegisteredInstitution = $RegisteredInstitution;
                  $this->BranchName = $BranchName;
                  $this->ExamDefinition = $ExamDefinition;
                  $this->Slot = $Slot;
                  $this->Course = $Course;
                  $this->ExamDate = $ExamDate;
                  $this->ExamTime = $ExamTime;
                  $this->Session = $Session;

               }
               function get_ID() {
                  return $this->ID;
               }
               function get_RegisterNumber() {
                  return $this->RegisterNumber;
               }
               function get_StudentName() {
                  return $this->StudentName;
               }
               function get_RegisteredInstitution() {
                  return $this->RegisteredInstitution;
               }
               function get_BranchName() {
                  return $this->BranchName;
               }
               function get_ExamDefinition() {
                  return $this->ExamDefinition;
               }
               function get_Slot() {
                  return $this->Slot;
               }
               function get_Course() {
                  return $this->Course;
               }
               function get_ExamDate() {
                  return $this->ExamDate;
               }
               function get_ExamTime() {
                  return $this->ExamTime;
               }
               function get_Session() {
                  return $this->Session;
               }

             }
         ?>
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

