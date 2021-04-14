<?php
                $type = $_POST['type'];
	
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();

				$query = "SELECT * FROM attachment_type WHERE type = $type";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO attachment_type (type) VALUES ('".$type."')";
				mysqli_query($con, $query);
				header("Location: attachment_type.php");
				die();		
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('Attachment Type already exists');
					window.location.replace('attachment_type.php');
					</SCRIPT>";
				}
			
?>