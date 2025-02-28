<?php
session_start();
session_destroy();
header('location:farmer_login.php');
?>