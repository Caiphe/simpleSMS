<?php 
   if(isset($_POST["submit"]))
   {
   	  $id_number = htmlentities($_POST["id_number"]);
      
     
      //A STEP: Summing up all the number at odd position on The ID Number
   	  $odd_num ='';
   	  $odd_num =  $id_number[0] + $id_number[2] + $id_number[4] + $id_number[6] + $id_number[8] + $id_number[10] + $id_number[12];
   	  //echo "Odd Number ".$odd_num;
   	  //echo "<br>";

   	  // B STEP: Concatinatig all  numbers at even position on the ID Number // 
      $evennumber = $id_number[1].$id_number[3].$id_number[5].$id_number[7].$id_number[9].$id_number[11]; 
      //C STEP :  Summing them up
      $sum = 0;
      for($i =0; $i< strlen($evennumber);$i++){
      	$sum += $evennumber[$i];
      }
      echo "The Sum is ".$evennumber." Is ".$sum;
      //echo "<br>";

      //D STEP : Adding A + c
      $stepD = $odd_num + $sum;
      //echo $stepD;

      // E STEP : With the result in (d), separate the second digit from the first digit, and subtract
     //10 from the second digit: 8 - 10 = -2. If the result matches the last digit in the ID
    //number, then the ID number is valid. Hence, the ID number we used is invalid.

      $scnddigit = substr($stepD,1,1);
      //echo "<br>";
      //echo $scnddigit;

      // LAST STEP
      $scnddigitM = $scnddigit - 10;
      $myLast = preg_replace('/\D/', '',$scnddigitM);
      echo "<br>".$myLast;

      //COMPARING THE LAST DIGIT OF THE ID AND MY DIGIT
      $lastIdDigit = $id_number[12];
      echo "<br>".$lastIdDigit; 
      echo "<br><br>";

       if($myLast != $lastIdDigit)
       {
         echo "Fake ID Number";
       	  echo "<br><br>";
       	
       }else
       {
       	   echo " You have a great ID Number ";
       }

     // Getting Citezenship
   	 $cit_code = substr($id_number,10,1);
   	 if($cit_code == 0){
   	 	$citizen = "South African";
   	 }else{
   	 	$citizen = "Permanent Resident";
   	 }
   	 //echo $citizen;
   	
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
      if($id_number = substr($id_number, 0,1) =="0"){
        $full_year = "20".$year;
      }else
      {
      	$full_year = "19".$year;
      }
      $full_dob = $full_year."/".$month."/".$day;
      //echo $full_dob;

      $year = date("Y");
      echo $year - $full_year;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		input
		{
			width: 400px;
			height: 30px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<form method="POST">
		<input type="text" name="id_number" maxlength="13" id="id_number" value=""><br>
		<input type="text" name="dob" id="dob" disabled="" value="<?php echo isset($full_dob) ? $full_dob:''?>"><br>
		<button type="submit" id="submit" name="submit" >SUBMIT</button>
	</form>
</body>
</html>