<?php
                $AreaID = $_POST['AreaID'];
                $name = $_POST['name'];
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				$query = "SELECT * FROM functional_area WHERE name = '{$name}'";
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "UPDATE functional_area 
					SET Name = '".$name."'
					WHERE id = $AreaID";
					mysqli_query($con, $query);
					header("Location: area.php");
					die();	
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('Area with this name already exists');
					window.location.replace('area.php');
					</SCRIPT>";
				}	
			
            ?>