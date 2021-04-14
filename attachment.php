<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>List of Attachments</title>
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
	<h1>List of Attachments (Click On Table)</h1>
	<?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);

			//$pr_id = $_POST['pr_id'];
			//$query = "SELECT * FROM attachments WHERE problem_report_id = $pr_id";
			$query = "SELECT a.problem_report_id, p.ProgName, p.Release_build, p.Version, a.attachment_report_id, b.problem_summary, a.location, t.type FROM attachments AS a
				INNER JOIN bugs as b
					ON b.problem_report_num = a.problem_report_id
				INNER JOIN programs as p
					ON b.program = p.ProgID 
				INNER JOIN attachment_type as t
					ON t.id = a.type";
					
			$result = mysqli_query($con, $query);
			echo "<table border=1 id = 'table' bgcolor='#ffffff'><th>Report ID</th><th>Program</th><th>Problem Summary</th><th>Attachment ID</th><th>Type</th><th>Location</th>\n";
			//$none = 0;
			while($row=mysqli_fetch_array($result)) {
				$none=1;
				$program_name = sprintf("%s (%s,%s)",$row['ProgName'],$row['Release_build'],$row['Version']);
				printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='%s'>%s</a></td>
				<td>
					<form action='edit_attachment.php' method='post'>
						<input id='ar_id' name='ar_id' type='hidden' value = %s />
						<input type='submit' name = 'submit' value='Edit' />
					</form>
				</td></tr>\n",
				$row['problem_report_id'],$program_name,
				$row['problem_summary'],
				$row['attachment_report_id'],
				$row['type'],$row['location'],
				$row['location'],
				$row['attachment_report_id']);
			}
		?>
		</table>
		<p>
		<!-- 
		form action="create_attachment.php" method="post" id ="create">
			<input type ="text" name = "pr_id" id= "pr_id">
			<input type="submit" value="Add Attachment" id=submit name=submit>
		</form>
		<input type="button" value="Edit" id=button2 name=button2 onclick="search()">
		<form action="edit_attachment.php" method="post" id ="attachment">
			<input type = "Text" name ="ar_id" id = "ar_id">
		</form>


		<form action="edit_attachment.php" method="post" id ="attachment">
			<input type = "Text" name ="ar_id" id = "ar_id">
		</form>
		
		-->
		<input type="button" value="Return" id = "cancel" onclick="cancel()">

		<script language=Javascript>

			function search() {
				window.location.replace("edit_attachment.php");
			}
			function cancel(){
				window.location.replace("main.php");
			}
		</script>    
	</body>
</html>