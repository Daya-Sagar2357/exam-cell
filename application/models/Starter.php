<?php


//below code is the actual seating algorithm
//could use a ton of optimization in terms of repeated code etc.
//might be better if the whole thing is modularized into separate functions if possible

    class Starter extends CI_Model{

        function seating(){
            $this->load->database();
//$student_entry[0]->ID
//foreach ($query->result_array() as $row)
// {
    // echo $row['title'];
//     echo $row['name'];
//     echo $row['email'];
// }

            $MEGALIST = (array) null;
            $subcols_in_cols = [2, 1, 2];
            $rows_in_subcols = [7, 7, 6, 7, 7];
            //Read values from Edit page to above variables here
            $column_count = count($subcols_in_cols);
            $subcol_count = count($rows_in_subcols);
            $room_capacity = array_sum($rows_in_subcols);
            $i = 0;
            $room_div_1_count = 0;
            $room_div_2_count = 0;
            $room_div_1 = (array) null;
            $room_div_1 = (array) null;
            foreach ($rows_in_subcols as $row){
                if ($i % 2 == 0){
                    $room_div_1_count += $row;
                    $room_div_1[] = $row;
                }
                else{
                    $room_div_2_count += $row;
                    $room_div_2[] = $row;
                }
                $i += 1;
            }           
            $room_nos = $this->db->get('room_details');
            // print_r($room_nos->result()[7]->RoomNo);

            $unique_dates = $this->db->query('select distinct ExamDate from semester_masterlist');
            // print_r($unique_dates->result_array());

            $SESSION = ["FN", "AN"];
            $MEGAMEGALIST = (array) null;

            foreach ($unique_dates->result_array() as $uniq){

                foreach ($SESSION as $sessn){
                    $this->db->query('create temporary table temptab (tmpid int not null AUTO_INCREMENT, PRIMARY KEY(tmpid)) select ExamDate, Session, Course, BranchName, count(StudentName) as 
                    CountStud from semester_masterlist where ExamDate="'.$uniq['ExamDate'].'" and Session="'.$sessn.'" group by ExamDate,Course order by CountStud desc;');
                    // echo "<pre>";
                    $LIST = (array) null;
    
                    $unique_subs = $this->db->query('select distinct Course from temptab');
                    $unique_subs = count($unique_subs->result_array());
                    // print($unique_subs);
                    if ($unique_subs <= 2){
                        $this->db->query('drop temporary table temptab');
                        $this->db->query('create temporary table temptab (tmpid int not null AUTO_INCREMENT, PRIMARY KEY(tmpid)) select ExamDate, Session, Course, BranchName, count(StudentName) as 
                        CountStud from semester_masterlist where ExamDate="'.$uniq['ExamDate'].'" and Session="'.$sessn.'" group by ExamDate,BranchName order by CountStud desc;');
                    }
                    $blah = $this->db->get('temptab');
                    // print_r($blah->result_array());
    
                    $lrow_num = $this->db->query('select count(*) as cnt from temptab'); 
                    $lrow_num = $lrow_num->result()[0]->cnt;  
                    if ($lrow_num != 0){
                        $this->db->query('create temporary table tableA (RegisterNumber varchar(50), StudentName varchar(50), BranchName char(50), Course char(100), ExamDate date, Session enum("FN","AN"))');
                        $this->db->query('create temporary table tableB (RegisterNumber varchar(50), StudentName varchar(50), BranchName char(50), Course char(100), ExamDate date, Session enum("FN","AN"))');
    
                        $row_num = 1;
                        $xm_date = $uniq['ExamDate'];
                        $row_countA = 0;
                        $row_countB = 0;
    
                        while($row_num <= $lrow_num){
                            $sess = $this->db->query("select Session from temptab where tmpid = '$row_num'");
                            $sess = $sess->result()[0]->Session;
                            $br = $this->db->query("select BranchName from temptab where tmpid = '$row_num'");
                            $br = $br->result()[0]->BranchName;
                            $sub = $this->db->query("select Course from temptab where tmpid = '$row_num'");
                            $sub = $sub->result()[0]->Course;
                            $count = $this->db->query("select CountStud from temptab where tmpid = '$row_num'");
                            $count = $count->result()[0]->CountStud;
                            if ($unique_subs <= 2){
                                if ($row_countA <= $row_countB){
                                    $this->db->query("insert into tableA (RegisterNumber, StudentName, BranchName, Course, ExamDate, Session) select  RegisterNumber,StudentName, BranchName, Course, ExamDate, Session from semester_masterlist where semester_masterlist.ExamDate = '$xm_date' and semester_masterlist.Session='$sess' and semester_masterlist.BranchName='$br';");
                                }
                                else {
                                    $this->db->query("insert into tableB (RegisterNumber, StudentName, BranchName, Course, ExamDate, Session) select  RegisterNumber,StudentName, BranchName, Course, ExamDate, Session from semester_masterlist where semester_masterlist.ExamDate = '$xm_date' and semester_masterlist.Session='$sess' and semester_masterlist.BranchName='$br';");
                                }
                            }
                            else {
                                if ($row_countA <= $row_countB){
                                    $this->db->query("insert into tableA (RegisterNumber, StudentName, BranchName, Course, ExamDate, Session) select  RegisterNumber,StudentName, BranchName, Course, ExamDate, Session from semester_masterlist where semester_masterlist.ExamDate = '$xm_date' and semester_masterlist.Session='$sess' and semester_masterlist.Course='$sub';");
                                }
                                else {
                                    $this->db->query("insert into tableB (RegisterNumber, StudentName, BranchName, Course, ExamDate, Session) select  RegisterNumber,StudentName, BranchName, Course, ExamDate, Session from semester_masterlist where semester_masterlist.ExamDate = '$xm_date' and semester_masterlist.Session='$sess' and semester_masterlist.Course='$sub';");
                                }
                            }
                            
                            
                            $row_countA = $this->db->query("select count(*) as cnt from tableA");
    
                            $row_countA = $row_countA->result()[0]->cnt;
                            $row_countB = $this->db->query("select count(*) as cnt from tableB");
                            // print_r($row_countB->result_array());
                            $row_countB = $row_countB->result()[0]->cnt;
                            
                            $row_num += 1;
    
                        }
                        // echo "$row_countA $row_countB";
                        $tblA = $this->db->get('tableA');
                        $tblB = $this->db->get('tableB');
                        // print_r($tblA->result_array());
                        // print_r($tblB->result_array());
                        // print_r($tblA->result_array()[0]['RegisterNumber']);
    
                        if ($row_countA > $row_countB){
                            $minim = $row_countB % $room_capacity;
                        }
                        else{
                            $minim = $row_countA % $room_capacity;
                        }
                        $i = 0;
                        if ($row_countA >= $row_countB){
                            $larger = $tblA;
                            $smaller = $tblB; 
                            $leftoverLarger = $row_countA;
                            $leftoverSmaller = $row_countB;
                        }
                        else{
                            $larger = $tblB;
                            $smaller = $tblA;
                            $leftoverLarger = $row_countB;
                            $leftoverSmaller = $row_countA;
                        }
                        // $leftover = min(array($row_countA, $row_countB));
                        $r = 0;
                        $k = 0;
                        $z = 0;
                        $room_count = 0;
                        
                        while ($leftoverLarger > 0 or $leftoverSmaller > 0){
                            $TEMP = (array) null;
                            $j = 0;
                            if($leftoverSmaller < $leftoverLarger){
                                foreach ($rows_in_subcols as $subcol_length){
                                    $tmp = (array) null;
                                    if ($room_div_1_count > $room_div_2_count){
                                        if ($j % 2 == 0){
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($k,$larger->result_array())){
                                                    $tmp[] = $larger->result_array()[$k]['RegisterNumber'];
                                                    $k += 1;
                                                    $leftoverLarger -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            }
                                        }
                                        else{
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($z,$smaller->result_array())){
                                                    $tmp[] = $smaller->result_array()[$z]['RegisterNumber'];
                                                    $z += 1;
                                                    $leftoverSmaller -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            }
                                        }
                                    }
                                    else{
                                        if ($j % 2 == 0){
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($z,$smaller->result_array())){
                                                    $tmp[] = $smaller->result_array()[$z]['RegisterNumber'];
                                                    $z += 1;
                                                    $leftoverSmaller -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            } 
                                        }
                                        else{
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($k,$larger->result_array())){
                                                    $tmp[] = $larger->result_array()[$k]['RegisterNumber'];
                                                    $k += 1;
                                                    $leftoverLarger -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            }
                                        }
                                    }
                                    $TEMP[] = $tmp;
                                    $j += 1;
                                }
    
                            }
                            else{
                                foreach ($rows_in_subcols as $subcol_length){
                                    $tmp = (array) null;
                                    if ($room_div_1_count > $room_div_2_count){
                                        if ($j % 2 == 0){
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($z,$smaller->result_array())){
                                                    $tmp[] = $smaller->result_array()[$z]['RegisterNumber'];
                                                    $z += 1;
                                                    $leftoverSmaller -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            }
                                        }
                                        else{
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($k,$larger->result_array())){
                                                    $tmp[] = $larger->result_array()[$k]['RegisterNumber'];
                                                    $k += 1;
                                                    $leftoverLarger -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            }
                                        }
                                    }
                                    else{
                                        if ($j % 2 == 0){
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($k,$larger->result_array())){
                                                    $tmp[] = $larger->result_array()[$k]['RegisterNumber'];
                                                    $k += 1;
                                                    $leftoverLarger -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            } 
                                        }
                                        else{
                                            $l = 0;
                                            while ($l < $subcol_length){
                                                if (array_key_exists($z,$smaller->result_array())){
                                                    $tmp[] = $smaller->result_array()[$z]['RegisterNumber'];
                                                    $z += 1;
                                                    $leftoverSmaller -= 1;
                                                }
                                                else $tmp[] = null;
                                                $l += 1;
                                            }
                                        }
                                    }
                                    $TEMP[] = $tmp;
                                    $j += 1;
                                }
                            }
    
                            $room_count += 1;
                            $MEGALIST[$room_nos->result()[$r]->RoomNo] = $TEMP;
                            $r += 1;
                        }
                        $temparray = $uniq['ExamDate']. " " .$sessn;
                        $MEGAMEGALIST[$temparray] = $MEGALIST;
                        $this->db->query('drop table tableA');
                        $this->db->query('drop table tableB');
    
                    }
                    
                    $this->db->query('drop temporary table temptab');
                }
            }
        

            //this is the final allocated seating. 
            //this is passed through to the editing through drag and drop functionality coded in views/pages/seating.php
            return $MEGAMEGALIST;
        }









