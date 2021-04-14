<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Program Seach</title>
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
		<h1>Search for Program</h1>
		<form action="edit_program.php" method="post" id ="program" onsubmit="return validate(this)">
		<table>
			<tr>
				<td>Program ID:</td>
				<td><input type="Text" name="ProgID"</td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Search"></form>
		<input type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
		<script language=Javascript>
			function validate(theform) {
				if(theform.id.value === ""){
					alert ("ProgramID cannot be null");
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