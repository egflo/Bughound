<?php
                $name = $_POST['name'];
                $id = $_POST['id'];
				$release = $_POST['rel'];
				$version = $_POST['ver'];
				
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				$query = "SELECT * FROM programs WHERE ProgName = '{$name}' AND Release_build = '{$release}' AND version = '{$version}'";
				

				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "UPDATE programs 
						SET ProgName = '".$name."',
						 Release_build = '".$release."',
						 Version = '".$version."'						
						WHERE ProgID = $id";
					

					mysqli_query($con, $query);
					header("Location: program.php");
					die();		
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('Program with this name already exists');
					window.location.replace('program.php');
					</SCRIPT>";
					}
            ?>