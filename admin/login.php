<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <?php include_once __DIR__ . '/model/Admin.php' ?>

    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    include_once 'utils.php';
    if (isLoggedIn()) {
        header("location:index.php");
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SUB RESULT PORTAL - Admin Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="post" name="login">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control"
                               placeholder="Email address"
                               required="required">
                        <label for="inputEmail">Email/User ID</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" id="inputPassword" class="form-control"
                               placeholder="Password"
                               required="required">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember_me" value="remember-me">
                            Remember Password
                        </label>
                    </div>
                </div>
                <input class="btn btn-primary btn-block" type="submit" name="login" value="Login"/>
            </form>
            <?php
            $admin = new Admin();
            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (isset($email) && isset($password)) {
                    $data = $admin->userLogin($email, $password);
//                    print_r($data);
                    if (isset($data) && count($data) > 0) {
                        $_SESSION['isLogged'] = true;
                        $_SESSION['login_user_id'] = $data['id'];
                        header("location:index.php");
                    } else {
                        echo "User Not Found!";
                    }
                } else {
                    echo "User Name Password Field Must be filled.";
                }
            }
            ?>
            <!--<div class="text-center">
                <a class="d-block small mt-3" href="register.php">Register an Account</a>
                <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
            </div>-->
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
