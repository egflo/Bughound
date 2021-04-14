<?php
        $id = $_POST['del_id'];
		//Connect to Database
		
		include 'dbConnection.php';	
		$con = Database::getConnection();
		$result = mysqli_query($con, $query);

		mysqli_select_db($con, "bug_hound");
		$query = "DELETE FROM attachment_type WHERE id = $id";
		mysqli_query($con, $query);
		
		/*
		$query = "DELETE FROM bugs WHERE area = id";
		*/
		header("Location: attachment_type.php");
		die();	
		?>