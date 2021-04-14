<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>List of resolution Types</title>
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
	<h1>List of Resolution Types</h1>
		<?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
	
			$query = "SELECT * FROM resolution";
			$result = mysqli_query($con, $query);

			echo "<table border=1 id = 'table' bgcolor='#ffffff'><th>ID</th><th>Description</th>\n";
			while($row=mysqli_fetch_row($result)) {
				printf("<tr>
				<td>%d</td>
				<td>%s</td>
				<td>
					<form action='edit_resolution.php' method='post'>
						<input id='res_id' name='res_id' type='hidden' value = %s />
						<input type='submit' name = 'submit' value='Edit' />
					</form>
				</td>
				<td>
					<form action='delete_resolution.php' method='post' >
						<input id='del_id' name='del_id' type='hidden' value = %s />
						<input type='submit' name = 'submit' value='Delete' />
					</form>
				</td>
				</tr>\n",$row[0],$row[1],$row[0],$row[0]);
		}?>
		</table>
		<p>
		<INPUT type="button" value="Create" id=button1 name=button1 onclick="create()">
		<INPUT type="button" value="Return" id=button3 name=button3 onclick="cancel()">

		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("resolution").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("id").value = this.cells[0].innerHTML;
					document.getElementById("resolution").submit();
				}
			}
			function search() {
				window.location.replace("search_resolution.php");
			}
			function create(){
				window.location.replace("create_resolution.php");
			}
			function cancel(){
				window.location.replace("db_maintenance.php");
			}
		</script>    
	</body>
</html>