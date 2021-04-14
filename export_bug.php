<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>List of Bugs</title>
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
	<h1>List of Bugs</h1>
		<?php

			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);

			$query = "SELECT * FROM bugs";
			$result = mysqli_query($con, $query);
			echo "<table border=1 id = 'table' bgcolor='#ffffff'>
			<th>Bug ID</th>
			<th>Program</th>
			<th>Report Type</th>
			<th>Problem</th>
			<th>Status</th>
			\n";
			while($row=mysqli_fetch_row($result)) {
				$query2 = "SELECT ProgName FROM programs WHERE ProgID = $row[1]";
				$result2=mysqli_query($con, $query2);
				$row2 = mysqli_fetch_row($result2);
				$query3 = "	SELECT	type FROM reports WHERE id = $row[2]";
				$result3=mysqli_query($con, $query3);
				$row3 = mysqli_fetch_row($result3);
				$query4 = "SELECT description FROM status WHERE id = $row[13]";
				$result4=mysqli_query($con, $query4);
				$row4 = mysqli_fetch_row($result4);
				printf("<tr>
					<td>%d</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
					<form action='export_bug_process.php' method='post'>
						<input id='bug_id' name='bug_id' type='hidden' value = %s />
						<input type='submit' name = 'submit' value='Export' />
					</form>
					</tr>\n",
					$row[0],
					$row2[0],
					$row3[0],
					$row[6],
					$row4[0],
					$row[0]
					);
		}?>
		</table>
		<p>
		<INPUT type="button" value="Return" id=button3 name=button3 onclick="cancel()">

		<form action="export_bug_process.php" method="post" id ="bug">
			<input type = "Text" name ="bug_id" id = "bug_id">
		</form>

		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("bug").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("bug_id").value = this.cells[0].innerHTML;
					document.getElementById("bug").submit();
				}
			}

			function cancel(){
				window.location.replace("main.php");
			}
		</script>    
	</body>
</html>