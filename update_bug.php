<?php

				//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				mysqli_select_db($con, "bug_hound");
				
				$pr_id = $_POST['pr_id'];
				
				//Check if User wants to upload a file	
				//UPLOAD_ERR_OK Value 0
				if($_FILES['file_upload']['error'] == 0) {
						
					//Copy Of Pr_id
					$problem_report_id = $pr_id;
					
					//Information about the file
					$file = $_FILES['file_upload'];
					$file_name = $file['name'];
					$file_type = $file['type'];
					$file_temp = $file['tmp_name'];
				
					//Create Directory/Location for File
					$directory = "..\\Bughound\\attachments\\";
					$location = $directory.= $problem_report_id.="\\";
				
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
					
					$attach_query = "INSERT INTO `attachments`(`type`, `location`, `problem_report_id`) VALUES ('{$attachment_type}','{$str_replace}','{$pr_id}')";
					
					mysqli_query($con, $attach_query);		
						
				}
				
				//$pr_id = $_POST['pr_id'];		
                $program = $_POST['program'];
                $type = $_POST['type'];
                $severity = $_POST['severity'];
				$summary = $_POST['summary'];
                //$reproduceable = $_POST['reproduceable'];
				$reproduceable = '0';
				if(isset($_POST['reproduceable'])){
					$reproduceable = $_POST['reproduceable'];
				}
                $Problem = $_POST['problem'];
                $fix = $_POST['fix'];
                $rp_by = $_POST['rp_by'];
                $rp_date = $_POST['rp_date'];
                $area = $_POST['area'];
                $assigned_to = $_POST['assigned'];
                $comments = $_POST['commments'];
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $resolution = $_POST['resolution'];
                $res_ver = $_POST['res_ver'];
                $res_by = $_POST['res_by'];
                $res_dt = $_POST['res_dt'];
                $test_by = $_POST['test_by'];
                $test_dt = $_POST['test_dt'];
               // $deferred = $_POST['deferred'];
				
				$deferred = '0';
				if(isset($_POST['deferred'])){
					$deferred = $_POST['deferred'];
				}			   
				
				$summary = str_replace("'","\'",$summary);
				$Problem = str_replace("'","\'",$Problem);
				////Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
				//mysqli_select_db($con, "bug_hound");
				$query = "UPDATE bugs 
					SET 
					program = '".$program."',
					report_type = '".$type."',
					severity = '".$severity."',
					problem_summary = '".$summary."',
					reproduceable = '".$reproduceable."',
					problem = '".$Problem."',
					suggested_fix = '".$fix."',
					reported_by = '".$rp_by."',
					report_date = '".$rp_date."',
					area = '".$area."',
					assigned_to = '".$assigned_to."',
					comments = '".$comments."',
					`status` = '".$status."',
					priority = '".$priority."',
					resolution = '".$resolution."',
					resolution_version = '".$res_ver."',
					resolved_by = '".$res_by."',
					resolved_date = '".$res_dt."',
					tested_by = '".$test_by."',
					tested_date = '".$test_dt."',
					deferred = '".$deferred."'
					WHERE problem_report_num = $pr_id";
				$result = mysqli_query($con, $query);
				
				if (!$result) {
					echo "<SCRIPT type='text/javascript'>
					alert('Unable to Update Bug Report');
					window.location.replace('main.php');
					</SCRIPT>";
				}
				
				header("Location: bug.php");		
			
            ?>