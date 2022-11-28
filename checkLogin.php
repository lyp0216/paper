<?php
session_start();

if (!isset($_SESSION['managerId'])) {
    header("Location: unlogin.php"); 
}
?>