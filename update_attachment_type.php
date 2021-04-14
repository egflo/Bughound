<?php
                $id = $_POST['id'];
                $type = $_POST['type'];
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				$query = "SELECT * FROM attachment_type WHERE type = '{$type}'";
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "UPDATE attachment_type 
						SET type = '".$type."'
						WHERE id = $id";
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