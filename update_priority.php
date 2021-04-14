<?php
                $id = $_POST['id'];
                $desc = $_POST['desc'];
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				
				$query = "SELECT * FROM priority WHERE description = '{$desc}'";
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "UPDATE priority 
					SET description = '".$desc."'
					WHERE id = $id";
					
					mysqli_query($con, $query);
					header("Location: priority.php");
					die();	
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('priority Type with this description already exists');
					window.location.replace('priority.php');
					</SCRIPT>";
				}	
			
            ?>