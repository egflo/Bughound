<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add new attachment type</title>
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
        <h1>Add new attachment type</h1>
        <form action="add_attachment_type.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Type:</td><td><input type="Text" name="type"</td></tr>
            </table>
            <input type="submit" name="submit" value="Submit">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        </form>
        <script language=Javascript>
            function validate(theform) {
                if(theform.type.value === ""){
                    alert ("Type field must contain characters");
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
