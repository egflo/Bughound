<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add new attachment</title>
    </head>
    <body>
        <h1>Add new attachment</h1>
        <form action="add_attachment.php" method="post" onsubmit="return validate(this)">
            <table>
				//TO DO
				<tr><td>Location:</td><td><input type="Text" name="location"</td></tr>
            </table>
            <input type="submit" name="submit" value="submit">
			<INPUT type="button" value="Cancel" id=button1 name=button1 onclick="cancel()">
        <script language=Javascript>
            function validate(theform) {
            	if(theform.location.value === ""){
                    alert ("Location field must contain characters");
                    return false;
                }
                return true;
            }
            function cancel(){
				window.location.replace("bugs.php");
			}
        </script>
    </body>
</html>