//anything below this doesn't work. Or at least is questionable.




    // staff duty allocation start
        function dutyAllocation(){
            $this->load->database();
            $roomArray = $this->starter->seating();
           
            $staffAlloc = (array) null;
            $totalDuties = 0;
            //room invigilation duty
            foreach (array_keys($roomArray) as $session) {
                foreach (array_keys($roomArray[$session]) as $room){
                    $totalDuties++;
                }
            }
            //+ no of relieving duties
            $totalDuties = $totalDuties + ceil($totalDuties / 5) ;
            $relievingDuty = ceil($totalDuties / 5);
            // print($totalDuties);
            $totalStaff = $this->db->query('select * from staff_details');
            $totalStaff = count($totalStaff->result_array());

            $countAssistantProf = $this->db->query('select * from staff_details where designation ="Assistant Prof"');
            $countAssistantProf = count($countAssistantProf->result_array());
            // print($countAssistantProf);
            $countAssociateProf = $this->db->query('select * from staff_details where designation ="Associate Prof"'); 
            $countAssociateProf = count($countAssociateProf->result_array());
            // print($countAssociateProf);
            $noOfDutyPerPerson = $totalDuties / $totalStaff;
            // $noOfDutyPerPerson = $totalDuties / 12;
            // print($noOfDutyPerPerson);

            if(ceil($noOfDutyPerPerson) <= $noOfDutyPerPerson){
                $staffAlloc = $this->starter->allocateForBoth($roomArray,$noOfDutyPerPerson,$totalDuties,$relievingDuty);
            }
            else{
                $staffAlloc = $this->starter->allocateByDivision($roomArray,$noOfDutyPerPerson,$totalDuties,$relievingDuty);
            } 
           // echo '<pre>';
            //print_r($staffAlloc);  
            return $staffAlloc;

        }
