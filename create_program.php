<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a Program</title>
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
        <h1>Add a Program</h1>
        <form action="add_program.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="name"</td></tr>
				<tr><td>Release:</td><td><input type="Text" name="rel"</td></tr>
				<tr><td>Version:</td><td><input type="Text" name="ver"</td></tr>
            </table>
            <input type="submit" name="submit" value="Submit">
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
