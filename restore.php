<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   $rows = mysqli_num_rows($select);
   if($rows){
      $result = mysqli_fetch_array($select);
      $token = $result['token'];
      $name = $result['name'];
      $subject = "Password Reset";
      $body ="Hi $name. Click here to reset your password http://localhost/reset_pass.php?token=$token";
      $header ="From:hasanurrahman864@gmail.com";
      if (mail($email, $subject, $body, $header)) {
         $_SESSION['msg'] = "Check mail to reset your password";
         header('location:login.php');
      }
      else
      {
         $message[] = 'email sending failed';
      }
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
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <h4 style="font-family: Time New Roman;">Please fill this with your email</h4>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="submit" name="submit" value="Submit" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>