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
	<h1>Current Bugs</h1>
		<?php	
			include 'dbConnection.php';	
			$con = Database::getConnection(); 
			$query = "SELECT * FROM bugs";
			$result = mysqli_query($con, $query);
			echo "<table border=1 id = 'table' bgcolor='#ffffff'>
			<th>Bug ID</th>
			<th>Program</th>
			<th>Report Type</th>
			<th>Problem</th>
			<th>Status</th>
			<th></th>
			\n";
			while($row=mysqli_fetch_row($result)) {
				$query2 = "SELECT * FROM programs WHERE ProgID = $row[1]";
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
					<td> <INPUT type='button' value='Edit' id=button2 name=button2 onclick='search()'> </td>
					</tr>\n",
					$row[0],
					sprintf("%s (%s,%s)",$row2[1],$row2[2],$row2[3]), $row3[0], $row[6], $row4[0]);
		}?>
		</table>
		<p>
		<INPUT type="button" value="Create" id=button1 name=button1 onclick="create()">
		<INPUT type="button" value="Return" id=button3 name=button3 onclick="cancel()">
		<form action="edit_bug.php" method="post" id ="bug">
			<input type = "Text" name ="ID" id = "ID">
		</form>
		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("bug").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("ID").value = this.cells[0].innerHTML;
					document.getElementById("bug").submit();
				}
			}
			function search() {
				window.location.replace("search_bug.php");
			}
			function create(){
				window.location.replace("create_bug.php");
			}
			function cancel(){
				window.location.replace("main.php");
			}
		</script>    
	</body>
</html>