<?php
ob_start(); //Turns on output buffering 
session_start();

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "justvisi_soc_pro", "D,*M}^(&2~01", "justvisi_social_project"); //Connection variable
mysqli_set_charset($con,"utf8");


if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>