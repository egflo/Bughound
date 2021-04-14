<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Report Type</title>
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
        <h1>Add Report Type</h1>
        <form action="add_report.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Description:</td><td><input type="Text" name="desc"</td></tr>
				
            </table>
            <input type="submit" name="submit" value="Submit">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
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
				window.location.replace("report.php");
			}
        </script>
    </body>
</html>
