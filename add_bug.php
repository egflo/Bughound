
            <?php
			
				include 'dbConnection.php';	
				$con = Database::getConnection();
				
				//Check if User wants to upload a file	
				//UPLOAD_ERR_OK Value 0
				if($_FILES['file_upload']['error'] == 0) {
						
					$query = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'bug_hound' AND TABLE_NAME = 'bugs'";
					$result = mysqli_query($con, $query);
				
					$row = mysqli_fetch_array($result);
					//The Bug ID that will be assigned to this Bug Report
					$next_value = $row['AUTO_INCREMENT'];
				
					//Information about the file
					$file = $_FILES['file_upload'];
					$file_name = $file['name'];
					$file_type = $file['type'];
					$file_temp = $file['tmp_name'];
				
					//Create Directory/Location for File
					$directory = "..\\Bughound\\attachments\\";
					$bug_id = $next_value;
					$location = $directory.= $next_value.="\\";
				
					if(!file_exists($location)){
						mkdir($location);
					}
							
					//Move File to Location
					$full_location = $location.= $file_name;
					move_uploaded_file($file_temp,$full_location);
					
					//Create Query for the File
					$attachment_type = '2';
					if($file_type == "image/png"){
						$attachment_type = '3';
					}

					if($file_type == "text/plain"){
						$attachment_type = '5';
					}
					
					$str_replace = str_replace("\\","/",$location);
					
					$attach_query = "INSERT INTO `attachments`(`type`, `location`, `problem_report_id`) VALUES ('{$attachment_type}','{$str_replace}','{$bug_id}')";
					mysqli_query($con, $attach_query);		
						
				}
			
				
                $program = $_POST['program'];
                $type = $_POST['type'];
                $severity = $_POST['severity'];
				$summary = $_POST['summary'];

				$reproduceable = '0';
				if(isset($_POST['reproduceable'])){
					$reproduceable = $_POST['reproduceable'];
				}
				
                $Problem = $_POST['problem'];
                $fix = $_POST['fix'];
                $rp_by = $_POST['rp_by'];
                $rp_date = $_POST['rp_date'];
                $area = $_POST['area'];
                $aggigned = $_POST['assigned'];
                $comments = $_POST['commments'];
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $resolution = $_POST['resolution'];
                $res_ver = $_POST['res_ver'];
                $res_by = $_POST['res_by'];
                $res_dt = $_POST['res_dt'];
                $test_by = $_POST['test_by'];
                $test_dt = $_POST['test_dt'];
				
				$deferred = '0';
				if(isset($_POST['deferred'])){
					$deferred = $_POST['deferred'];
				}
				$summary = str_replace("'","\'",$summary);
				$problem = str_replace("'","\'",$problem);
				
				$query = "INSERT INTO bugs 
					(program,
					report_type,
					severity,
					problem_summary,
					reproduceable,
					problem,
					suggested_fix,
					reported_by,
					report_date,
					area,
					assigned_to,
					comments,
					status,
					priority,
					resolution,
					resolution_version,
					resolved_by,
					resolved_date,
					tested_by,
					tested_date,
					deferred) 
					VALUES 
					('".$program."',
					'".$type."',
					'".$severity."',
					'".$summary."',
					'".$reproduceable."',
					'".$Problem."',
					'".$fix."',
					'".$rp_by."',
					'".$rp_date."',
					'".$area."',
					'".$aggigned."',
					'".$comments."',
					'".$status."',
					'".$priority."',
					'".$resolution."',
					'".$res_ver."',
					'".$res_by."',
					'".$res_dt."',
					'".$test_by."',
					'".$test_dt."',
					'".$deferred."'
					)";
				mysqli_query($con, $query);
				header("Location: bug.php");
				die();		
			
            ?>
