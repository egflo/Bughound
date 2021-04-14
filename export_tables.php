<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Table Export</title>
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
        <h1>Table Export</h1>
        <form action="export.php" method="post" onsubmit="return validate(this)">

            <table>
				<tr><td>Table:</td><td><select name="table_export" id="export">
					<option value="bugs">bugs</option>
					<option value="employee">employee</option>	
					<option value="functional_area">functional_area</option>
					<option value="programs">programs</option>									
				</select></td></tr>
				
				<tr><td>Type:</td><td><select name="export_type" id="export">
					<option value="ASCII">ASCII</option>
					<option value="XML">XML</option>	
				</select></td></tr>				
						
			</table>

            <input type="submit" name="submit" value="Submit">
			<input type="button" value="Cancel" onclick="window.location.href = 'db_maintenance.php'">

        </form>

        <script language=Javascript>


        </script>

    </body>

</html>