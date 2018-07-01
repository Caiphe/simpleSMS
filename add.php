<?php 
    include('links.php');
    include('connect.php');
   

    if(isset($_POST["btn_submit"]))
    {
       $learner_type = htmlspecialchars($_POST["learner_type"]);
       $name = htmlspecialchars($_POST["name"]);
       $surname = htmlspecialchars($_POST["surname"]);
       $student_status = htmlspecialchars($_POST["student_status"]);
       $id_number = htmlspecialchars($_POST["id_number"]);
       $city = htmlspecialchars($_POST["city"]);
       //$dob = htmlspecialchars($_POST["dob"]);
       $physical_address = htmlentities($_POST["physical_address"]);
       $year_of_duty = htmlentities($_POST["year_of_duty"]);


       if(empty($_POST["learner_type"]) || empty($_POST["name"]) || empty($_POST["id_number"]) || empty($_POST["surname"]) || empty($_POST["student_status"]) || empty($_POST["city"]) || empty($_POST["physical_address"]) || empty($_POST["year_of_duty"]))
       {
         $errorMsg = "Oooops!! All fields are required !";
       }
       else
       {
        if(strlen($id_number) != 13 )
          {
            $errorMsg ="13 Digits ID No required";
          }else
          {
            $CheckId =$db_con->query('SELECT * FROM students WHERE id_number = '.$id_number.'');
            $Id_Count = $CheckId->rowCount();

            if($Id_Count > 0)
            {
               $errorMsg = "Ooops!! ID Number Exists Already";
               unset($id_number);
            }
            else
            {
          //A STEP: Summing up all the number at odd position on The ID Number
          $odd_num ='';
          $odd_num =  $id_number[0] + $id_number[2] + $id_number[4] + $id_number[6] + $id_number[8] + $id_number[10];
          //echo "Odd Number ".$odd_num;
          //echo "<br>";

          // B STEP: Concatinatig all  numbers at even position on the ID Number // 
          $evennumber = $id_number[1].$id_number[3].$id_number[5].$id_number[7].$id_number[9].$id_number[11]; 
          //C STEP :  Summing them up
          $sum = 0;
          for($i =0; $i< strlen($evennumber);$i++){
            $sum += $evennumber[$i];
          }
          //echo "The Sum is ".$evennumber." Is ".$sum;
          //echo "<br>";

          //D STEP : Adding A + c
          $stepD = $odd_num + $sum;
          //echo $stepD;

          // E STEP : With the result in (d), separate the second digit from the first digit, and subtract
         //10 from the second digit: 8 - 10 = -2. If the result matches the last digit in the ID
        //number, then the ID number is valid. Hence, the ID number we used is invalid.

          $scnddigit = substr($stepD,1,1);
          //echo "<br>";
          echo $scnddigit;

          // LAST STEP
          $scnddigitM = $scnddigit - 10;
          $myLast = preg_replace('/\D/', '',$scnddigitM);
          //echo $myLast;

          //COMPARING THE LAST DIGIT OF THE ID AND MY DIGIT
          $lastIdDigit = $id_number[12];
          echo $lastIdDigit; 
          //echo "<br><br>";

           if($myLast != $lastIdDigit)
           {
             $errorMsg= "A Valid ID Number is Required";
           }
           else
           {
            
            // Getting Citezenship
             $cit_code = substr($id_number,10,1);
             if($cit_code == 0){
              $citizen = "South African";
             }else{
              $citizen = "Permanent Resident";
             }
            // echo $citizen;
            
              // Get Gender 
              $gender_cod = substr($id_number,6,4);
              if($gender_cod < 4999 ) {
                 $gender = "Female";
              }else {
                 $gender =  "Male";
              }
              //echo $gender;
             
               // Getting the date
              $day = substr($id_number,4,2);

              //Getting the months
              $month_code = substr($id_number,2,2);
              
              switch ($month_code) {
                case '01':
                  $month="Jan";
                  break;
               case '02':
                  $month="Feb";
                  break;
               case '03':
                  $month="March";
                  break;
               case '04':
                  $month="Apr";
                  break;
               case '05':
                  $month="May";
                  break;
               case '06':
                  $month="Jun";
                  break;
               case '07':
                  $month="Jul";
                  break;
               case '08':
                  $month="Aug";
                  break;
               case '09':
                  $month="Sept";
                  break;
               case '10':
                  $month="Oct";
                  break;
               case '11':
                  $month="Nov";
                  break;
               case '12':
                  $month="Dec";
                  break;
               default:
                  $month ="Invalid";
                  break;
              }
              // Geting the Year 
              $year = substr($id_number,0,2);
              if(substr($id_number, 0,1) =="0"){
                $full_year = "20".$year;
              }else
              {
                $full_year = "19".$year;
              }

              $full_dob = $full_year."/".$month."/".$day;

              $year = date("Y");
              $age =  $year - $full_year;

              $sqlInsertData = $db_con->prepare('INSERT INTO students(learner_type,name,surname,age,student_status,id_number,city,date_of_birth,citizenship,gender,address,year_of_duty) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
              $sqlInsertData->execute(array($learner_type,$name,$surname,$age,$student_status,$id_number,$city,$full_dob,$citizen,$gender,$physical_address,$year_of_duty));

              $successMessage = "New student successFully saved";

              unset($name);
              unset($surname);
              unset($id_number);
              unset($year_of_duty);
              unset($physical_address);

              }
             
            }
        }
     }
   }


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>school</title>
  <style type="text/css">
  	
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 <?php include('header.php'); ?>
  <aside class="main-sidebar">
  <?php include('sidebar.php') ?>
  </aside>
  <div class="content-wrapper">

    <section class="content">
      <div class="add_form">
      	<div class="form_content">
      	<h2 style="text-align: center;color:#da7011 ;"><b>ADD NEW STUDENT</b></h2>

      	<div class="form_fields">
          <?php 
            if(isset($errorMsg))
            {
              ?>
              <p class="animated flipInY" id="error_message"><?= $errorMsg ?></p>
              <?php
            }
            
        ?>
      		<form method="POST">
      		   <select class="form-control" name="learner_type" id="learner_type">
      				<option value="">Select Learner Type</option>
      				<option value="Arts Students">Arts student</option>
      				<option value="Tech Students">Tech student</option>
      				<option value="Entrepreneurship student">Entrepreneurship student</option>
      				<option value="HR student">Human resource student</option>
      			</select>
      			 <input type="text" name="name" id="name" placeholder="First Name" class="form-control" value="<?php echo isset($name) ? $name:''; ?>">
      			 <input type="text" name="surname" id="surname" placeholder="Surname" class="form-control" value="<?php echo isset($surname) ? $surname :''; ?>">      		
      			<select class="form-control" name="student_status" id="student_status">
      				<option value="">Student Status</option>
      				<option value="Full time">Full time</option>
      				<option value="Part time">Part Time</option>
      				<option value="Online">Online</option>
      			</select>
      			 <input maxlength="13" type="number" name="id_number" id="id_number" placeholder="Id Number (13 Digits)" class="form-control" value="<?php echo isset($id_number) ? $id_number:''; ?>">
      			 <select class="form-control" name="city" id="city">
      				<option value="">Select City</option>
      				<option value="Durban">Durban</option>
      				<option value="Cape Town">Cape Town</option>
      				<option value="Joburg">Joburg</option>
      				<option value="PMB">PMB</option>
      				<option value="Pretoria">Pretoria</option>
      			</select>
      			 <input type="text" name="physical_address" id="physical_address" placeholder="Physical Address" class="form-control" value="<?php echo isset($physical_address) ? $physical_address:'' ?>">
      			 <input type="text" name="year_of_duty" id="year_of_duty" placeholder="Year of Duty" class="form-control" value="<?php echo isset($year_of_duty) ? $year_of_duty:'' ?>" >
      			 <button type="submit" id="btn_submit" name="btn_submit" ><i class="ionicon ion-ios-plus-outline"></i> Submit</button>
      		</form>
      	</div>
      </div>
  </div>


  <?php 
  if(isset($successMessage))
    {
      ?>
      <div class="animated rotateInDownLeft" id="successF">
         <span class="close" id="close">&times;</span>
        <div id="success_top">
          <p style="" id="success_Title"><i class="ionicon ion-ios-checkmark-outline"></i>&nbsp; Success Message</p>
        </div>
      <div id="inside_success">
        <p style="font-weight: bold;color: #fff;text-align:center;">User Successfully Inserted !!!</p>
      <table style="color: white;font-size: 15px;">
        <tr>
          <td><b>You're a </b>&nbsp;<?php echo $gender ?></td>
        </tr>
         <tr>
          <td><b>You're a</b>&nbsp;<?php echo $citizen ?></td>
        </tr>
        <tr>
          <td><b>Your birthday is on </b>&nbsp;<?php echo $day." "."/"." ".$month; ?></td>
        </tr>
         <tr>
          <td><b>You've entered </b> a valid ID No</td>
        </tr>
      </table>
    </div>
  </div>
      <?php
    }
  ?>
  
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    include('footer.php');
  ?>
  <script type="text/javascript">
  setTimeout('successMessg()',7000);
  function successMessg(){
    $("#successF").fadeOut(2000);
  }
</script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#close").on('click',function(){
       $("#successF").fadeOut(1000);
    })
  </script>
  <script type="text/javascript">
  	/*$(document).ready(function(){
        $("#btn_submit").on('click',function(){
            if($("#learner_type").val() === ""){
            	$("#learner_type").css("border","solid 1px #B80E0E");
            }else{
               $("#learner_type").css("border","solid 1px #43A040 ");
            }

             if($("#name").val() === ""){
            	$("#name").css("border","solid 1px #B80E0E");
            }else{
               $("#name").css("border","solid 1px #43A040 ");
            }

        })
  	})*/
  </script>