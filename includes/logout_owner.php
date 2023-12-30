<?php 

session_start();
unset($_SESSION['owner']);

header('location: ../login');

?>