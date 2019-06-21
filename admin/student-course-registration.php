<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/CourseRegistration.php';
session_start();
$mCourse = new CourseRegistration();
if(!empty($_SESSION["batch_id"])){
    $id = $_SESSION["id"];
    $batch_id = $_SESSION["batch_id"];
}else{
    $id = $_GET["id"];
    $batch_id = $_GET["batch_id"];
    $_SESSION["id"] = $id;
    $_SESSION["batch_id"] = $batch_id;
}
?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

      <title>SUB RESULT PORTAL - Admin Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
      <script>
          var numRows = 1;
          $(document).on('click', '.add', function () {
              numRows++;
              $data = $("#table-data").html();
              $('#item_table').append("<tr>" + $data + "</tr>");
          });

          $(document).on('click', '.remove', function () {
              if (numRows == 1)
                  return;
              numRows--;
              $(this).parents('tr').remove();
          });

      </script>
      <script>
          alert('hello!');
          $(document).ready(function () {
              $(document).on('click', '.add', function () {
                  alert('click');
                  numRows++;
                  $data = $("#table-data").html();
                  $('#item_table').append("<tr>" + $data + "</tr>");
              });

              $(document).on('click', '.remove', function () {
                  if (numRows == 1)
                      return;
                  numRows--;
                  $(this).parents('tr').remove();
              });

              $('#insert_form').on('submit', function (event) {
                  event.preventDefault();
                  var error = '';
                  $('.course_id').each(function () {
                      var count = 1;
                      if ($(this).val() == '') {
                          error += "<p>Select Course Name " + count + " Row</p>";
                          console.log("Error Happend");
                          return false;
                      }
                      count = count + 1;
                  });

                  $('.sem_id').each(function () {
                      var count = 1;
                      if ($(this).val() == '') {
                          error += "<p>Select Semester " + count + " Row</p>";
                          console.log("Error Happend");
                          return false;
                      }
                      count = count + 1;
                  });

                  $('.registration_type').each(function () {
                      var count = 1;
                      if ($(this).val() == '') {
                          error += "<p>Select Registration Type " + count + " Row</p>";
                          console.log("Error Happend");
                          return false;
                      }
                      count = count + 1;
                  });

                  var form_data = $(this).serialize();
                  if (error == '') {
                      $.ajax({
                          alert("No Error");
                      url: "student-course-registration.php",
                          method: "POST",
                          data: form_data,
                          success: function (data) {
                          if (data == 'ok') {
                              $('#item_table').find("tr:gt(0)").remove();
                              $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                          }
                      }
                  });
                  } else {
                      alert("Error happened");
                      $('#error').html('<div class="alert alert-danger">' + error + '</div>');
                  }
              });

          });
      </script>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">GMS - Grading Management System</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group" style="display: none">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <?php include_once 'common_views/admin_options.php'; ?>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php include_once 'common_views/sidebar_menu.php'; ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Course Registration - </li>
          </ol>

            <!-- Icon Cards-->
<!--            --><?php //include_once 'common_views/dashboard_data.php'; ?>

          <!-- Area Chart Example-->
          <!--<div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>-->

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Course Registration </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <h2>Course registration form -  </h2>
                      <form name="insert_form" id="insert_form" action="student-course-registration.php" method="post">

                          <table class="table table-bordered" id="item_table"
                                 style="width: 100%; height: auto; margin-left: 0px">
                              <tr>
                                  <th style="color: black; text-align: center; font-sie: 15px">Course Name</th>
                                  <th style="color: black; text-align: center; font-sie: 15px">Semester</th>
                                  <th style="color: black; text-align: center; font-size: 15px">Registration Type</th>
                                  <th>
                                      <button type="button" name="add" class="btn btn-success btn-sm add"><span
                                                  class="glyphicon glyphicon-plus">Add</span></button>
                                  </th>
                              </tr>
                              <tr id="table-data">
                                  <td>
                                      <select class="form-control" name="course_id[]" id="course_id" >
                                          <option value="0" disabled selected="selected" style="background-color: white">Select Course</option>
                                          <?php
                                          $mCourse_Registration = new CourseRegistration();
                                          $courses = $mCourse_Registration->get_all_course();
                                          foreach($courses as $course){
                                              echo '<option value="'.$course["id"].'" style="background-color: white">'.$course["course_code"] . " - " . $course["course_name"].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </td>
                                  <td>
                                      <select class="form-control" name="sem_id[]" id="sem_id" >
                                          <option value="0" disabled selected="selected" style="background-color: white">Select Semester</option>
                                          <?php
                                          $mCourse_Registration = new CourseRegistration();
                                          $semesters = $mCourse_Registration->get_all_semester();
                                          foreach($semesters as $semester){
                                              echo '<option value="'.$semester["id"].'" style="background-color: white">'.$semester["semester_name"] . '</option>';
                                          }
                                          ?>
                                      </select>
                                  </td>
                                  <td>
                                      <select class="form-control" name="registration_type[]" id="registration_type" style="width: 100%">
                                          <option value="Regular" style="background-color: white">Regular</option>
                                          <option value="Improve" style="background-color: white">Improve</option>
                                          <option value="Make up" style="background-color: white">Make up</option>
                                      </select>
                                  <td>
                                      <button type="button" class="remove" style="width: 30px; color: black; font-size: 20px">-</button>
                                  </td>
                              </tr>
                          </table>


                          <!--TODO: SEMESTER AND DEPT MIGHT NEED TO ADD HERE-->
                          <button type="reset" class="btn btn-danger">Reset</button>
                          <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>

                          <?php

                          if ((isset($_POST['course_id']) && count($_POST['course_id']) > 0 ) && (isset($_POST['sem_id']) && count($_POST['sem_id']) > 0 ) && (isset($_POST['registration_type']) && count($_POST['registration_type']) > 0 )) {
                              for ($count = 0; $count < count($_POST["course_id"]); $count++) {
                                  $courseID = $_POST['course_id'][$count];
                                  $semesterID = $_POST['sem_id'][$count];
                                  $registrationType = $_POST['registration_type'][$count];

                                  $created_date = date("Y-m-d h:i:sa", time());
                                  $mCourse = new CourseRegistration();

                                  if($mCourse->checkCourseReg($id, $semesterID, $courseID)){
                                      echo '<span style="color:#ff1333;text-align:center;">Course already registered. </span>';
                                  }else{
                                      $mCourse->save_course_registration($courseID, 0, $id, $semesterID, $registrationType, "Admin", $created_date, "", null, "", 1);
                                      unset($_SESSION["id"]);
                                      unset($_SESSION["batch_id"]);

                                      echo "<script>window.close();</script>";
                                  }

                              }
//                              <a href="javascript:history.go(-1)">link text here...</a>
                          // header("location:course-registration.php");
                          }
                          ?>
                      </form>
                  </div>
                </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © State University of Bangladesh 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript-->
<!--    <script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
