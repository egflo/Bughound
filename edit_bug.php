<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Details</title>
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
        <h1>Edit Bug Details</h1>
        <form action="update_bug.php" method="post" onsubmit="return validate(this)"  enctype="multipart/form-data">
        <?php
			//Check if current user is of correct level
			$valid_program_details = isValidLevel(3);
			$valid_area_details = isValidLevel(1);
			
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection(); 

			$ID = $_POST['ID'];
			printf('<input type="hidden" name="pr_id" value= %d />',$ID);
			
			$query = "SELECT * FROM bugs WHERE problem_report_num = $ID";
			$result = mysqli_query($con, $query);
			$row_bug = mysqli_fetch_row($result);
			
			//Queries for drop down Selection
			$query_program = "SELECT * FROM programs";
			$query_report = "SELECT * FROM reports";
			$query_severity = "SELECT * FROM severity";
			$query_employee = "SELECT * FROM employee";
			$query_area = "SELECT * FROM functional_area AS a INNER JOIN programs AS p ON a.program_id = p.ProgID WHERE a.program_id = {$row_bug[1]}";
			$query_status = "Select * FROM status";
			$query_priority = "Select * FROM priority";
			$query_resolution = "Select * FROM resolution";
			
			//Results for executing the Queries
			$result_program = mysqli_query($con, $query_program);
			$result_reports = mysqli_query($con, $query_report);
			$result_severity = mysqli_query($con, $query_severity);
			$result_employee1 = mysqli_query($con, $query_employee);
			$result_employee2 = mysqli_query($con, $query_employee);
			$result_employee3 = mysqli_query($con, $query_employee);
			$result_employee4 = mysqli_query($con, $query_employee);
			$result_area = mysqli_query($con, $query_area);
			$result_status = mysqli_query($con, $query_status);
			$result_priority = mysqli_query($con, $query_priority);
			$result_resolution = mysqli_query($con, $query_resolution);
			
			
			//Begin form
			//program input
			echo "&emsp;"; 
			echo "Program ";
			
			if($valid_program_details) {
				echo "<select name = 'program' id='prog_select' onchange='program_change(this)'>";
			}
			else {
				echo "<select name = 'program'  disabled='true'>";
			}
			
			$query_temp = "SELECT * FROM programs WHERE ProgID = $row_bug[1]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			//Program Name (Release, Version)
			$program_name = sprintf("%s (%s,%s)",$row_temp[1],$row_temp[2],$row_temp[3]);
			echo "<option value='" .$row_bug[1]."'>" .$program_name. "</option>";
			while ($row = mysqli_fetch_row($result_program)) {
				if($row_bug[1] != $row[0]){
					$program_name = sprintf("%s (%s,%s)",$row[1],$row[2],$row[3]);
    				echo "<option value='" . $row[0] . "'>" . $program_name . "</option>";
    				}	
    			}
    		echo "</select>";
    		
    		//report type input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Report Type ";
			
			if($valid_program_details) {
				echo "<select name = 'type'>";
			}
			else {
				echo "<select name = 'type'  disabled='true'>";
			}
	
    		$query_temp = "SELECT * FROM reports WHERE id = $row_bug[2]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[2]."'>" .$row_temp[1]. "</option>";
			while ($row = mysqli_fetch_row($result_reports)) {
				if($row_bug[2] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Severity input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Severity ";
			
			if($valid_program_details) {
				echo "<select name = 'severity'>";
			}
			else {
				echo "<select name = 'severity'  disabled='true'>";
			}
			
			$query_temp = "SELECT * FROM severity WHERE id = $row_bug[3]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[3]."'>" .$row_temp[1]. "</option>";
			while ($row = mysqli_fetch_row($result_severity)) {
				if($row_bug[3] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Problem Summary Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Problem Summary ";

			if($valid_program_details) {
				echo '<input type = "text" name = "summary" size = 50 value = "'.$row_bug[4].'" >';
			}
			else {
				echo '<input type = "text" name = "summary" size = 50 value = "'.$row_bug[4].'" readonly>';
			}		
    		
    		//Reproducable Input
    		echo "&emsp;";
    		echo "Reproducable? ";
			
			$checked = "checked";
			if($row_bug[5] == '0')
			{
				$checked = "";
			}
						
			if($valid_program_details) {
				echo "<input type = 'checkbox' name = 'reproduceable' value = '1' $checked >";
			}
			else {
				echo "<input type = 'checkbox' name = 'reproduceable' value = '1' disabled='true' $checked >";
			}			
    		
    		//Problem Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Problem ";
    		echo "&emsp;";
    		echo "&emsp;";
			//$summary = str_replace("'","\'",$row_bug[4]);
			if($valid_program_details) {
				echo "<textarea rows = 2 cols = 75 name = 'problem' >";
			}
			else {
				echo "<textarea rows = 2 cols = 75 name = 'problem' readonly>";
			}				
    		printf("%s",$row_bug[6]);
    		echo "</textarea>";
    		
    		//suggested fix Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Suggested fix  ";
			if($valid_program_details) {
				echo "<textarea rows = 2 cols = 75 name = 'fix'>";
			}
			else {
				echo "<textarea rows = 2 cols = 75 name = 'fix' readonly>";
			}				

    		printf("%s",$row_bug[7]);
    		echo "</textarea>";
    		
    		//Reported By Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Reported By ";
			if($valid_program_details) {
				echo "<select name = 'rp_by' >";
			}
			else {
				echo "<select name = 'rp_by'  disabled='true'>";
			}			

    		$query_temp = "SELECT * FROM employee WHERE EmpId = $row_bug[8]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[8]."'>" .$row_temp[1]. "</option>";
    		//echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_employee1)) {
    			if($row_bug[8] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Reported Date Input
    		
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Reported Date ";

			if($valid_program_details) {
				echo "<input type = 'date' value = {$row_bug[9]} name = 'rp_date' >";
			}
			else {
				echo "<input type = 'date' value = {$row_bug[9]} name = 'rp_date' disabled='true'>";;
			}	
			   		
			echo "<hr>";
			
    		//Functional Area Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Functional Area ";
			
			if($valid_area_details) {
				echo "<select name = 'area' id='area_select'>";
			}
			else {
				echo "<select name = 'area' disabled='true'>";
			}				
			
    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM functional_area WHERE id = $row_bug[10]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[10]."'>" .$row_temp[0]. "</option>";
    		while ($row = mysqli_fetch_row($result_area)) {
    			if($row_bug[10] != $row[1])
    				echo "<option value='" . $row[1] . "'>" . $row[0] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Assigned To Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Assigned to ";
			if($valid_area_details) {
				echo "<select name = 'assigned' >";
			}
			else {
				echo "<select name = 'assigned' disabled='true'>";
			}				

    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM employee WHERE EmpId = $row_bug[11]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[11]."'>" .$row_temp[1]. "</option>";
    		while ($row = mysqli_fetch_row($result_employee2)) {
    			if($row_bug[11] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Comments Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Comments  ";
			if($valid_area_details) {
				echo "<textarea rows = 2 cols = 80 name = 'commments'>";
			}
			else {
				echo "<textarea rows = 2 cols = 80 name = 'commments' readonly>";
			}				
			
    		printf("%s",$row_bug[12]);
    		echo "</textarea>";
    		
    		//Status Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Status ";
			if($valid_area_details) {
				echo "<select name = 'status' >";
			}
			else {
				echo "<select name = 'status' disabled='true'>";
			}				
    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM status WHERE id = $row_bug[13]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[13]."'>" .$row_temp[1]. "</option>";
    		while ($row = mysqli_fetch_row($result_status)) {
    			if($row_bug[13] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Priority Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Priority ";
			if($valid_area_details) {
				echo "<select name = 'priority' >";
			}
			else {
				echo "<select name = 'priority' disabled='true'>";
			}			
    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM priority WHERE id = $row_bug[14]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[14]."'>" .$row_temp[1]. "</option>";
    		while ($row = mysqli_fetch_row($result_priority)) {
	    		if($row_bug[14] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Resolution Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Resolution ";
			
			if($valid_area_details) {
				echo "<select name = 'resolution' >";
			}
			else {
				echo "<select name = 'resolution' disabled='true'>";
			}						
    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM resolution WHERE id = $row_bug[15]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[14]."'>" .$row_temp[1]. "</option>";
    		while ($row = mysqli_fetch_row($result_resolution)) {
    			if($row_bug[15] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Resolution Version Input
    		echo "&emsp;";
    		echo "Resolution version ";

			if($valid_area_details) {
				echo "<input type = 'number' name ='res_ver' step='0.01' value = $row_bug[16] >";
			}
			else {
				echo "<input type = 'number' name ='res_ver' step='0.01' value = $row_bug[16] readonly>";;

			}									
    		
    		//Resolved by  Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Resolved By ";
			if($valid_area_details) {
				echo "<select name = 'res_by' >";
			}
			else {
				echo "<select name = 'res_by' disabled='true'>";
			}				

    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM employee WHERE EmpId = $row_bug[17]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[17]."'>" .$row_temp[1]. "</option>";
    		while ($row = mysqli_fetch_row($result_employee3)) {
    			if($row_bug[17] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Resolved Date Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Resolved Date ";
			if($valid_area_details) {
				echo "<input type = 'date' name = 'res_dt' value = {$row_bug[18]}>";
			}
			else {
				echo "<input type = 'date' name = 'res_dt' value = {$row_bug[18]} disabled='true'>";
			}				
    		
    		//Tested by  Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Tested By ";
			if($valid_area_details) {
				echo "<select name = 'test_by' >";
			}
			else {
				echo "<select name = 'test_by' disabled='true'>";

			}			
    		//echo "<option value = 0></option>";
    		$query_temp = "SELECT * FROM employee WHERE EmpId = $row_bug[19]";
			$result_temp = mysqli_query($con, $query_temp);
			$row_temp = mysqli_fetch_row($result_temp);
			echo "<option value='" .$row_bug[19]."'>" .$row_temp[1]. "</option>";
    		while ($row = mysqli_fetch_row($result_employee4)) {
    			if($row_bug[19] != $row[0])
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Tested Date Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Tested Date ";
			if($valid_area_details) {
				echo "<input type = 'date' name = 'test_dt' value = $row_bug[20]>";
			}
			else {
				echo "<input type = 'date' name = 'test_dt' value = $row_bug[20] disabled='true'>";

			}				
    		
    		//Deffered input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Treat as Differed? ";
			
			$checked = "checked";
			if($row_bug[21] == '0')
			{
				$checked = "";
			}
			
			if($valid_area_details) {
				echo "<input type = 'checkbox' value = '1' name = 'deferred' $checked >";
			}
			else {
				echo "<input type = 'checkbox' value = '1' name = 'deferred' disabled='true' $checked >";

			}				
    		
			//File upload
			echo "<br><br>";
			echo "&emsp;";
			echo "File to Upload: ";
			echo '<input type="file" name="file_upload" id="file_upload">';
			
			?>
        
            <p>
            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>

        <script>
            function validate(theform) {
                if(theform.summary.value === ""){
                    alert ("Problem Summary field cannot be blank");
                    return false;
                }
                if(theform.problem.value === ""){
                    alert ("Problem field cannot be blank");
                    return false;
                }
                
                return true;
            }
            function cancel(){
				window.location.replace("main.php");
			}
			
			function program_change(options){
				var xmlhttp = new XMLHttpRequest();
	
				xmlhttp.onreadystatechange = function() 
				{
					if (this.readyState == 4 && this.status == 200) 
					{
						document.getElementById("area_select").innerHTML = this.responseText;
					}
				}
				//var loc = "bug_form_update.php?prog_id="+ options.value";
				xmlhttp.open("GET", "bug_form_update.php?prog_id="+ options.value, true);
				xmlhttp.send();
			}			
        </script>
    </body>
</html>