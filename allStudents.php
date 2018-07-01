<?php 
    include('links.php');
    include('connect.php');
    include('DataTableLinks.php');

    $getData = $db_con->query("SELECT * FROM students ORDER BY date_time DESC");
    $count = $getData->rowCount();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <b>All Students</b></h1>
      </h1>
      <br>
    </section>
    <div style="background: white;">
      <div class="box">
            <!-- /.box-header -->
      <div class="box-body">
      <table class="table table-bordered table-responsive" id="example1" class="example1">
        <thead>
           <tr>
             <th>Type</th>
             <th>Name</th>
             <th>Surname</th>
             <th>Age</th>
             <th>Status</th>
             <th>ID Number</th>
             <th>D.O.B</th>
             <th>CityZenship</th>
             <th>Gender</th>
             <th>City</th>
             <th>Address</th>
             <th>Year </th>
             <th>Edit</th>
             <th>Delete</th>
           </tr>
        </thead>
      
        <?php 
         if($count > 0)
         {
            while($row = $getData->fetch())
            {
              ?>
            <tr>
              <td><?= $row["learner_type"]?></td>
              <td><?= $row["name"]?></td>
              <td><?= $row["surname"]?></td>
              <td><?= $row["age"]?></td>
              <td><?= $row["student_status"]?></td>
              <td><?= $row["id_number"]?></td>
              <td><?= $row["date_of_birth"]?></td>
              <td><?= $row["citizenship"]?></td>
              <td><?= $row["gender"]?></td>
              <td><?= $row["city"]?></td>
              <td><?= $row["address"]?></td>
              <td><?= $row["year_of_duty"]?></td>
              <td><a href=update.php?id=<?php echo $row["id"]?> class="btn btn-success"><i class="ionicon ion-ios-compose"></i> Edit</a></td>
              <td><a href=delete.php?id=<?php echo $row["id"]?> class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Post?')"><i class="ionicon ion-ios-trash"></i> Del</a></td>
            </tr>

              <?php
            }
          }
        ?>
       
      </table>
    </div>
  </div>
</div>
</div>
  <!-- /.content-wrapper -->
  <?php 
    include('footer.php');
  ?>

<!-- DataTables 
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->


<script>
  /*$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


<?php  include('DataTableLinks.php')?>

  <script type="text/javascript">
  $(document).ready(function() {
    $('#example1').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );
</script>


<script>
// Get the modal
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>