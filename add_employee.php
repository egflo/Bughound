
            <?php
                $name = $_POST['name'];
                $username = $_POST['username'];
				$password = $_POST['password'];
				$level = $_POST['user_level'];
				
				//Connect to Database
                include 'dbConnection.php';	
                $con = Database::getConnection();

				$query = "SELECT * FROM employee WHERE UName = $username";
				$result = mysqli_query($con, $query);
				if($result == 0){
					$query = "INSERT INTO employee (Name, Password, UName, UserLevel) VALUES ('".$name."','".$password."', '".$username."', '".$level."')";
					mysqli_query($con, $query);

				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('Employee with this User Name already exists');
					window.location.replace('employee.php');
					</SCRIPT>";
				}	

				header("Location: employee.php");
				die();
            ?>
