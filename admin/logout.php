<?php
    session_start();

if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
    unset($_SESSION['isLogged']);
    unset($_SESSION['login_user']);
    header("location:login.php");
    echo 'Session destroyed. ';
    session_destroy();
}
 /*   function logoutUser(){
        if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
            unset($_SESSION['isLogged']);
            unset($_SESSION['login_user']);
            header("location:index.php");
            echo 'Session destroyed. ';
            session_destroy();
        }
    }*/
?>