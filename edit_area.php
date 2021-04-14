<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Area Details</title>
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
        <h1>Edit Area Details</h1>
        <form action="update_area.php" method="post" onsubmit="return validate(this)">
        <?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();

			$ID = $_POST['AreaID'];

			printf("You Selected <p>");
			$query = "SELECT * FROM functional_area WHERE id = $ID";
			$result = mysqli_query($con, $query);
			echo "<table border=1 bgcolor='#ffffff'><th>ID</th><th>Name</th>\n";
			//$none = 0;
			while($row=mysqli_fetch_row($result)) {
				$none=1;
				printf("<tr><td>%d</td><td>%s</td></tr>\n",$row[1],$row[0]);
				
			echo "</table>";
			echo "<p>";
			printf("Enter new Values<p>");
			echo "<table>";
			echo "<tr><td>ID:</td><td><input type='Text' name='AreaID' value = $row[1] readonly></td></tr>";
			echo "<tr><td>Area Name:</td><td><input type='Text' name='name' value = $row[0]> </td></tr>\n";
			
			}
			echo "</table>";
            ?>
            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<input type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("name field must contain characters");
                    return false;
                }
                return true;
            }
            function cancel(){
				window.location.replace("area.php");
			}
        </script>
    </body>
</html>