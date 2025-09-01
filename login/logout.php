<?php
session_start();
unset($_SESSION['a']);
session_destroy();
header("Location:../index.php");

?>