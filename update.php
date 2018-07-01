<?php 
    include('links.php');
    include('connect.php');

    if(isset($_GET['id']) AND !empty($_GET["id"]))
    {
  	  $getid = intval($_GET['id']);
  	  $getid = htmlspecialchars($_GET["id"]);
  	  $getStudentData = $db_con->prepare("SELECT * FROM students WHERE id = ?");
  	  $getStudentData->execute(array($getid));
    }

    if(isset($_POST["btn_submit"]))
    {
       $learner_type = htmlspecialchars($_POST["learner_type"]);
       $name = htmlspecialchars($_POST["name"]);
       $surname = htmlspecialchars($_POST["surname"]);
       $student_status = htmlspecialchars($_POST["student_status"]);
       $city = htmlspecialchars($_POST["city"]);
       $physical_address = htmlentities($_POST["physical_address"]);
       $year_of_duty = htmlentities($_POST["year_of_duty"]);

       if(empty($_POST["learner_type"]) || empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["student_status"]) || empty($_POST["city"]) || empty($_POST["physical_address"]) || empty($_POST["year_of_duty"]))
       {
         $errorMsg = "Oooops!! All fields are required !";
       }else
       {
       	 $GetDataUpdate = $db_con->query("SELECT * FROM students WHERE id ='".$getid."'");
       	 $get = $GetDataUpdate->fetch();

       	 if($get["learner_type"] == $_POST["learner_type"] && $get["name"] == $_POST["name"] && $get["surname"] && $get["student_status"] == $_POST["student_status"] && $get["city"] == $_POST["city"] && $get["address"] == $_POST["physical_address"] && $get["year_of_duty"] == $_POST["year_of_duty"])
       	 {
             $errorMsg = "You did not make any change";
       	 }else
       	 {
       	 	$sqlUpdate = $db_con->prepare('UPDATE students SET learner_type = ? ,name = ?,surname = ? ,student_status =?, city = ?,address  = ? , year_of_duty = ?  WHERE id="'.$getid.'" ');
            $sqlUpdate->execute(array($learner_type,$name,$surname,$student_status,$city,$physical_address,$year_of_duty));

            $successMessage = "Successfully updated";
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
      	<h2 style="text-align: center;color:#da7011 ;"><b> UPDATE STUDENT </b></h2>

      	<?php 
          while($rows = $getStudentData->fetch())
         {
       	 ?>
      	<div class="form_fields">
      		<?php 
            if(isset($errorMsg))
            {
              ?>
              <p class="animated flipInY" id="error_message"><i class="ionicon ion-alert"></i> <?= $errorMsg ?></p>
              <?php
            }
             if(isset($successMessage))
            {
              ?>
              <p class="w3-animate-zoom" id="success_Message_update"><i class="ionicon ion-ios-checkmark-outline"></i> <?= $successMessage ?></p>
              <?php
            }
            
        ?>
      		<form method="POST">
      		
      		   <select class="form-control" name="learner_type" id="learner_type">
      				<option value="">Select Learner Type</option>
      				<option value="Arts Students"
                     <?php 
                       if($rows["learner_type"] == "Arts Students"){
                       	echo "selected";
                       }
                     ?>
      				>Arts student</option>
      				<option value="Tech Students"
      					<?php 
                       if($rows["learner_type"] == "Tech Students"){
                       	echo "selected";
                       }
                     ?>

      				>Tech student</option>
      				<option value="Entrepreneurship student"
                     <?php 
                       if($rows["learner_type"] == "Entrepreneurship student"){
                       	echo "selected";
                       }
                     ?>
      				>Entrepreneurship student</option>
      				<option value="HR student"
      					<?php 
                       if($rows["learner_type"] == "HR student"){
                       	echo "selected";
                       }
                     ?>

      				>Human resource student</option>
      			</select>
      			 <input type="text" name="name" id="name" class="form-control" value="<?php echo $rows["name"];?>">
      			 <input type="text" name="surname" id="surname" placeholder="Surname" class="form-control" value="<?php echo $rows["surname"];?>">      		
      			<select class="form-control" name="student_status" id="student_status">
      				<option value="">Student Status</option>
      				<option value="Full time" 
      				<?php if($rows["student_status"] == "Full time"){
                        echo "selected";
      				}

      				?>

      				>Full time</option>
      				<option value="Part time" 
      				<?php if($rows["student_status"] == "Part time"){
                        echo "selected";
      				}

      				?>
      				>Part Time</option>
      				<option value="Online" 
                    <?php if($rows["student_status"] == "Online"){
                        echo "selected";
      				}

      				?>
      				>Online</option>
      			</select>
      			 <select class="form-control" name="city" id="city">
      				<option value="">Select City</option>
      				<option value="Durban"
                     <?php if($rows["city"] == "Durban"){
                        echo "selected";
      				}
      				?>
      				>Durban</option>
                      
      				<option value="Cape Town"
                      <?php if($rows["city"] == "Cape Town"){
                        echo "selected";
      				}
      				?>
      				>Cape Town</option>
      				<option value="Joburg"
                       <?php if($rows["city"] == "Joburg"){
                        echo "selected";
      				}
      				?>
      				>Joburg</option>
      				<option value="PMB"
                      <?php if($rows["city"] == "PMB"){
                        echo "selected";
      				}
      				?>
      				>PMB</option>
      				<option value="Pretoria"
                     <?php if($rows["city"] == "Pretoria"){
                        echo "selected";
      				}
      				?>
      				>Pretoria</option>
      			</select>
      			 <input type="text" name="physical_address" id="physical_address" placeholder="Physical Address" class="form-control" value="<?php echo $rows["address"];?>">
      			 <input type="text" name="year_of_duty" id="year_of_duty" class="form-control" value="<?php echo $rows["year_of_duty"];?>" >
      			 <button type="submit" id="btn_submit" name="btn_submit" > <i class="ionicon ion-ios-compose-outline"></i> Update</button>
      		</form>
      		
      	</div>
      	<?php 
         }
      	?>
      </div>
  </div>


  

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    include('footer.php');
  ?>
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