<?php

include 'config.php';
session_start();

if(isset($_SESSION["email"]))
{
	header("location:index.php");
}


if($conn===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST["email"];
	$password=$_POST["password"];


	$sql1="select * from user_form where email='".$email."' AND password='".$password."' ";
	$result=mysqli_query($conn,$sql1);
	$total_rows=mysqli_num_rows($result);

	if($total_rows>0)
	{

		while($row=mysqli_fetch_assoc($result)){
			echo $row['email'];

			if($row["role"]=="user" && $row["status"] =="active")
			{	

				$_SESSION["email"]=$email;
				setcookie("user", $email, time() + (86400 * 7), "/");

				header("location:index.php");
			}

			elseif($row["role"]=="admin" && $row["status"] =="active")
			{

				$_SESSION["email"]=$email;
				setcookie("admin", $email, time() + (86400 * 7), "/");

				header("location:index.php");
			}

			else
			{
				echo '<script>alert("Incorrect email or password.")</script>';
				header('location:login.php');
			}
		}
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--style > 
<?php include 'login.css'; ?>
</style-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Online News Portal</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<!-- Core theme CSS (includes Bootstrap)-->
<!-- <link type="text/css" href="css/style.css" rel="stylesheet" /> -->
<link type="text/css" href="login.css" rel="stylesheet" />

</head>
<body>
	<div class="logInform">
		<form class="forom" action="login.php" method="post">
  <!--div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
</div-->
<div><h2 style="text-align:center; text-transform: uppercase;"><a style="text-decoration: none;color:#55bc00 ;" href="#">Online News Portal</a></h2></div>
<div class="container">
	<div style=" margin:10px 0;
   width: 100%;
   border-radius: 5px;
   padding:10px;
   text-align: center;
   background-color:red;
   color:var(--white);
   font-size: 20px;"><?php 

      if(isset($_SESSION['msg'])){
         echo $_SESSION['msg'];
         } 
       ?>
     </div>
	<label for="email"><b>Email</b></label>
	<input type="email" placeholder="Enter Email" name="email" id="email" required>

	<label for="password"><b>Password</b></label>
	<input type="password" placeholder="Enter Password" name="password" id="password" required>

	<button type="submit">Login</button>
    <!--label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
  </label-->
</div>

<div style="text-align:center;margin: 10px; display:flex;">
	<p style="font-family: Time New Roman;font-size: 20px;">Dont't have an account?
		<a style="text-decoration:none; font-family: Time New Roman;color:red; font-weight: bold; font-size: 20px;float: right;" href="signup.php">Create Account</a>

	</p>
</div>
<div style="text-align:center;margin: 10px; display:flex;">
	<p style="">Forgot Password?Don't Worry.
		<a style="text-decoration:none; font-family: Time New Roman;color:red; font-weight: bold; font-size: 20px;" href="recover.php">Forgot Password</a>

	</p>
</div>
</form>
</div>
<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="scripts.js"></script>

</body>
</html>


