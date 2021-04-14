<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound Main</title>	
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
        <h1>Bughound Main</h1>
        <form>
			<p>
            <input type="button" onclick="window.location.href = 'bug.php';" value="Submit Bug" id="bug"/>
			<input type="button" onclick="window.location.href = 'search_bug.php';" value="Search Bug" id="bug_search"/>
			<input type="button" onclick="window.location.href = 'attachment.php';" value="Bug Attachments" id="bug_attach"/>
			<input type="button" onclick="window.location.href = 'export_bug.php';" value="Export Bug" id="bug_export"/>
			<p>
			<input type="button" onclick="window.location.href = 'db_maintenance.php';" value="Database Maintenance" id="db"/>
        </form>

		<?php	
			$valid_level =  isValidLevel(3);
			if(!$valid_level) {
				echo "<SCRIPT type='text/javascript'>
				var x = document.getElementById('db');
				x.style.display = 'none';
				</SCRIPT>";			
			}
		?>
    </body>
</html>