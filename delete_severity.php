<?php
        $id = $_POST['del_id'];
        //Connect to Database
		include 'dbConnection.php';	
		$con = Database::getConnection();

		mysqli_select_db($con, "bug_hound");
		$query = "DELETE FROM severity WHERE id = $id";
		mysqli_query($con, $query);
		
		/*
		$query = "DELETE FROM bugs WHERE  = id";
		*/
		header("Location: severity.php");
		die();	
		?>