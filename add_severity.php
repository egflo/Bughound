
            <?php
				$desc = $_POST['desc'];
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();

				$query = "SELECT * FROM severity WHERE description = $desc";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO severity (description) VALUES ('".$desc."')";
				mysqli_query($con, $query);
				header("Location: severity.php");
				
				die();
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('Severity with this Description already exists');
					window.location.replace('severity.php');
					</SCRIPT>";
				}
			
            ?>
