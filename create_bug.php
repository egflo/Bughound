<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a new Bug</title>
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
        <h1>Create Bug Report </h1>
        <form action="add_bug.php" method="post" onsubmit="return validate(this)" enctype="multipart/form-data">
            <?php
            //Database Connection
			include 'dbConnection.php';	
			$con = Database::getConnection();
			
			//Queries for drop down Selection
			$query_program = "SELECT * FROM programs";
			$query_report = "SELECT * FROM reports";
			$query_severity = "SELECT * FROM severity";
			$query_employee = "SELECT * FROM employee";

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
			//$result_area = mysqli_query($con, $query_area);
			$result_status = mysqli_query($con, $query_status);
			$result_priority = mysqli_query($con, $query_priority);
			$result_resolution = mysqli_query($con, $query_resolution);
			
			//setting date
			$month = date('m');
			$day = date('d');
			$year = date('Y');

			$today = $year . '-' . $month . '-' . $day;
			
			//Begin form
			//program input
			echo "&emsp;"; 
			echo "Program ";
			echo "<select name = 'program' id='prog_select' onchange='program_change(this)'>";	
			echo "<option value=''>Select Program</option>";
			while ($row = mysqli_fetch_row($result_program)) {
					$program_name = sprintf("%s (%s,%s)",$row[1],$row[2],$row[3]);
    				echo "<option value='" . $row[0] . "'>". $program_name ."</option>";	
    			}
    		echo "</select>";
    		
    		//report type input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Report Type ";
			echo "<select name = 'type' >";
			while ($row = mysqli_fetch_row($result_reports)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Severity input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Severity ";
			echo "<select name = 'severity' >";
			while ($row = mysqli_fetch_row($result_severity)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Problem Summary Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Problem Summary ";
    		echo "<input type = 'text' name = 'summary' size = 50>";
    		
    		//Reproducable Input
    		echo "&emsp;";
    		echo "Reproducable? ";
    		echo "<input type = 'checkbox' value = '1' name = 'reproduceable'>";
    		
    		//Problem Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Problem ";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "<textarea rows = 2 cols = 75 name = 'problem'>";
    		echo "</textarea>";
    		
    		//suggested fix Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Suggested fix  ";
    		echo "<textarea rows = 2 cols = 75 name = 'fix'>";
    		echo "</textarea>";
    		
    		//Reported By Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Reported By ";
    		echo "<select name = 'rp_by' >";
    		//echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_employee1)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Reported Date Input
    		
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Reported Date ";
    		echo "<input type = 'date' value = '" .$today. "'name = 'rp_date'>";
    		
			echo "<hr>";
			
    		//Functional Area Input
    		echo "<br>";
    		echo "&emsp;";
    		echo "Functionl Area ";
    		echo "<select name = 'area' id='area_select'>";
			echo "<option value = 0> </option>";
    		//while ($row = mysqli_fetch_row($result_area)) {
    		//		echo "<option value='" . $row[1] . "'>" . $row[0] . "</option>";	
    		//	}
    		echo "</select>";
    		
    		//Assigned To Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Assigned to ";
    		echo "<select name = 'assigned' >";
    		echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_employee2)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Comments Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Comments  ";
    		echo "<textarea rows = 2 cols = 80 name = 'commments'>";
    		echo "</textarea>";
    		
    		//Status Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Status ";
    		echo "<select name = 'status' >";
    		//echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_status)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Priority Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Prioirty ";
    		echo "<select name = 'priority' >";
    		echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_priority)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Resolution Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Resolution ";
    		echo "<select name = 'resolution' >";
    		echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_resolution)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Resolution Version Input
    		echo "&emsp;";
    		echo "Resolution version ";
    		echo "<input type = 'number' name ='res_ver' step='0.01'>";
    		
    		//Resolved by  Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Resolved By ";
    		echo "<select name = 'res_by' >";
    		echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_employee3)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Resolved Date Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Resolved Date ";
    		echo "<input type = 'date' name = 'res_dt'>";
    		
    		//Tested by  Input
    		echo "<br><br>";
    		echo "&emsp;";
    		echo "Tested By ";
    		echo "<select name = 'test_by' >";
    		echo "<option value = 0></option>";
    		while ($row = mysqli_fetch_row($result_employee4)) {
    				echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
    			}
    		echo "</select>";
    		
    		//Tested Date Input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Tested Date ";
    		echo "<input type = 'date' name = 'test_dt'>";
    		
    		//Deffered input
    		echo "&emsp;";
    		echo "&emsp;";
    		echo "Treat as Differed? ";
    		echo "<input type = 'checkbox' value = '1' name = 'deferred'>";
    		
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
				if(theform.program.value === ""){
                    alert ("Must Select A Program");
                    return false;
                }
           
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
				window.location.replace("bug.php");
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
