<?php
	$prog_id = $_REQUEST["prog_id"];
	
	//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
	mysqli_select_db($con, "bug_hound");

	$query = "SELECT a.id, a.name, p.ProgID AS 'progam_id', p.ProgName AS 'progam_name', p.Release_build AS 'release', p.Version AS 'version'
		FROM functional_area AS a
		INNER JOIN programs AS p
			ON a.program_id = p.ProgID
		WHERE a.program_id = {$prog_id}";
	
	$result = mysqli_query($con, $query);
	$count = mysqli_num_rows($result);
	
	echo "<option value = 0></option>";
	while ($row = mysqli_fetch_row($result)) {	
		echo "<option value={$row[0]}>{$row[1]}</option>";	
	}
	
	
?>