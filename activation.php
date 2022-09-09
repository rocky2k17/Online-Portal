<?php
	session_start();
	include 'config.php';

	if(isset($_GET['token'])){
		$token = $_GET['token'];
		$query ="UPDATE user_form SET status='active' WHERE token='$token' ";
		$update =mysqli_query($conn,$query);
		if($update){
			if(isset($_SESSION['msg'])){
				$_SESSION['msg'] = "Account Activated";
				header('location:login.php');
			}else{
				$_SESSION['msg'] ="You are logged out";
				header('location:login.php');
			}
		}
		else{
			$_SESSION['msg'] = "Account not Activated";
			header('location:register.php');
		}
	}
?>