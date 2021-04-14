<?php
                $id = $_POST['id'];
                $desc = $_POST['desc'];
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				$query = "SELECT * FROM resolution WHERE type = '{$desc}'";
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "UPDATE resolution 
					SET type = '".$desc."'
					WHERE id = $id";
					mysqli_query($con, $query);
					header("Location: resolution.php");
					die();	
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('resolution Type with this description already exists');
					window.location.replace('resolution.php');
					</SCRIPT>";
				}	
			
            ?>