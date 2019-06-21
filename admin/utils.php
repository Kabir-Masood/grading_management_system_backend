<?php
    session_start();
    
    function isLoggedIn(){
        if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
            return true;
        }
        
        return false;
    }
    
    function logoutUser(){
        if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
            unset($_SESSION['isLogged']);
            unset($_SESSION['login_user']);
            session_destroy();
            header("location:login.php");
        }
    }
?>