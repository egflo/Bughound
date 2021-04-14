
            <?php
				$prog_ID = $_POST['program'];
                $name = $_POST['name'];
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();
				
				$query = "SELECT * FROM functional_area WHERE name = {$name} AND program_id = {$prog_ID}";
				$result = mysqli_query($con, $query);
								
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0)
				{
					$query = "INSERT INTO functional_area (name, program_id) VALUES ('".$name."','".$prog_ID."')";
					mysqli_query($con, $query);
					header("Location: area.php");
				}
				else
				{
					echo "<SCRIPT type='text/javascript'>
					alert('Area with this name already exists with this Program');
					window.location.replace('area.php');
					</SCRIPT>";
				}
			
            ?>
