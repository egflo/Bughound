<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Program Details</title>
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
        <h1>Edit Program Details</h1>
        <form action="update_program.php" method="post" onsubmit="return validate(this)">
        <?php
			$ID = $_POST['ProgID'];

			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);


			printf("You Selected <p>");
			$query = "SELECT * FROM programs WHERE ProgID = '{$ID}'";
			
			$result = mysqli_query($con, $query);
			
			echo "<table border=1 bgcolor='#ffffff'><th>Program ID</th><th>Name</th><th>Release</th><th>Version</th>\n";
			while($row=mysqli_fetch_row($result)) {
				printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2],$row[3]);
				
			echo "</table>";
			echo "<p>";
			printf("Enter new Values<p>");
			echo "<table>";
			echo "<tr><td>Program ID:</td><td><input type='Text' name='id' value = $row[0] readonly></td></tr>";
			echo "<tr><td>Name:</td><td><input type='Text' name='name' value = $row[1]> </td></tr>\n";
			echo "<tr><td>Release:</td><td><input type='Text' name='rel' value = $row[2]> </td></tr>\n";
			echo "<tr><td>Version:</td><td><input type='Text' name='ver' value = $row[3]> </td></tr>\n";
			}
			echo "</table>";
            ?>
            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>
		

        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
			   if(theform.rel.value === ""){
                    alert ("Release field must contain characters");
                    return false;
                }
			  if(theform.ver.value === ""){
                    alert ("Version field must contain characters");
                    return false;
                }
                return true;
            }
            function cancel(){
				window.location.replace("program.php");
			}
        </script>
    </body>
</html>