<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Export Table</title>
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
		<?php		
			$table_name = $_POST['table_export'];
			$export_type = $_POST['export_type'];
			
			echo "<h1>Export Table {$table_name}</h1>";
			
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();

			$query = "DESCRIBE {$table_name}";
			$result = mysqli_query($con, $query);

			echo "<table border=1 id = 'table' bgcolor='#ffffff'>
			<th>Field</th>
			<th>Type</th>
			<th>Null</th>
			<th>Key</th>
			<th>Default</th>
			<th>Extra</th>
			\n";
			while($row=mysqli_fetch_array($result)) {
				printf("<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					</tr>\n",
					$row['Field'],
					$row['Type'],
					$row['Null'],
					$row['Key'],
					$row['Default'],
					$row['Extra']
					);	
		
		}?>
		</table>
		<br>
		<form action="create_export.php" method="post">
			<?php
				$table_name = $_POST['table_export'];
				$export_type = $_POST['export_type'];
				echo "<input type='hidden' value = {$export_type} name='export_type'>";
				echo "<input type='hidden' value = {$table_name} name='table_export'>";
			?>
			<input type="submit" value="Create" name="create" onclick="create()">
		</form>
		
		<input type="button" value="Cancel" name="cancel" onclick="cancel()">

		<script language=Javascript>
			function create(){
				window.location.replace("create_export.php");
			}
			function cancel(){
				window.location.replace("export_tables.php");
			}
		</script>    
	</body>
</html>