<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Employee Details</title>
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
        <h1>Edit Employee</h1>
        <form action="update_employee.php" method="post" onsubmit="return validate(this)">
        <?php
			//Connect to Database
			include 'dbConnection.php';	
			$con = Database::getConnection();
			$result = mysqli_query($con, $query);

			$Emp_ID = $_POST['EmpID'];

			$query = "SELECT * FROM employee WHERE EmpID = $Emp_ID";
			$result = mysqli_query($con, $query);
			$query2 = "SELECT * FROM userlevel";
			$result2 = mysqli_query($con, $query2);
			echo "<table border=1 bgcolor='#ffffff'><th>Emp ID</th><th>Name</th>\n";

			while($row=mysqli_fetch_row($result)) {
				$none=1;
				printf("<tr><td>%d</td><td>%s</td></tr>\n",$row[0],$row[1]);
				
			echo "</table>";
			echo "<p>";
			printf("Enter new Values");
			echo "<table>";
			echo "<tr><td>Emp ID:</td><td><input type='Text' name='empid' value = $row[0] readonly></td></tr>";
			echo "<tr><td>Full Name:</td><td><input type='Text' name='name' value = $row[1]> </td></tr>\n";
			echo "<tr><td>Username:</td><td><input type='Text' name='uname' value = $row[2]> </td></tr>\n";
			echo "<tr><td>Password:</td><td><input type='Text' name='password' value = $row[3]> </td></tr>\n";

			echo "<tr><td>User level:</td><td><select name='userlevel'>";
			$query3 = "SELECT UGroup FROM userlevel WHERE ULevel = $row[4]";
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_row($result3);
			echo "<option value='" .$row[4]."'>$row3[0]</option>";
			while ($row2 = mysqli_fetch_row($result2)) {
				if($row[4] != $row2[0]){
    				echo "<option value='" . $row2[0] . "'>" . $row2[1] . "</option>";	
    			}
			}
			echo "</select></td></tr>";
			}
			echo "</table>";
            ?>
			<p>
            <input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset" value="Reset">
			<input type="button" value="Cancel" onclick="cancel()">
		</form>	

        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.uname.value === ""){
                    alert ("Username field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("Password field must contain characters");
                    return false;
                }
                return true;
            }
            
			function cancel(){
				window.location.replace("employee.php");
			}
            
			function cancel(){
				window.location.replace("delete_employee.php");
			}			
        </script>
    </body>
</html>