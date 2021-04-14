<html>
    <head>
        <meta charset="UTF-8">
        <title>Database Maintenance</title>
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
        <h1>Database Search</h1>
		<form id = "search_form" action="\">
			<label for="sel_data">Search From Table:</label>
			<select id="sel_data" name="sel_data" onchange= "search_form(this.value);" >
			<option value=""></option>
			<?php		
					//Connect to Database
					include 'dbConnection.php';	
					$con = Database::getConnection();
		
					$query = "show tables;" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row[0],$row[0]);		
					}	
							
				echo '</select>';
			?>
			<input type="submit" value="Search">
		</form>

        <form>
			<label for="sel">Choose a Table:</label>
			<select id="sel" name="sel" onchange = "selectTable(this.value);" >
			<option value=""></option>
			<?php		
					$con = Database::getConnection();
		
					$query = "show tables;" ;
					$result = mysqli_query($con, $query);
					
					while($row = mysqli_fetch_array($result))
					{
						printf("<option value=%s>%s</option>\n",$row[0],$row[0]);		
					}	
							
				echo '</select>';
			?>
		</form>
		
		<div id="results"><b>Database Results</b></div>
		<br>
		<input type="button" onclick="window.location.href = 'db_maintenance.php';" value="Return" id="return"/>
	</body>

	<script>
		function search_form(str) {
			if (str == "") {
    			document.getElementById("search_form").action = "search.php";
			}

			else if (str == "attachment_type")
			{
				document.getElementById('search_form').action = "search_attachment_type.php";
			}

			else if (str == "attachments")
			{
				document.getElementById('search_form').action = "search_attachment.php";
			}

			else if (str == "bugs")
			{
				document.getElementById('search_form').action = "search_bug.php";
			}
			else if (str == "employee")
			{
				document.getElementById('search_form').action = "search_employee.php";
			}

			else if (str == "functional_area")
			{
				document.getElementById('search_form').action = "search_area.php";
			}		

			else if (str == "priority")
			{
				document.getElementById('search_form').action = "search_priority.php";
			}		

			else if (str == "programs")
			{
				document.getElementById('search_form').action = "search_program.php";
			}

			else if (str == "programs")
			{
				document.getElementById('search_form').action = "search_program.php";
			}

			else if (str == "reports")
			{
				document.getElementById('search_form').action = "search_report.php";
			}	

			else if (str == "resolution")
			{
				document.getElementById('search_form').action = "search_resolution.php";
			}

			else if (str == "severity")
			{
				document.getElementById('search_form').action = "search_severity.php";
			}

			else if (str == "status")
			{
				document.getElementById('search_form').action = "search_status.php";
			}

			else if (str == "userlevel")
			{
				document.getElementById('search_form').action = "search_userlevel.php";
			}

		}

		function selectTable(str) {
  		if (str == "") {
    		document.getElementById("results").innerHTML = "";
    		return;
  		} else {
    		var xmlhttp = new XMLHttpRequest();
    		xmlhttp.onreadystatechange = function() {
      	if (this.readyState == 4 && this.status == 200) {
        	document.getElementById("results").innerHTML = this.responseText;
      	}
    	};
  		xmlhttp.open("GET","search_table.php?q="+str,true);
    	xmlhttp.send();	
  		}
		}
	</script>
</html>