
            <?php
				$desc = $_POST['desc'];
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();
				
				$query = "SELECT * FROM reports WHERE type = $desc";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO reports (type) VALUES ('".$desc."')";
				mysqli_query($con, $query);
				header("Location: report.php");
				die();
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('Report type with this description already exists');
					window.location.replace('report.php');
					</SCRIPT>";
				}			
            ?>
