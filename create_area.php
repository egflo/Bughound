<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Functional Area</title>
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
        <h1>Add Functional Area</h1>
        <form action="add_area.php" method="post" onsubmit="return validate(this)">
            <table>
				<tr><td>Program:</td>
				<?php
					//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
					mysqli_select_db($con, "bug_hound");
					$query = "SELECT * FROM programs";
					$result_program = mysqli_query($con, $query);
					echo "<td><select name = 'program'>";
					while ($row = mysqli_fetch_array($result_program)) {
						$program_name = sprintf("%s (%s,%s)",$row['ProgName'],$row['Release_build'],$row['Version']);
						$program_id = $row['ProgID'];
						echo "<option value='$program_id'>$program_name</option>";	
					}
					echo "</select></td></tr>";
				?>
                <tr><td>Area Name:</td><td><input type="Text" name="name"</td></tr>		
            </table>
            <input type="submit" name="submit" value="Submit">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>


        <script language=Javascript>
            function validate(theform) {
				 if(theform.program.value === ""){
                    alert ("No Program Selected");
                    return false;
                }
                if(theform.name.value === ""){
                    alert ("Area Name field must contain characters");
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
