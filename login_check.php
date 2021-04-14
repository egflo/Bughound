<?php
	include 'dbConnection.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$con = Database::getConnection(); 
			
	$query = "SELECT * FROM `employee` WHERE UName='".$username."' AND Password='".$password."';";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) == 0)
	{ 
		echo "<SCRIPT type='text/javascript'>
			alert('Invalid Username/Password');
			window.location.replace('index.php');
			</SCRIPT>";
		}
	else
	{
		$row = mysqli_fetch_array($result);
		$user_level = $row['UserLevel'];
		echo "<SCRIPT type='text/javascript'>
			alert($user_level);
			</SCRIPT>";
				
			session_start();
			$_SESSION["user_level"] = $user_level;
			$_SESSION["username"] = $username;
			$_SESSION["login"] = true;
				
			header("Location: main.php");
			die();
		}
?>