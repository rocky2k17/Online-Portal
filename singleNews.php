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
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="styles.css" rel="stylesheet" />
	<link href="index-custom.css" rel="stylesheet" />
	<link href="singleNews.css" rel="stylesheet" />
</head>
<body>
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php"><h2 style="font-family:Time New Roman;color: #1DC4E7;" >Online News Portal</h2></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					
					<li class="nav-item"><a class="nav-link" href="whole_science.php">চাকুরি বিজ্ঞপ্তি</a></li>
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




	<?php

	


	$id=$_POST['id'];

	$sql="SELECT * from news where news_id= '$id' ";
	$query=mysqli_query($conn,$sql);

	while ($info=mysqli_fetch_array($query)) {
		?>
		<div class="content">


				<h3 id="page-title" class="title"><?php echo $info['news_title']; ?></h3>
				<p class="date"><span><?php
				$mydate=getdate(date("U"));
				echo "$mydate[weekday], $mydate[mday] $mydate[month] $mydate[year]";
				?></span> | <span><?php date_default_timezone_set('Asia/Dhaka');  echo date("g:i a"); ?></span></p>



				<figure>
					<img src="news_image/<?php echo $info['img']; ?>" alt="" title="<?php echo $info['news_title']; ?>" class="pic" />
				</figure>


				<div class="article-content">

					<p><?php echo $info['news_content']; ?></p>


				</div>

			</div>

			<?php
		}

		?>




		<div class="cmnt">
			<form action="user_comment.php" method="POST" enctype="multipart/form-data">
				<div  class="docmnt">মন্তব্য করুন</div>

				<p><label for="comment"></label><textarea id="comment" name="comment" placeholder="" aria-required="true"></textarea></p>

				<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="মন্তব্য প্রকাশ করুন" />
				</p></form>	
			</div>

			

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
