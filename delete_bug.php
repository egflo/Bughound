<?php
        $id = $_POST['delid'];
        //Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
		mysqli_select_db($con, "bug_hound");
		$query = "DELETE FROM bugs WHERE problem_report_num = $id";
		mysqli_query($con, $query);
		
		/*
		$query = "DELETE FROM bugs WHERE  = id";
		*/
		header("Location: bug.php");
		die();	
		?>