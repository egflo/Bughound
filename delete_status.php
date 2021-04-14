<?php
		$id = $_POST['del_id'];
		
        //Connect to Database
		include 'dbConnection.php';	
		$con = Database::getConnection();
		$result = mysqli_query($con, $query);
		
		$query = "DELETE FROM status WHERE id = $id";
		mysqli_query($con, $query);
		
		/*
		$query = "DELETE FROM bugs WHERE  = id";
		*/
		header("Location: status.php");
		die();	
		?>