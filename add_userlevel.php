
            <?php
                $desc = $_POST['desc'];
				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				$query = "SELECT * FROM userlevel WHERE UGroup = $desc";
				$result = mysqli_query($con, $query);
				if($result == 0){
				$query = "INSERT INTO userlevel (UGroup) VALUES ('".$desc."')";
				mysqli_query($con, $query);
				header("Location: userlevel.php");
				die();
				}else{
					echo "<SCRIPT type='text/javascript'>
					alert('userlevel type with this description already exists');
					window.location.replace('userlevel.php');
					</SCRIPT>";
				}
			
            ?>
