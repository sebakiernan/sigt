<?php
session_start(); 
if ($_SESSION["autenticado"] != "si" or $_SESSION["sector"] != 1 or $_SESSION["sistema"] != 4) { 
	session_destroy();
    header("Location:../index.php?error=3"); 
    exit(); 
}
?> 
