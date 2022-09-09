<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){
		if(isset($_GET['token']))
		{ 
			$token = $_GET['token'];
		    $pass = $_POST['password'];
		    $cpass = $_POST['cpassword'];

		    if($pass != $cpass){
		         $message[] = 'confirm password not matched!';
		      }
		      else{
		      	$query="UPDATE user_form SET password='$cpass' WHERE token='$token'";
		         $update = mysqli_query($conn,$query);
		         if($update)
		         {
		         	$_SESSION['msg'] = "Your password have been updated";
		         	header('location:login.php');
		         }
		         else{
		         	$_SESSION['msg'] = "Failed to update";
		         }

	 
		      }
	  }else{
	  	echo 'No Token Found';
	  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Online News Portal</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
      <h3>Reset Password</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="message"></div>
      <input type="password" name="password" placeholder="create password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <input type="submit" name="submit" value="Update Password" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>
</body>
</html>