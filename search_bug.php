
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Report Search</title>
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
        <h1>Bug Report Search</h1>
        <form action="process_bug_search.php" method="post">
            <table>
				<tr><td>Program:</td><td><select name="program" id="prog" onchange='program_change(this)'>
				<option value=""></option>
				
				<?php
					
					//Connect to Database
					include 'dbConnection.php';	
					$con = Database::getConnection();
		
					$query = "SELECT * FROM `programs`" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						$program_name = sprintf("%s (%s,%s)", $row['ProgName'], $row['Release_build'], $row['Version']);
						printf("<option value=%s>%s</option>\n",$row['ProgID'],$program_name);		
					}	
							
				echo '</select></td></tr>';
				
				echo '<tr><td>Report Type:</td><td><select name="report_type" id="report">';
					echo '<option value=""></option>';
					$query = "SELECT * FROM `reports`" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row['id'],$row['type']);		
					}
				echo '</select></td></tr>';
				
				
				echo '<tr><td>Severity:</td><td><select name="severity" id="severity_type">';
					
					echo '<option value=""></option>';
					$query = "SELECT * FROM `severity`" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row['id'],$row['description']);		
					}
				echo '</select></td></tr>';
						
				
				echo '<tr><td>Functional Area:</td><td><select name="area" id="func_area">';

					echo '<option value=""></option>';
					//$query = "SELECT * FROM `functional_area`" ;
					$query = "SELECT DISTINCT functional_area.name FROM `functional_area`" ;
					$result = mysqli_query($con, $query);
					
					//while($row = mysqli_fetch_array($result))
					//{
					//	printf("<option value=%s>%s</option>\n",$row['name'],$row['name']);		
					//}	
				
				echo '</select></td></tr>';
				
				echo '<tr><td>Assigned To:</td><td><select name="assigned" id="assign">';
					
					echo '<option value=""></option>';
					$query = "SELECT * FROM `employee`" ;
					$emp_result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($emp_result))
					{
						printf("<option value=%s>%s</option>\n",$row['EmpID'],$row['Name']);		
					}	
			
				echo '</select></td></tr>';
				
				echo '<tr><td>Status:</td><td><select name="status" id="stat">';
					$query = "SELECT * FROM `status`" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row['id'],$row['description']);		
					}	
				
				echo '</select></td></tr>';
				
				echo '<tr><td>Priority:</td><td><select name="priority" id="prior">';
					echo '<option value=""></option>';
					$query = "SELECT * FROM `priority`" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row['id'],$row['description']);		
					}					
				echo '</select></td></tr>';
				
				echo '<tr><td>Resolution:</td><td><select name="resolution" id="reso">';
					echo '<option value=""></option>';
					$query = "SELECT * FROM `resolution`" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row['id'],$row['type']);		
					}				
				echo '</select></td></tr>';
			
				echo '<tr><td>Reported By:</td><td><select name="reported_by">';
					
					echo '<option value=""></option>';
					mysqli_data_seek($emp_result, 0);
					while($row = mysqli_fetch_array($emp_result))
					{
						printf("<option value=%s>%s</option>\n",$row['EmpID'],$row['Name']);		
					}	
					
				echo '</select></td></tr>';
				
				echo '<tr><td>Report Date:</td><td><input type="date" id="date_reported" name="reported" value="0000-00-00" min="0000-00-00" max="2019-12-31"></td></tr>';

				echo '<tr><td>Resolved By:</td><td><select name="resolved_by" id="resolved">';
			
					echo '<option value=""></option>';
					mysqli_data_seek($emp_result, 0);
					while($row = mysqli_fetch_array($emp_result))
					{
						printf("<option value=%s>%s</option>\n",$row['EmpID'],$row['Name']);		
					}	
					
				?>	
				</select></td></tr>
				
					
						
			</table>

            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<input type="button" value="Cancel" onclick="window.location.href = 'main.php'">

        </form>

        <script language=Javascript>

            function validate(theform) {
            
                if(theform.summary.value === ""){
                    alert ("Problem Summary field cannot be blank");
                    return false;
                }
                if(theform.problem.value === ""){
                    alert ("Problem field cannot be blank");
                    return false;
                }
                if(theform.fix.value === ""){
                    alert ("Suggested fix field cannot be blank");
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
						document.getElementById("func_area").innerHTML = this.responseText;
					}
				}
				//var loc = "bug_form_update.php?prog_id="+ options.value";
				xmlhttp.open("GET", "bug_form_update.php?prog_id="+ options.value, true);
				xmlhttp.send();
			}			
        </script>

    </body>

</html>