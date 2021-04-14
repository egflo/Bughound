<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>List of Functional Areas</title>
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
	<h1>List of Functional Areas</h1>
		<?php
			
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);

			$query = "SELECT a.id, a.name, p.ProgID AS 'program_id', p.ProgName AS 'program_name', p.Release_build AS 'release', p.Version AS 'version'
				FROM functional_area AS a
				INNER JOIN programs AS p
					ON a.program_id = p.ProgID";
					
			$result = mysqli_query($con, $query);
			echo "<table border=1 id = 'table' bgcolor='#ffffff'><th>Program ID</th><th>Program Name</th><th>Area ID</th><th>Area Name</th>\n";
			while($row=mysqli_fetch_array($result)) {
				$program_name = sprintf("%s (%s,%s)",$row['program_name'],$row['release'],$row['version']);
				printf("<tr><td>%d</td>
						<td>%s</td>
						<td>%d</td>
						<td>%s</td>				
						<td>
							<form action='edit_area.php' method='post'>
								<input id='AreaID' name='AreaID' type='hidden' value = %s />
								<input type='submit' name = 'submit' value='Edit' />
							</form>
						</td>
						<td>
							<form action='delete_area.php' method='post' >
								<input id='del_id' name='del_id' type='hidden' value = %s />
								<input type='submit' name = 'submit' value='Delete' />
							</form>
						</td>
						</tr>\n",$row['program_id'],$program_name,$row['id'],$row['name'],$row['id'],$row['id']);
		}?>
		</table>
		<p>
		<INPUT type="button" value="Create" id=button1 name=button1 onclick="create()">
		<INPUT type="button" value="Return" id=button3 name=button3 onclick="cancel()">

		<form action="edit_area.php" method="post" id ="area">
			<input type = "Text" name ="AreaID" id = "AreaID">
		</form>

		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("area").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("AreaID").value = this.cells[2].innerHTML;
					document.getElementById("area").submit();
				}
			}
			function search() {
				window.location.replace("search_area.php");
			}
			function create(){
				window.location.replace("create_area.php");
			}
			function cancel(){
				window.location.replace("db_maintenance.php");
			}
		</script>    
	</body>
</html>