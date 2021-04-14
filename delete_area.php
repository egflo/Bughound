<?php
		$id = $_POST['del_id'];
		
        //Connect to Database
		include 'dbConnection.php';	
		$con = Database::getConnection();
		$result = mysqli_query($con, $query);

		$query = "DELETE FROM functional_area WHERE id = $id";
		mysqli_query($con, $query);
		
		/*
		$query = "DELETE FROM bugs WHERE area = id";
		*/
		header("Location: area.php");
		die();	
		?>