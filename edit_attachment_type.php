<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Attachment Types</title>
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
        <h1>Edit Attachment Type</h1>
        <form action="update_attachment_type.php" method="post" onsubmit="return validate(this)">
        <?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();

			$ID = $_POST['ar_id'];
			printf("You Selected <p>");
			$query = "SELECT * FROM attachment_type WHERE ID = $ID";
			$result = mysqli_query($con, $query);
			echo "<table border=1 bgcolor='#ffffff'><th>ID</th><th>Type</th>\n";
			//$none = 0;
			while($row=mysqli_fetch_row($result)) {
				$none=1;
				printf("<tr><td>%d</td><td>%s</td></tr>\n",$row[0],$row[1]);
			}
			echo "</table>";
			echo "<p>";
			
			mysqli_data_seek($result,0);
			$row=mysqli_fetch_row($result);
			printf("Enter new Values<p>");
			echo "<table>";
			echo "<tr><td>ID:</td><td><input type='Text' name='id' value = '{$row[0]}' readonly></td></tr>";
			echo "<tr><td>Type:</td><td><input type='Text' name='type' value = '{$row[1]}'> </td></tr>\n";
			
			echo "</table>";
           ?>
            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<input type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>
		
        <script language=Javascript>
            function validate(theform) {
                if(theform.type.value === ""){
                    alert ("Type field must contain characters");
                    return false;
                }
			}
            function cancel(){
				window.location.replace("attachment_type.php");
			}
        </script>
    </body>
</html>