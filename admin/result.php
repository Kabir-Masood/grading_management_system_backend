<!DOCTYPE html>
<html lang="en">

<?php
include_once __DIR__ . '/model/Course.php';
include_once __DIR__ . '/model/Teacher.php';
include_once __DIR__ . '/model/Student.php';
include_once __DIR__ . '/model/Result.php';
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Result</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

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
                <li class="breadcrumb-item active">Result</li>
            </ol>

            <!-- Icon Cards-->
            <?php include_once 'common_views/dashboard_data.php'; ?>

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
                    Result list</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student ID</th>
                                <th>Course Code</th>
                                <th>Teacher Name</th>
                                <th>CT marks</th>
                                <th>Mid-term Marks</th>
                                <th>Final marks</th>
                                <th>Attendance marks</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <!--                      <th>Dept</th>-->
                                <!--                      <th>Shift</th>-->
                                <!--                      <th>Batch</th>-->
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Student ID</th>
                                <th>Course Code</th>
                                <th>Teacher Name</th>
                                <th>CT marks</th>
                                <th>Mid-term Marks</th>
                                <th>Final marks</th>
                                <th>Attendance marks</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <!--                        <th>Dept</th>-->
                                <!--                        <th>Shift</th>-->
                                <!--                        <th>Batch</th>-->
                            </tr>
                            </tfoot>

                            <tbody>
                            <?php
                            $mResult = new Result();
                            $mStudent = new Student();
                            $mCourse = new Course();
                            $mTeacher = new Teacher();

                            $results = $mResult->get_all_result();
                            //                  print_r($admins);
                            foreach ($results as $result):
                                echo "<tr>";
                                echo "<td>". $result['id']. "</td>";

                                $studentRow = $mStudent->get_single_student($result['student_id']);
                                if(isset($studentRow)){
                                    $studentID = $studentRow["user_id"];
                                    echo "<td>". $studentID ."</td>";
                                }

                                $courseRow = $mCourse->get_single_course($result['course_id']);
                                if(isset($courseRow)){
                                    $courseCode = $courseRow["course_code"];
                                    echo "<td>". $courseCode ."</td>";
                                }
                                //

                                $teacherRow = $mTeacher->get_single_teacher($result['teacher_id']);
                                if(isset($teacherRow)){
                                    $teacherName = $teacherRow["full_name"];
                                    echo "<td>". $teacherName ."</td>";
                                }

                                echo "<td>" . $result["class_test_marks"] . "</td>";
                                echo "<td>" . $result["mid_term_marks"] . "</td>";
                                echo "<td>" . $result["final_term_marks"] . "</td>";
                                echo "<td>" . $result["attendance_marks"] . "</td>";
                                
                                $encodedIdEdit = $result['id'];
                                echo "<td>". "<a href='edit-result.php?id= $encodedIdEdit'> Edit </a> " . "</td>";
                                echo "<td>". "<a href='delete-result.php?id= $encodedIdEdit'> Delete </a> " . "</td>";
                                echo "</tr>";
                            endforeach; ?>
                            </tbody>
                        </table>
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
<script src="vendor/jquery/jquery.min.js"></script>
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
