<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>List of Employees</title>
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
	<h1>List of Employees</h1>
		<?php

			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);
			
			$query = "SELECT * FROM employee";
			$result = mysqli_query($con, $query);
			echo "<table border=1 id = 'table' bgcolor='#ffffff'>
				<th>Emp ID</th>
				<th>User Name</th>
				<th>Name</th>
				<th>User Level</th>\n";

			while($row=mysqli_fetch_row($result)) {
				printf("<tr>
				<td>%d</td>
				<td>%s</td>
				<td>%s</td>
				<td>%d</td>
				<td>
					<form action='edit_employee.php' method='post'>
						<input id='EmpID' name='EmpID' type='hidden' value = %s />
						<input type='submit' name = 'submit' value='Edit' />
					</form>
				</td>
				<td>
					<form action='delete_employee.php' method='post' onSubmit = 'return delete_id();'>
						<input id='del_id' name='del_id' type='hidden' value = %s />
						<input type='submit' name = 'submit' value='Delete' />
					</form>
				</td>
				</tr>\n",$row[0],$row[2],$row[1],$row[4], $row[0],  $row[0]);
		}?>
		</table>
		
		<p>
		<INPUT type="button" value="Create" id=button1 name=button1 onclick="create()">
		<INPUT type="button" value="Return" id=button3 name=button2 onclick="back()">
		
		<form action="edit_employee.php" method="post" id ="emp">
			<input type = "Text" name ="EmpID" id = "EmpID">
		</form>

		<script language=Javascript>

			var table = document.getElementById('table'),rIndex;
			document.getElementById("emp").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("EmpID").value = this.cells[0].innerHTML;
					document.getElementById("emp").submit();
				}
			}
			function delete_id() {
		  		var r = confirm("Warning: Delete Cannot Be Undone.");
  				if (r ) {
					return true;
				} else {
					return false;
				}
			}

			function edit() {
				window.location.replace("edit_employee.php");
			}
			function create(){
				window.location.replace("create_employee.php");
			}
			function back(){
				window.location.replace("db_maintenance.php");
			}
		</script>    
	</body>
</html>