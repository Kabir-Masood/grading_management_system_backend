<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/model/Course.php';
include_once __DIR__ . '/model/Teacher.php';
include_once __DIR__ . '/model/Department.php';
include_once __DIR__ . '/Classes/PHPExcel.php';
include_once __DIR__ . '/Classes/PHPExcel/IOFactory.php';
$mCourse = new Course();
$mTeacher = new Teacher();
$mDept = new Department();

$id = 0;

if(!empty($_GET)){
    $id = htmlentities($_GET['id'], ENT_QUOTES);
}

if (!empty($_POST)) {
    $id = htmlentities($_POST['id'], ENT_QUOTES);
    $course_name = htmlentities($_POST['course_name'], ENT_QUOTES);
    $course_code = htmlentities($_POST['course_code'], ENT_QUOTES);
    $course_credit = htmlentities($_POST['course_credit'], ENT_QUOTES);
    $teacher_id = htmlentities($_POST['teacher_id'], ENT_QUOTES);
    $dept_id = htmlentities($_POST['dept_id'], ENT_QUOTES);

    //print_r($_POST);

    if (!empty($course_name) && !empty($course_code) && !empty($course_credit) && $teacher_id !== 0 && $dept_id !== 0) {
        $modified_date = date("Y-m-d h:i:sa", time());
        $mCourse->update_course($id, $course_name, $course_code, $course_credit, $teacher_id, $dept_id, "Admin", $modified_date);
        header("location:course.php");
    }else{
        echo '<script language="javascript">';
        echo 'alert("Please insert all data first. ")';
        echo '</script>';
    }
}

/*if (isset($_POST['SubmitButton'])) {
    try {       //attached file formate

        $new_id = 1;
        $up_filename = $_FILES["filepath"]["name"];
        $file_basename = substr($up_filename, 0, strripos($up_filename, '.')); // strip extention
        $file_ext = substr($up_filename, strripos($up_filename, '.')); // strip name
        $f2 = $file_basename . $file_ext;

        $needle = "xlsx";
        if (strpos($f2, $needle) !== false) {
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

                    $course_name = $item[1];
                    $course_code = $item[2];
                    $course_credit = $item[3];
                    $teacher_id = $item[4];
                    $semester_id = $item[5];
                    $dept_id = $item[6];
                    $created_by = $item[7];
                    $created_date = $item[8];
                    $modified_by = $item[9];
                    $modified_date = $item[10];
                    $remarks = $item[11];
                    $is_active = $item[12];

                    $mCourse->save_course($course_name, $course_code, $course_credit, $teacher_id, $semester_id, $dept_id, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active);
                }
            }

            echo '<script language="javascript">';
            echo 'alert("Successfully saved!")';
            echo '</script>';
            header("location:course.php");
        } else {
            echo '<script language="javascript">';
            echo 'alert("Please select a valid xlsx file then try again. ")';
            echo '</script>';
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}*/

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
                <li class="breadcrumb-item active">Edit Course</li>
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
                    Edit Course</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <h2>Course form</h2>
                        <form action="edit-course.php" method="post">

                            <?php
                            if(!empty($_GET)){
                                $id = htmlentities($_GET['id'], ENT_QUOTES);
                            }
                            $courseData = $mCourse->get_single_course($id);
                            ?>

                            <div class="form-group" style="display: none">
                                <label for="number">ID:</label>
                                <input type="text" class="form-control" id="id" placeholder="Enter course ID" name="id" value="<?php echo $courseData['id'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Course Name:</label>
                                <input type="text" class="form-control" id="course_name" placeholder="Enter course name" name="course_name" value="<?php echo $courseData['course_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Course code:</label>
                                <input type="text" class="form-control" id="course_code" placeholder="Enter course code" name="course_code"  value="<?php echo $courseData['course_code'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Course credit:</label>
                                <input type="double" class="form-control" id="course_credit" placeholder="Enter course credit" name="course_credit" value="<?php echo $courseData['course_credit'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="text">Select Department:</label>
                                <select class="form-group" name="dept_id" id="dept_id">
                                    <option value="0" disabled selected="selected" style="background-color: white">Select Department</option>
                                    <?php
                                    $deptartments = $mDept->get_all_dept();
                                    ?>
                                    <?php foreach ($deptartments as $singleDept) {?>
                                    <option <?php if($singleDept['id'] === $courseData['dept_id']){ print "selected='selected'"; } ?>  value="<?php echo $courseData['dept_id'] ?>" style="background-color: white"><?php echo $singleDept['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">Teacher Name:</label>
                                <select class="form-group" name="teacher_id" id="teacher_id">
                                    <option value="0"
                                            style="float: left; background-color: white">Select Teacher
                                    </option>
                                    <?php
                                    $teachers = $mTeacher->get_all_teacher();
                                    ?>
                                    <?php foreach ($teachers as $singleTeacher) {?>
                                        <option <?php if($singleTeacher['id'] === $courseData['teacher_id']){ print "selected='selected'"; } ?>  value="<?php echo $courseData['teacher_id'] ?>" style="background-color: white"><?php echo $singleTeacher['full_name']?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <!--<div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                                </label>
                            </div>-->
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Update</button>

                            <!--<br><br>
                            <h2>Upload course list from xlsx spreadsheet:</h2>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file"  name="filepath" id="filepath"/></td><td>
                                    <input type="submit" name="SubmitButton" value="submit"/>
                            </form>-->
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
