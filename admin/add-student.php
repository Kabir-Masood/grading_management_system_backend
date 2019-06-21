<!DOCTYPE html>
<html lang="en">

<?php
include_once __DIR__ . '/model/Student.php';
include_once __DIR__ . '/model/Batch.php';
include_once __DIR__ . '/model/Department.php';
include_once __DIR__ . '/Classes/PHPExcel.php';
include_once __DIR__ . '/Classes/PHPExcel/IOFactory.php';
$mStudent = new Student();
$mBatch = new Batch();
$mDept = new Department();
if (!empty($_POST)) {
    $user_id = htmlentities($_POST['user_id'], ENT_QUOTES);
    $full_name = htmlentities($_POST['full_name'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $user_phone = htmlentities($_POST['user_phone'], ENT_QUOTES);
    $user_password = htmlentities($_POST['user_password'], ENT_QUOTES);
    $batch = htmlentities($_POST['batch_name'], ENT_QUOTES);
    $dept = htmlentities($_POST['dept_id'], ENT_QUOTES);

    if (!empty($full_name) && !empty($user_id) && !empty($email) && !empty($user_phone) && !empty($user_password) && !empty($batch) && $dept !=0) {
        $created_date = date("Y-m-d h:i:sa", time());
        $mStudent->save_student($full_name, $user_id, $email, $user_password, $user_phone, $batch, $dept, 0, 0, "Admin", $created_date, "", "", "", 1);
        header("location:index.php");
    } else {
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

                    $full_name = $item[0];
                    $user_id = $item[1];
                    $email = $item[2];
                    $password = $item[3];
                    $mobile = $item[4];
                    $batch = $item[5];
                    $dept_id = $item[6];
                    $semester_id = $item[7];
                    $program_id = $item[8];
                    $created_date = date("Y-m-d h:i:sa", time());

                    $mStudent->save_student($full_name, $user_id, $email, $password, $mobile, $batch, $dept_id, $semester_id, $program_id, "Admin", $created_date, "null", "null", "null", 1);
                }
            }

            echo '<script language="javascript">';
            echo 'alert("Successfully saved!")';
            echo '</script>';
            header("location:student.php");
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

    <title>SUB Result Portal - Admin Dashboard</title>

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
                <li class="breadcrumb-item active">Add New Student</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Add New Student
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <h2>Student form</h2>
                        <form action="add-student.php" method="post">
                            <div class="form-group">
                                <label for="number">Student ID:</label>
                                <input type="text" class="form-control" id="user_id" placeholder="Enter student ID"
                                       name="user_id">
                            </div>
                            <div class="form-group">
                                <label for="text">Student Name:</label>
                                <input type="text" class="form-control" id="full_name" placeholder="Enter name"
                                       name="full_name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                       name="email">
                            </div>
                            <div class="form-group">
                                <label for="tel">Phone Number:</label>
                                <input type="tel" class="form-control" id="user_phone" placeholder="Enter phone number"
                                       name="user_phone">
                            </div>
                            <div class="form-group">
                                <label for="text">Department:</label>
                                <select class="form-group" name="dept_id" id="dept_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select Department
                                    </option>
                                    <?php
                                    $departments = $mDept->get_all_dept();
                                    foreach($departments as $singleDept){
                                        echo '<option value="'.$singleDept["id"].'" style="background-color: white">'.$singleDept["dept_name"].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">Batch:</label>
                                <select class="form-group" name="batch_id" id="batch_id">
                                    <option value="0" disabled selected="selected"
                                            style="float: left; background-color: white">Select Batch
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="user_password"
                                       placeholder="Enter password" name="user_password">
                            </div>
                            <!--<div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                                </label>
                            </div>-->
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <br><br>
                        <h2>Upload student list from xlsx spreadsheet:</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file"  name="filepath" id="filepath"/></td><td>
                                <input type="submit" name="SubmitButton" class="btn btn-primary" value="submit"/>
                        </form>
                        <p style="color: #05a4cf">[N.B]: File must be in .xlsx format and should contain these field(full_name,user_id,email,password,mobile,batch_id[FK],dept_id[FK],semester_id[FK],program_id[FK])</p>
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
                    <span>Copyright © State University Bangladesh 2018</span>
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
