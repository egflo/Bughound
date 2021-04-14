<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit userlevel Details</title>
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
        <h1>Edit User Level Details</h1>
        <form action="update_userlevel.php" method="post" onsubmit="return validate(this)">
        <?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$id = $_POST['usr_id'];

			printf("You Selected <p>");

			$query = "SELECT * FROM userlevel WHERE ULevel = $id";
			$result = mysqli_query($con, $query);
			echo "<table border=1 bgcolor='#ffffff'><th>User Level</th><th>Description</th>\n";
			//$none = 0;
			while($row=mysqli_fetch_array($result)) {
				$none=1;
				printf("<tr><td>%d</td><td>%s</td></tr>\n",$row['ULevel'],$row['UGroup']);
				
			echo "</table>";
			echo "<p>";
			printf("Enter new Values<p>");
			echo "<table>";
			echo "<tr><td>User Level:</td><td><input type='Text' name='id' value = {$row['ULevel']} readonly></td></tr>";
			echo "<tr><td>Description:</td><td><input type='Text' name='desc' value = {$row['UGroup']}> </td></tr>\n";
			
			}
			echo "</table>";
            ?>
            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">			
			<input type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
		</form>
		
		
        <script language=Javascript>
            function validate(theform) {
                if(theform.desc.value === ""){
                    alert ("Description field must contain characters");
                    return false;
                }
                return true;
            }
            function cancel(){
				window.location.replace("userlevel.php");
			}
        </script>
    </body>
</html>