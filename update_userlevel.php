<?php
                $id = $_POST['id'];
                $desc = $_POST['desc'];
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();
				
				$query = "SELECT * FROM userlevel WHERE ULevel = {$id} AND UGroup = '{$desc}'";
				
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "UPDATE userlevel 
						SET UGroup = '".$desc."'
						WHERE ULevel = $id";
					mysqli_query($con, $query);
					header("Location: userlevel.php");
					die();	
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('userlevel Type with this description already exists');
					window.location.replace('userlevel.php');
					</SCRIPT>";
				}	
			
            ?>