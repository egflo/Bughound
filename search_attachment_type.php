<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit Attachment Type</title>
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
    <h1>Search Attachment Type</h1>
	<form action="edit_attachment_type.php" method="post" id ="att_type" onsubmit="return validate(this)">
		<table>
			<tr>
				<td>ID:</td>
				<td><input type="Text" name="ar_id"></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Search"></form>
		<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
		<script language=Javascript>
			function validate(theform) {
				if(theform.ID.value === ""){
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