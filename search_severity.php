<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Search Severity Type</title>
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
	<h1>Search Severity Type</h1>
	<form action="edit_severity.php" method="post" id ="severity" onsubmit="return validate(this)">
		<table>
			<tr>
				<td>Severity ID:</td>
				<td><input type="Text" name="id"</td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Search"></form>
		<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
		<script language=Javascript>
			function validate(theform) {
				if(theform.id.value === ""){
					alert ("ID cannot be null");
					return false;
				}
				return true;
			}
			function cancel(){
				window.location.replace("search.php");
			}
		</script>  
	</body>
</html>