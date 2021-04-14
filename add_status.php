
            <?php
                $desc = $_POST['desc'];
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				$query = "SELECT * FROM status WHERE description = $desc";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO status (description) VALUES ('".$desc."')";
				mysqli_query($con, $query);
				header("Location: status.php");
				die();
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('Status type with this description already exists');
					window.location.replace('status.php');
					</SCRIPT>";
				}
			
            ?>
