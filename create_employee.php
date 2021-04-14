<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add an Employee</title>
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
        <h1>Add an Employee</h1>
        <form action="add_employee.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td>Employee Name:</td>
                    <td><input type="Text" name="name" ></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="Text" name="username" ></td>
                </tr> 
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" id="pwd"></td>
                    <td><input type="checkbox" onclick="showpass()">Show Password </td>
                </tr>
             
             <?php				
					//Connect to Database
                    include 'dbConnection.php';	
                    $con = Database::getConnection();
                    $result = mysqli_query($con, $query);

					$query = "SELECT * FROM userlevel";
					$result = mysqli_query($con, $query);
				
					echo "<tr><td>User Level:</td><td><select name='user_level'>";
					while ($row = mysqli_fetch_row($result)) {
						echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";	
					}
    			?>
				</select></td></tr>
				
            </table>
            <input type="submit" name="submit" value="Submit">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("name field must contain characters");
                    return false;
                }
                if(theform.username.value === ""){
                    alert ("Username field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("Password field must contain characters");
                    return false;
                }
                
                return true;
            }
           
            function showpass() {
                var x = document.getElementById("pwd");
                if (x.type === "password") {
                     x.type = "text";
                } else {
                     x.type = "password";
                }
            }

            function cancel(){
				window.location.replace("employee.php");
			}
        </script>
    </body>
</html>
