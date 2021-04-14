<?php
                $pr_id = $_POST['pr_id'];
                $ar_id = $_POST['ar_id'];
                $type = $_POST['type'];
                $location = $_POST['location'];
				
				//Connect to Database
				include 'dbConnection.php';	
				$con = Database::getConnection();
				$result = mysqli_query($con, $query);
				
				if(file_exists($location)) {
					mysqli_select_db($con, "bug_hound");
					$query = "UPDATE attachments 
					SET type = '".$type."',
						location = '".$location."',
						pr_id = '".$pr_id."'
					WHERE attachment_report_id = $ar_id";
					mysqli_query($con, $query);
					header("Location: main.php");				
				}
				
				else {
					echo "<SCRIPT type='text/javascript'>
					alert('Location Does Not Exist');
					window.location.replace('attachment.php');
					</SCRIPT>";
														
				}
					
            ?>