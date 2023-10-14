<?php session_start(); 
header("Location: ".$_SERVER['HTTP_REFERER']."");
unset($_SESSION['carrito']);
?>