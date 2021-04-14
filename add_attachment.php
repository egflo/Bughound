
            <?php
                $type = $_POST['type'];
                $location = $_POST['location'];
                $pr_id = $_POST['pr_id'];
				$con = Database::getConnection(); 
				mysqli_select_db($con, "bug_hound");
				$query = "INSERT INTO attachments (type, location, problem_report_id) VALUES ('".$type."','".$location."','".$pr_id."')";
				mysqli_query($con, $query);
				header("Location: bug.php");
				die();		
			
            ?>
