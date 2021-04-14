<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>List of Programs</title>
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
	<h1>List of Programs</h1>
		<?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);

			$query = "SELECT * FROM programs";
			$result = mysqli_query($con, $query);
			echo "<table border=1 id = 'table' bgcolor='#ffffff'><th>ID</th><th>Name</th><th>Release</th><th>Version</th>\n";
			//$none = 0;
			while($row=mysqli_fetch_row($result)) {
				$none=1;
				printf("<tr>
				<td>%d</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>
				<form action='edit_program.php' method='post'>
					<input id='ProgID' name='ProgID' type='hidden' value = %s />
					<input type='submit' name = 'submit' value='Edit' />
				</form>
				</td>
				<td>
					<form action='delete_program.php' method='post' >
					<input id='del_id' name='del_id' type='hidden' value = %s />
					<input type='submit' name = 'submit' value='Delete' />
					</form>
				</td>
				</tr>\n",$row[0],$row[1],$row[2],$row[3], $row[0], $row[0]);
		}?>
		</table>
		<p>
		<INPUT type="button" value="Create" id=button1 name=button1 onclick="create()">
		<INPUT type="button" value="Return" id=button3 name=button3 onclick="cancel()">
		<form action="edit_program.php" method="post" id ="prog">
			<input type = "Text" name ="ProgID" id = "ProgID">
		</form>
		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("prog").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("ProgID").value = this.cells[0].innerHTML;
					document.getElementById("prog").submit();
				}
			}
			function search() {
				window.location.replace("search_program.php");
			}
			function create(){
				window.location.replace("create_program.php");
			}
			function cancel(){
				window.location.replace("db_maintenance.php");
			}
		</script>    
	</body>
</html>