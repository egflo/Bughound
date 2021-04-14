
            <?php
                $name = $_POST['name'];
				$release = $_POST['rel'];
				$version = $_POST['ver'];
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();
				$con = Database::getConnection(); 

				$query = "SELECT * FROM programs WHERE ProgName = '{$name}' AND Release_build = '{$release}' AND version = '{$version}'";
				
				$result = mysqli_query($con, $query);
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					$query = "INSERT INTO `programs`(`ProgName`, `Release_build`, `Version`) VALUES ('{$name}','{$release}','{$version}')";
					mysqli_query($con, $query);
					header("Location: program.php");
					die();		
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('Program with these Fields already exists');
					window.location.replace('program.php');
					</SCRIPT>";
					}	
            ?>
