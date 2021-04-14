<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Report Search Results</title>
		<table id = "logout_user">
			<tr>
				<?php
					include 'validate_user.php';		
					isLoggedIn();
					$username = $_SESSION["username"];
					echo "<th>User: {$username}</th>";
				?>
				<th><input type="button" onclick="window.location.href = 'logout.php';" value="Logout" id="logout"/></th>
			</tr>
		</table>		
    </head>
    <body style="background-color: #E5E7E9;">
        <h1>Bug Report Search Results</h1>

<?php
	$status = $_POST['status'];
	
	//$query = "SELECT * FROM `bugs` WHERE `status` = '{$status}'"; 
	$query = "SELECT b.problem_report_num, b.program, b.problem_summary, p.ProgName, p.Release_build, p.Version, b.report_type, r.type, b.severity, s.description AS 'severity_des', sat.description AS 'status', e.EmpID, e.Name AS 'employee_name'
		FROM bugs AS b
		INNER JOIN programs AS p
			ON b.program = p.ProgID
		INNER JOIN reports AS r
			ON b.report_type = r.id
		INNER JOIN severity AS s
			ON b.severity = s.id
		INNER JOIN `status` AS sat
			ON b.status = sat.id
		INNER JOIN employee AS e
			ON e.EmpID = b.reported_by
		WHERE `status` = '{$status}'";;
	
	if(!empty($_POST['program'])) {
		$program_id = $_POST['program'];
		$program_query = " AND `program` = '{$program_id}'";
		
		$query.= $program_query;
	}

	if(!empty($_POST['report_type'])) {
		$report_type = $_POST['report_type'];
		$report_query = " AND `report_type` = '{$report_type}'";

		$query.= $report_query;		
	}
			
	if(!empty($_POST['severity'])) {
		$severity = $_POST['severity'];
		$severity_query = " AND `severity` = '{$severity}'";

		$query.= $severity_query;		
	}

	if(!empty($_POST['area'])) {
		$area_id = $_POST['area'];
		$area_query = " AND `area` = '{$area_id}'";
		//$area_name = $_POST['area'];
		//$area_query = " AND `area` = '{$area_id}'";

		$query.= $area_query;		
	}

	if(!empty($_POST['assigned_id'])) {
		$assigned_id = $_POST['assigned_id'];;
		$assigned_query = " AND `assigned_to` = '{$assigned_id}'";

		$query.= $assigned_query;	
	}
 
	if(!empty($_POST['priority'])) {
		$priority = $_POST['priority'];
		$priority_query = " AND `priority` = '{$priority}'";

		$query.= $priority_query;		
	}

	if(!empty($_POST['resolution'])) {
		$resolution = $_POST['resolution'];
		$resolution_query = " AND `resolution` = '{$resolution}'";

		$query.= $resolution_query;	
	}

	if(!empty($_POST['reported_by'])) {
		$reported_by = $_POST['reported_by'];
		$reported_by_query = " AND `reported_by` = '{$reported_by}'";	
		
		$query.= $reported_by_query;	
	}

	if(!empty($_POST['reported'])) {
		$date_reported = $_POST['reported'];
		$format_date = str_replace("/","-",$date_reported);

		$reported_date_query = " AND `report_date` = '{$format_date}'";
		
		$query.= $reported_date_query;	
	}

	if(!empty($_POST['resolved_by'])) {
		$resolved_by = $_POST['resolved_by'];
		$resolved_by_query = " AND `resolved_by` = '{$resolved_by}'";
		
		$query.= $resolved_by_query;	
	}	

	
	//Connect to Database
	include 'dbConnection.php';	
	$con = Database::getConnection();
	$result = mysqli_query($con, $query);

	//echo "<table border=1 id = 'table' bgcolor='#ffffff'><th>Report ID </th><th>Report Type</th><th>Program</th><th>Problem Summary</th><th>Status</th><th>Severity</th><th>Reported By</th><th></th>\n";
	echo "<table border=1 id = 'table' bgcolor='#ffffff'>
		<th>Report ID </th><th>Report Type</th>
		<th>Program</th><th>Problem Summary</th>
		<th>Status</th><th>Severity</th>
		<th>Reported By</th>
		<th></th>\n";
	while($row=mysqli_fetch_array($result)) {
		$bug_id = $row['problem_report_num'];
		//$edit_button = "<form action='edit_bug.php' method='post'><button type='submit' value={$bug_id} name='ID'>Edit</button> </form>";
		$program_name = sprintf("%s (%s,%s)",$row['ProgName'],$row['Release_build'],$row['Version']);
		//printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>{$edit_button}</td></tr>\n",$row['problem_report_num'],$row['type'],$program_name,$row['problem_summary'],$row['status'],$row['severity_des'],$row['employee_name']);
		printf("<tr><td>%d</td>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td>%s</td>
		<td> <INPUT type='button' value='Edit' id=button2 name=button2 onclick='search()'> </td>
		</tr>\n",$row['problem_report_num'],$row['type'],$program_name,$row['problem_summary'],$row['status'],$row['severity_des'],$row['employee_name']);

	}	
	echo "</table>";		
			
?>
		<br>
		<input type="button" value="Cancel" onclick="window.location.href = 'main.php'">	
		<form action="edit_bug.php" method="post" id ="bugs_action">
			<input type = "Text" name ="ID" id = "report_id">
		</form>
		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("bugs_action").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("report_id").value = this.cells[0].innerHTML;
					document.getElementById("bugs_action").submit();
				}
			}
		</script> 		
    </body>
</html>