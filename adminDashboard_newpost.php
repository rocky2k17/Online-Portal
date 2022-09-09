<?php
session_start();


if(!isset($_SESSION["email"]))
{
	header("location:login.php");
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Online News Portal</title>
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="adminDashboard.css" rel="stylesheet" >
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" >
</head>

<style type="text/css">
		.profile{
		   background-color: var(--white);
		   box-shadow: var(--box-shadow);
		   text-align: center;
		   width: 250px;
		   border-radius: 5px;
			}
			.profile img{
			   height: 150px;
			   width: 150px;
			   border-radius: 50%;
			   object-fit: cover;
			   margin-bottom: 5px;
			}
	</style>

<body>
	<header>
		<div class="left_area"><a href="index.php" style="text-decoration:none;"><h3><span>Online </span>News Portal</h3></a> </div> 
		<div class="right_area"><a href="logout.php" class="logout_btn">Logout</a></div> 

	</header>

	<div class="sidebar">
		<center>
			
				<div class="profile">
				<?php
					include 'config.php';
					$email=$_SESSION["email"];
					$select = mysqli_query($conn, "select * from user_form where email='".$email."' ") or die('query failed');
					if(mysqli_num_rows($select) > 0){
					$fetch = mysqli_fetch_assoc($select);
					}
					if($fetch['image'] == ''){
					echo '<img src="images/default-avatar.png">';
					}else{
					echo '<img src="uploaded_img/'.$fetch['image'].'">';
					}
					?> 
			</div>

			<h4>Admin</h4>
		</center>
		<a href="adminDashboard_profile.php"><i class="fas fa-user"></i><span>Profile</span></a>
		<a href="adminDashboard_myposts.php"><i class="fas fa-table"></i><span>My Posts</span></a>
		<a href="adminDashboard_newpost.php" style="background-color:#3399ff;"><i class="fas fa-file"></i><span>Add New Post</span></a>
		<a href="email.php"><i class="fas fa-mail-bulk"></i><span>Send Mail</span></a>
	</div>
	<div class="content"> 
		<form action="index.php" method="POST" enctype="multipart/form-data" class="frm">
			<fieldset>
				Category Name:
				<select id="category" name="category">
					<option selected>চাকুরি বিজ্ঞপ্তি</option>
					<option>ধর্ম</option>
					<option>খেলা</option> 
				</select>
				<br><br>
				Upload Image:
				<input type="file" id="image" name="image" value="" required><br><br>
				News Title:
				<input type="text" id="title" name="title"><br><br>

  <!--Upload Text File:
  	<input type="file" id="txt" name="txt" value=""><br><br-->
  	<textarea rows="10" cols="75" id="content" name="content">Enter News Content Here...</textarea><br><br>
  	<input type="submit" id="post" name="post" value="Post">

  </fieldset>
</form>

<?php
$ServerName="localhost";
$UserName="root";
$Password="";
$dbName="portal";

$connect=mysqli_connect($ServerName,$UserName,$Password,$dbName);

if (isset($_POST['post'])) {
	$category=$_POST['category'];
	$title=$_POST['title'];
	$content=$_POST['content'];
	$image_name=$_FILES['image']['name'];
	$image_type=$_FILES['image']['type'];
	$image_size=$_FILES['image']['size'];
	$image_tem_loc=$_FILES['image']['tmp_name'];
	$image_store="news_image/".$image_name;
	move_uploaded_file($image_tem_loc,$image_store);
	$email=$_SESSION["email"];


	$sql="INSERT INTO news(category_name, news_title, news_content, img, email) values('$category','$title','$content','$image_name','$email')";

	$query=mysqli_query($connect,$sql);

}


?>
</div>


</body> 
</html>