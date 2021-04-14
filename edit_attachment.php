<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Attachmant Details</title>
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
        <h1>Edit Attachment Details</h1>
        <form action="update_attachment.php" method="post" onsubmit="return validate(this)">
		<?php
		
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();

			$ar_id = $_POST['ar_id'];
			
			$query = "SELECT t.type, a.problem_report_id, a.attachment_report_id, a.location FROM attachments as a INNER JOIN attachment_type AS t ON t.id = a.type WHERE a.attachment_report_id = $ar_id";
			$result = mysqli_query($con, $query);
			echo "<table border=1 bgcolor='#ffffff'><th>Attachment ID</th><th>Bug ID</th><th>Attachment Type</th><th>Location</th>\n";
			//$none = 0;
			while($row=mysqli_fetch_array($result)) {
				$none=1;
				printf("<tr><td>%d</td><td>%d</td><td>%s</td><td>%s</td></tr>\n",$row['attachment_report_id'],$row['problem_report_id'],$row['type'],$row['location']);
				
			echo "</table>";
			echo "<p>";
			printf("Enter new Values<p>");
			echo "<table>";
			echo "<tr><td>Attachment ID:</td><td><input type='Text' name='ar_id' value = {$row['attachment_report_id']} readonly></td></tr>";
			// To Do 
			echo "<tr><td>Location:</td><td><input type='text' name='location' value = {$row['location']}> </td></tr>\n";	
			}
			echo "</table>";
            ?>
            <input type="submit" name="submit" value="Submit">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>

        <script language=Javascript>
            function validate(theform) {
				if(theform.location.value === ""){
                    alert ("Location field must contain characters");
                    return false;
                }
                return true;
            }
            function cancel(){
				window.location.replace("attachment_type.php");
			}
        </script>
    </body>
</html>