<?php 
    include('links.php');
    include('connect.php');

     $getArt = $db_con->query("SELECT * FROM students WHERE learner_type ='Arts Students' ORDER BY date_time DESC");
     $countArt = $getArt->rowCount();
     if($countArt > 0){
       $countArt = $countArt;
     }else{
         $countArt = 0;
     }

     $getEntr = $db_con->query("SELECT * FROM students WHERE learner_type ='Entrepreneurship student' ORDER BY date_time DESC");
     $countEntr = $getEntr->rowCount();
     if($countEntr > 0){
       $countEntr = $countEntr;
     }else{
         $countEntr = 0;
     }

     $getHR = $db_con->query("SELECT * FROM students WHERE learner_type ='HR student' ORDER BY date_time DESC");
     $countHR = $getHR->rowCount();
     if($countHR > 0){
       $countHR = $countHR;
     }else{
         $countHR = 0;
     }

     $getTech = $db_con->query("SELECT * FROM students WHERE learner_type ='Tech Students' ORDER BY date_time DESC");
     $countTech = $getTech->rowCount();
     if($countTech > 0){
       $countTech = $countTech;
     }else{
         $countTech = 0;
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
    <section class="content-header">
      <h1>
        <b>Dashboard</b></h1>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $countArt; ?></h3>
              <p>Arts student</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="artStudents.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $countTech; ?><sup style="font-size: 20px"></sup></h3>

              <p>Tech students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="techStudents.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $countEntr; ?></h3>

              <p>Entrepreneur students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="entrepStudents.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $countHR; ?></h3>
             <p>HR student</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="HRStudents.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    include('footer.php');
  ?>