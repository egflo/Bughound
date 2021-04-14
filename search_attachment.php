<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit Attachment Details</title>
	</head>
	<body style="background-color: #E5E7E9;">

	<form action="edit_attachment.php" method="post" id ="att" onsubmit="return validate(this)">
		<table>
			<tr>
				<td>Attachment Report ID:</td>
				<td><input type="Text" name="ar_id"></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Search"></form>
		<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
		<script language=Javascript>
			function validate(theform) {
				if(theform.ar_id.value === ""){
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