<?php
	$bug_id = $_POST['bug_id'];
	
	$location = "../Bughound/bug_exports/{$bug_id}.txt";
	
	$directory = "../Bughound/bug_exports/";
	if(!file_exists($directory))
	{
		mkdir("../Bughound/bug_exports/");
	}

	//Connect to Database
	include 'dbConnection.php';	
	$con = Database::getConnection();
	$result = mysqli_query($con, $query);

	$query = "SELECT * from bugs WHERE problem_report_num = {$bug_id}";
	$result = mysqli_query($con, $query);
		
	$row = mysqli_fetch_array($result);

	//Program
	$program_id =  $row['program'];	
	$query = "SELECT * from programs WHERE ProgID = {$program_id}";
	$result = mysqli_query($con, $query);	
	
	$row_program = mysqli_fetch_array($result);
	
	//Report Type
	$report_id = $row['report_type'];
	$query = "SELECT * from reports WHERE id = {$report_id}";
	$result = mysqli_query($con, $query);
	
	$row_reports = mysqli_fetch_array($result);
	
	//severity
	$severity_id = $row['severity'];
	$query = "SELECT * from severity WHERE id = {$severity_id}";
	$result = mysqli_query($con, $query);
	
	$row_severity = mysqli_fetch_array($result);
	
	//Reported By
	$reported_by_id = $row['reported_by'];
	$query = "SELECT * from employee WHERE EmpID = {$reported_by_id}";
	$result = mysqli_query($con, $query);
	
	$row_reported_by = mysqli_fetch_array($result);
	
	
	//area
	$area_id = $row['area'];
	$query = "SELECT * from functional_area WHERE program_id = {$program_id}";
	$result = mysqli_query($con, $query);
	
	$row_area = mysqli_fetch_array($result);
	
	
	//Assigned To
	$assigned_to_id = $row['assigned_to'];
	$query = "SELECT * from employee WHERE EmpID = {$assigned_to_id}";
	$result = mysqli_query($con, $query);
	
	$row_assigned_to = mysqli_fetch_array($result);
	
	//Status
	$status_id = $row['status'];
	$query = "SELECT * from status WHERE id = {$status_id}";
	$result = mysqli_query($con, $query);
	
	$row_status = mysqli_fetch_array($result);
	
	//priority
	$priority_id = $row['priority'];
	$query = "SELECT * from priority WHERE id = {$priority_id}";
	$result = mysqli_query($con, $query);
	
	$row_priority = mysqli_fetch_array($result);
	
	//resolution
	$resolution_id = $row['resolution'];
	$query = "SELECT * from resolution WHERE id = {$priority_id}";
	$result = mysqli_query($con, $query);
	
	$row_resolution = mysqli_fetch_array($result);	
	
	//resolved_by
	$resolved_by_id = $row['resolved_by'];
	$query = "SELECT * from employee WHERE EmpID = {$reported_by_id}";
	$result = mysqli_query($con, $query);
	
	$row_resolved_by = mysqli_fetch_array($result);	
	
	//tested_by
	$tested_by_id = $row['tested_by'];
	$query = "SELECT * from employee WHERE EmpID = {$tested_by_id}";
	$result = mysqli_query($con, $query);
	
	$row_tested_by = mysqli_fetch_array($result);	
	
	//Attachments
	$query = "SELECT * from attachments WHERE problem_report_id = {$row['problem_report_num']}";
	$result_attach = mysqli_query($con, $query);
	
	
	$file = fopen("$location", "w");
	
	$txt = sprintf("problem_report_num: %s  \n", $row['problem_report_num']);			
	fwrite($file, $txt)	;
	
	$txt = sprintf("Program: %s (%s,%s) \n", $row_program['ProgName'],$row_program['Release_build'],$row_program['Version']);			
	fwrite($file, $txt);
	
	$txt = sprintf("Report Type: %s  \n", $row_reports['type']);			
	fwrite($file, $txt);
	
	$txt = sprintf("severity: %s  \n", $row_severity['description']);			
	fwrite($file, $txt);
	
	$txt = sprintf("problem_summary: %s  \n", $row['problem_summary']);			
	fwrite($file, $txt);
	
	$txt = sprintf("reproduceable: %s  \n", ($row['reproduceable'] == "1" ? "Yes" : "No"));			
	fwrite($file, $txt);
	
	$txt = sprintf("problem: %s  \n", $row['problem']);			
	fwrite($file, $txt);
	
	$txt = sprintf("suggested_fix: %s  \n", $row['suggested_fix']);			
	fwrite($file, $txt);

	$txt = sprintf("reported_by: %s  \n", $row_reported_by['Name']);			
	fwrite($file, $txt);

	$txt = sprintf("report_date: %s  \n", $row['report_date']);			
	fwrite($file, $txt);
	
	$txt = sprintf("area: %s  \n", $row_area['name']);			
	fwrite($file, $txt);

	$txt = sprintf("assigned_to: %s  \n", $row_assigned_to['Name']);			
	fwrite($file, $txt);	

	$txt = sprintf("comments: %s  \n", $row['comments']);			
	fwrite($file, $txt);

	$txt = sprintf("status: %s  \n", $row_status['description']);			
	fwrite($file, $txt);
	
	$txt = sprintf("priority: %s  \n", $row_priority['description']);			
	fwrite($file, $txt);

	$txt = sprintf("resolution: %s  \n", $row_resolution['type']);			
	fwrite($file, $txt);	

	$txt = sprintf("resolution_version: %s  \n", $row['resolution_version']);			
	fwrite($file, $txt);

	$txt = sprintf("resolved_by: %s  \n", $row_resolved_by['Name']);			
	fwrite($file, $txt);	

	$txt = sprintf("resolved_date: %s  \n", $row['resolved_date']);			
	fwrite($file, $txt);	

	$txt = sprintf("tested_by: %s  \n", $row_tested_by['Name']);			
	fwrite($file, $txt);

	$txt = sprintf("tested_date: %s  \n", $row['tested_date']);			
	fwrite($file, $txt);

	$txt = sprintf("deferred: %s  \n", ($row['deferred'] == "1" ? "Yes" : "No"));							
	fwrite($file, $txt);
	
	while($row_attachments=mysqli_fetch_row($result_attach)) {
		$txt = sprintf("Attachment: %s  \n", $row_attachments[1]);								
		fwrite($file, $txt);
	}
	
	fclose($file);

	header("Content-Type: application/octet-stream");
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-Disposition: attachment; filename=\"" . basename($location) . "\"");
	header("Content-Length: " . filesize($location));
	readfile($location); 
	header("Connection: close");

	//$str_replace = str_replace("\\","/",$location);
	//echo "<SCRIPT type='text/javascript'>
	//	alert('Bug Export File Located At: {$location}');
	//	window.location.replace('main.php');
	//	</SCRIPT>";
		

?>