<?php
session_start();
unset($_SESSION['provider']);
header('location: index.php');
?>