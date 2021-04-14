
            <?php
                $desc = $_POST['desc'];
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();

				$query = "SELECT * FROM resolution WHERE type = $desc";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO resolution (type) VALUES ('".$desc."')";
				mysqli_query($con, $query);
				header("Location: resolution.php");
				die();
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('resolution type with this description already exists');
					window.location.replace('resolution.php');
					</SCRIPT>";
				}
			
            ?>
