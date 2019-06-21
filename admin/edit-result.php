<!DOCTYPE html>
<html lang="en">

<?php
include_once __DIR__ . '/model/Result.php';
include_once __DIR__ . '/model/Student.php';
include_once __DIR__ . '/model/Teacher.php';
include_once __DIR__ . '/model/Course.php';
include_once __DIR__ . '/Classes/PHPExcel.php';
include_once __DIR__ . '/Classes/PHPExcel/IOFactory.php';
$mResult = new Result();
$mStudent = new Student();
$mTeacher = new Teacher();
$mCourse = new Course();

$id = 0;

if(!empty($_GET)){
    $id = htmlentities($_GET['id'], ENT_QUOTES);
}

if (!empty($_POST)) {
    $id = htmlentities($_POST['id'], ENT_QUOTES);
    $class_test = htmlentities($_POST['class_test'], ENT_QUOTES);
    $mid_term = htmlentities($_POST['mid_term'], ENT_QUOTES);
    $final = htmlentities($_POST['final'], ENT_QUOTES);
    $attendance = htmlentities($_POST['attendance'], ENT_QUOTES);

    if (!empty($class_test) && !empty($mid_term) && !empty($final) && !empty($attendance)) {
        $modified_date = date("Y-m-d h:i:sa", time());

        $mResult->update_student_result($id, $class_test, $mid_term, $final, $attendance, "Admin", $modified_date);
        header("location:result.php");
    }else{
        echo '<script language="javascript">';
        echo 'alert("Please insert all data first. ")';
        echo '</script>';
    }
}

if(isset($_POST['SubmitButton'])){
    try {       //attached file formate

        $new_id = 1;
        $up_filename=$_FILES["filepath"]["name"];
        $file_basename = substr($up_filename, 0, strripos($up_filename, '.')); // strip extention
        $file_ext = substr($up_filename, strripos($up_filename, '.')); // strip name
        $f2 = $file_basename . $file_ext;

        $needle = "xlsx";
        if( strpos( $f2, $needle ) !== false) {
            move_uploaded_file($_FILES["filepath"]["tmp_name"], $f2);

            $inputFileName = $f2;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file"' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }
//  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $rowData = array();
            for ($row = 2; $row <= $highestRow; $row++) {
                //  Read a row of data into an array
                $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);
            }

//print_r($rowData);
//echo $rowData[0][0][1];

            foreach ($rowData as $datum) {
                foreach ($datum as $item) {

                    $student_id = $item[1];
                    $course_id = $item[2];
                    $teacher_id = $item[3];
                    $class_test_marks = $item[4];
                    $mid_term_marks = $item[5];
                    $final_term_marks = $item[6];
                    $attendance_marks = $item[7];
                    $created_date = date("Y-m-d h:i:sa", time());

                    $mResult->save_result($student_id, $course_id, $teacher_id, $class_test_marks, $mid_term_marks, $final_term_marks, $attendance_marks, 0, 0, 0, 0, "Admin", $created_date, "null", "null", "null", 1);
                }
            }

            echo '<script language="javascript">';
            echo 'alert("Successfully saved!")';
            echo '</script>';
            header("location:result.php");
        }else{
            echo '<script language="javascript">';
            echo 'alert("Please select a valid xlsx file then try again. ")';
            echo '</script>';
        }
    }
    catch(Exception $e) {
        $error_message = $e->getMessage();
    }
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

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">GMS - Grading Management System</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group" style="display: none;">
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
                <li class="breadcrumb-item active">Edit Result</li>
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
                    Edit Student Result</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <h2>Result Editing form</h2>
                        <form action="edit-result.php" method="post">

                        <?php
                          if(!empty($_GET)){
                              $id = htmlentities($_GET['id'], ENT_QUOTES);
                          }
                            $resultData = $mResult->get_single_result($id);
                          ?>

                            <div class="form-group" style="display: none">
                                <label for="text">Student ID:</label>
                                <select class="form-group" name="user_id" id="user_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select student ID
                                    </option>
                                </select>
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="text">Select Course Code:</label>
                                <select class="form-group" name="course_id" id="course_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select course code
                                    </option>
                                </select>
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="text">Select Teacher Name:</label>
                                <select class="form-group" name="teacher_id" id="teacher_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select teacher name
                                    </option>
                                    <?php
                                    $teachers = $mTeacher->get_all_teacher();
                                    foreach($teachers as $singleTeacher){
                                        echo '<option value="'.$singleTeacher["id"].'" style="background-color: white">'.$singleTeacher["full_name"].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">Class test:</label>
                                <input type="double" class="form-control" id="class_test" placeholder="Enter CT marks" name="class_test" value="<?php echo $resultData['class_test_marks']?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Mid term:</label>
                                <input type="double" class="form-control" id="mid_term" placeholder="Enter mid_term marks" name="mid_term" value="<?php echo $resultData['mid_term_marks']?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Final:</label>
                                <input type="double" class="form-control" id="final" placeholder="Enter final marks" name="final" value="<?php echo $resultData['final_term_marks']?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Attendance:</label>
                                <input type="double" class="form-control" id="attendance" placeholder="Enter attendance marks" name="attendance" value="<?php echo $resultData['attendance_marks']?>">
                            </div>

                            <!--<div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                                </label>
                            </div>-->
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <br><br>
                            <h2>Upload admin list from xlsx spreadsheet:</h2>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file"  name="filepath" id="filepath"/></td><td>
                                    <input type="submit" name="SubmitButton" value="submit"/>
                            </form>
                            <p style="color: #05a4cf">[N.B]: File must be in .xlsx format and should contain these field(student_id[FK], course_id[FK], teacher_id[FK], class_test_marks, mid_term_marks, final_term_marks, attendance_marks)</p>
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
