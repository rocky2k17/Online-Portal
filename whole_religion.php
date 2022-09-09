<?php
session_start();
include 'config.php';
/*
if(!isset($_SESSION["email"]))
{
	header("location:index.php");
}
*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Online News Portal</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="favicon.ico" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="styles.css" rel="stylesheet" />
	<link href="index-custom.css" rel="stylesheet" />
</head>
<body>
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php"><h2 style="font-family:Time New Roman;color: #1DC4E7;" >Online News Portal</h2></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					<!--li class="nav-item"><a class="nav-link" href="whole_kuet.php">কুয়েট সম্পর্কিত</a></li-->
					<li class="nav-item"><a class="nav-link" href="whole_science.php">বিজ্ঞান</a></li>
					<li class="nav-item"><a class="nav-link" href="whole_religion.php">ধর্ম</a></li>
					<li class="nav-item"><a class="nav-link" href="whole_sports.php">খেলা</a></li>
					<!--li class="nav-item"><a class="nav-link" href="whole_opinion.php">মতামত</a></li-->
					<li class="line">|</li>
					<li class="nav-item">
						<?php
						include 'config.php';
						if($conn===false)
						{
							die("connection error");
						}

						if(isset($_SESSION["email"]))
						{
							$email=$_SESSION["email"];
							$sql="select * from user_form where email='".$email."'  ";
							$result=mysqli_query($conn,$sql);
							$total_rows=mysqli_num_rows($result);

							if($total_rows>0)
							{

								while($row=mysqli_fetch_assoc($result))
								{
									//echo $row['email'];

									if($row["role"]=="user")
									{	
										?>
										<a class="nav-link" href="userDashboard_profile.php"><?php echo $_SESSION["email"] ?></a>
										<?php

										//$_SESSION["email"]=$email;

										//header("location:userDashboard_profile.php");
									}

									elseif($row["role"]=="admin")
									{
										?>
										<a class="nav-link" href="adminDashboard_profile.php"><?php echo $_SESSION["email"] ?></a>
										<?php
										//$_SESSION["email"]=$email;

										//header("location:adminDashboard_profile.php");
									}


								}
							}

						}	

						else
						{
							?>
							<a class="nav-link" href="login.php">লগ ইন/সাইন আপ</a>
							<?php
						}
						?>
					</li>


				</ul>
			</div>
		</div>
	</nav>
	<!-- Page Content-->






	<section class="main-div">
		<div class="container">
			<div class="category-part">
				<h3><a href="whole_religion.php">ধর্ম</a></h3>
			</div>
			<div class="row">




				<?php
					

				$sql="select * from news where category_name='ধর্ম' order by news_id desc";
				$query=mysqli_query($conn,$sql);

				while($info=mysqli_fetch_assoc($query)){
					?>

					<div class="col-md-3">
						<div class="sub-div">
							<form class="" action="singleNews.php" method="POST">
								<input type="text" name="id" value="<?php echo $info['news_id']; ?>" hidden>
								<input type="image" src="news_image/<?php echo $info['img']; ?>" alt="Read in detail" width="255" height="155">
							</form>
								<!--img src="news_image/<?php echo $info['img']; ?>" alt="Image"-->
								<h2><?php echo $info['news_title']; ?></h2>
								<p><?php echo $info['news_content']; ?></p> 
						</div>
					</div>
						
					<?php

					}

					?>					

				</div>

			</div>
		</section>






		<!-- Footer-->
		<footer class="py-5 bg-dark">
		<div class="container m-0 text-center text-white"><p>Editor: Searching Now(Apply Now)</p><span>Writings and Pictures of this website<br>are fully preserved by us with copyright <br>Any kind of disclosure is punishable by law |<br></span><br><p>Copyright &copy; Online News Portal 2022</p>
		</div>
	</footer>
		<!-- Bootstrap core JS-->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
		<!-- Core theme JS-->
		<script src="js/scripts.js"></script>
	</body>
	</html>
