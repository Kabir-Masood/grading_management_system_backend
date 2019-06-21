<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/CourseRegistration.php';
include_once __DIR__ . '/Classes/PHPExcel.php';
include_once __DIR__ . '/Classes/PHPExcel/IOFactory.php';
//$mCourse_Registration = new CourseRegistration();
// Start the session
session_start();
$courseReg = new CourseRegistration();
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
        <div class="input-group" style="display: none">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search"
                   aria-describedby="basic-addon2">
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
                <li class="breadcrumb-item active">Course Registration</li>
            </ol>


            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Course Registration
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <h2>Course regristration form</h2>
                        <form action="add-course-registration.php" method="post">

                            <div class="form-group">
                                <label for="text">Select Department:</label>
                                <select class="form-group" name="dept_id" id="dept_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select Department
                                    </option>
                                    <?php
                                    $mCourse_Registration = new CourseRegistration();
                                    $deptartments = $mCourse_Registration->get_all_department();
                                    foreach($deptartments as $singleDept){
                                        echo '<option value="'.$singleDept["id"].'" style="background-color: white">'.$singleDept["dept_name"].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="text">Select Batch:</label>
                                <select class="form-group" name="batch_id" id="batch_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select Batch
                                    </option>
                                </select>
                                <!--<label for="text">Choose Semester:</label>
                                <select class="form-group" name="sem_id" id="sem_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select Semester
                                    </option>
                                    <?php
/*                                    $mCourse_Registration = new CourseRegistration();
                                    $semesters = $mCourse_Registration->get_all_semester();
                                    foreach($semesters as $singleSem){
                                        echo '<option value="'.$singleSem["id"].'" style="background-color: white">'.$singleSem["name"].'</option>';
                                    }
                                    */?>
                                </select>-->
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>


                    </div>
                </div>

                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Student List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 50px">Registration</th>
<!--                                <th style="width: 50px">Edit</th>-->
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            if (!empty($_POST)) {
                                $dept_id = htmlentities($_POST['dept_id'], ENT_QUOTES);
                                $batch_id = htmlentities($_POST['batch_id'], ENT_QUOTES);
                                //$sem_id = htmlentities($_POST['sem_id'], ENT_QUOTES);

                                if ($dept_id !== 0 && $batch_id !== 0) {
                                    $students = $courseReg->getStudentByDeptIdAndBatchId($dept_id, $batch_id);
                                    foreach ($students as $student):
                                        echo "<tr>";
                                        echo "<td>" . $student['user_id'] . "</td>";
                                        echo "<td>" . $student['full_name'] . "</td>";
                                        echo '<td><a target="_blank" href="student-course-registration.php?id='. $student["id"] . "&student_name=" . $student["user_id"]. "&batch_id=" . $batch_id."&student_id=" . $student["full_name"]. '" >Registration</a></td>';
//                                        echo "<td><a target='_blank' href='edit-course-registration.php'>" . "Edit". "</a></td>";
                                        echo "</tr>";
                                    endforeach;

                                } else {
                                    echo '<script language="javascript">';
                                    echo 'alert("Please select your choice first.")';
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

                                                $course_id = $item[1];
                                                $student_id = $item[2];
                                                $semester_id = $item[3];
                                                $registration_type = $item[4];
                                                $created_date = date("Y-m-d h:i:sa", time());

                                                $courseReg->save_course_registration($course_id, 0, $student_id, $semester_id, $registration_type, "Admin", $created_date, "null", "null", "null", 1);
                                            }
                                        }

                                        echo '<script language="javascript">';
                                        echo 'alert("Successfully saved!")';
                                        echo '</script>';
                                        header("location:add-course-registration.php");
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
                            </tbody>
                        </table>

                        <br><br>
                        <h2>Upload course registration file from xlsx spreadsheet:</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file"  name="filepath" id="filepath"/></td><td>
                                <input type="submit" name="SubmitButton" value="submit"/>
                        </form>
                        <p style="color: #05a4cf">[N.B]: File must be in .xlsx format and should contain these field(course_id[FK],student_id[FK],semester_id[FK],registration_type)</p>

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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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

<script>
    $("#dept_id").change(function () {

        var id = $(this).val();
        var data = 'id=' + id;
        $.ajax({
            type: "POST",
            url: "ajaxCustom/get_batch_by_dept.php",
            data: data,
            success: function (r) {
                $('#batch_id').html(r);


            }
        });
    });
</script>

</body>

</html>
