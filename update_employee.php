<?php
                $emp_id = $_POST['empid'];
                $name = $_POST['name'];
                $username = $_POST['uname'];
				$password = $_POST['password'];
                $level = $_POST['userlevel'];
				
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();
				$result = mysqli_query($con, $query);

				$query = "SELECT * FROM employee WHERE UName = $username";
				$result = mysqli_query($con, $query);
				if($result == 0){
					$query = "UPDATE employee 
						SET Name = '".$name."',
						Password = '".$password."',
						UName = '".$username."',
						UserLevel = '".$level."'
						WHERE EmpID = $emp_id";
					mysqli_query($con, $query);
					header("Location: employee.php");
				die();
				}
				else{
					echo "<SCRIPT type='text/javascript'>
					alert('Employee with this User Name already exists');
					window.location.replace('employee.php');
					</SCRIPT>";
				}
			
            ?>