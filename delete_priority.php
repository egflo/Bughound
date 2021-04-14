<?php
        $id = $_POST['del_id'];
        //Connect to Database
		include 'dbConnection.php';		
		$con = Database::getConnection();

		$query = "DELETE FROM priority WHERE id = $id";
		mysqli_query($con, $query);
		
		/*
		$query = "DELETE FROM bugs WHERE  = id";
		*/
		header("Location: priority.php");
		die();	
?>