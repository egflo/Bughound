<html>
    <head>
        <meta charset="UTF-8">
        <title>Database Maintenance</title>
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
        <h1>Database Maintenance</h1>
        <form>
			<p>
            <input type="button" onclick="window.location.href = 'search.php';" value="Search Database" id="search"/>
			<p>
			<p>
            <input type="button" onclick="window.location.href = 'employee.php';" value="Employee Maintenance" id="employee"/>
			<p>
			<input type="button" onclick="window.location.href = 'program.php';" value="Program Maintenance" id="program"/>
			<p>
			<input type="button" onclick="window.location.href = 'area.php';" value="Functional Area Maintenance" id="area"/>
			<p>
			<input type="button" onclick="window.location.href = 'attachment_type.php';" value="Attachment Maintenance" id="attachtype"/>
			<p>
			<input type="button" onclick="window.location.href = 'priority.php';" value="Priority Type Maintainance" id="priority"/>
			<p>
            <input type="button" onclick="window.location.href = 'report.php';" value="Report Type Maintenance" id="report"/>
			<p>
			<input type="button" onclick="window.location.href = 'resolution.php';" value="Resolution Type Maintenance" id="resolution"/>
			<p>
			<input type="button" onclick="window.location.href = 'severity.php';" value="Severity Type Maintenance" id="severity"/>
			<p>
			<input type="button" onclick="window.location.href = 'status.php';" value="Status Type Maintenance" id="status"/>
			<p>
			<input type="button" onclick="window.location.href = 'userlevel.php';" value="User Level Maintenance" id="userlevel"/>
			<p>
			<input type="button" onclick="window.location.href = 'export_tables.php';" value="Exporting Tables" id="tables"/>
			<p>
			<input type="button" onclick="window.location.href = 'main.php';" value="Return" id="return"/>
        </form>
    </body>
</html>