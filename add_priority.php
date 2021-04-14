
            <?php
				$desc = $_POST['desc'];
				
				 //Connect to Database
				include 'dbConnection.php';		
				$con = Database::getConnection();

				$query = "SELECT * FROM priority WHERE description = $desc";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO priority (description) VALUES ('".$desc."')";
				mysqli_query($con, $query);
				header("Location: priority.php");
				die();
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('priority type with this description already exists');
					window.location.replace('priority.php');
					</SCRIPT>";
				}
			
            ?>
