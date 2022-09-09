<?php

session_start();
include 'config.php';

if(!isset($_SESSION["email"]))
{
	//echo '<script>alert("Please..Login first")</script>';
	header("location:login.php");
	exit;
}


$nid=$_POST['id'];


if (isset($_POST['submit'])) {
	$cmnt_content=$_POST['comment'];
	$sql="INSERT INTO comment(comment_content,news_id) values('$cmnt_content','$nid')";

	$query=mysqli_query($conn,$sql);

}


?>