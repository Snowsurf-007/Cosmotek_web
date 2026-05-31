<?php
session_start();

function logout(){
    session_unset();
    session_destroy();
    header("Location: ../php/index.php");
    exit();
}
logout();
?>