//staff duty allocation end
        function allocateForBoth($roomArray,$noOfDutyPerPerson,$totalDuties){
            // $this->load->database();
            $result_array = (array) null;
            $DutyAssigned = (array) null; //future reference
            $Professors = $this->db->query('select staffname,emailaddress from staff_details order by designation');
            // echo '<pre>';
            // print_r($assistantProfessor->result_array());
            $cnt = 0;
            $i=0;
            $totalTaken = 0;
            
            foreach (array_keys($roomArray) as $session) {
                foreach (array_keys($roomArray[$session]) as $room){
                    if($cnt != ceil($noOfDutyPerPerson) && $noOfDutyPerPerson >= $totalTaken){
                        $result_array[$session][$room] = $Professors->result_array()[$i];
                        $cnt++;
                    }
                    else{
                        $i++;
                        $result_array[$session][$room] = $Professors->result_array()[$i];
                        $cnt = 1;
                    }
                    $totalTaken++;

                    $DutyAssigned[$i]++;
                    // echo $session." ".$room."<br>";
                }
            }
            return $result_array;
            // echo "<pre>";
            // print_r($result_array);
        }

        function allocateByDivision($roomArray,$noOfDutyPerPerson,$totalDuties){
            $result_array = (array) null;
            $DutyAssigned = (array) null;
            $Professors = $this->db->query('select staffname,emailaddress from staff_details order by designation');
            $countProf = count($Professors->result_array());
            $tempDuty = floor($totalDuties / $countProf);
            $remainDuty = $totalDuties % $countProf;
            $commonDuty = $totalDuties - ($totalDuties % $countProf);
            $Duty = $commonDuty;
            $count = 0;
            $cnt =0;
            $i = 0;
            foreach (array_keys($roomArray) as $session) {
                foreach (array_keys($roomArray[$session]) as $room){
                    if($Duty > 0){
                        if($cnt != $tempDuty){
                            $result_array[$session][$room] = $Professors->result_array()[$i];
                            $cnt++;
                        }
                        else{
                            $i++;
                            $result_array[$session][$room] = $Professors->result_array()[$i];
                            $cnt = 1;
                        }
                        $DutyAssigned[$i] = $cnt;
                        $Duty--;
                    }
                    else{
                        $i = 0;
                        if($remainDuty > 0){
                            $result_array[$session][$room] = $Professors->result_array()[$i];
                            $DutyAssigned[$i]++;
                        }
                        $i++;
                    }
                }
            }
            return $result_array;
            // echo "<pre>";
            // print_r($result_array);
            // print_r($DutyAssigned);
        }
          function data(){
            $this->load->database();
            $branch= $this->db->query('select distinct BranchName from semester_masterlist');
            $b=$branch->result_array();
            return $b;
    }
    
    }