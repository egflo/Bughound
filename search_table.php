<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = strval($_GET['q']);

//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
    
$sql="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='".$q."'";
$result = mysqli_query($con,$sql);

echo "<table border=1 id = 'table' bgcolor='#ffffff'> <tr>";
while($row = mysqli_fetch_array($result)) {
echo "<th>" .$row[0]. "</th>";
}

$sql="SELECT COUNT(*) from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='".$q."'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$col = intval($row[0]) - 1;

$sql="SELECT * from ".$q." ";
$result = mysqli_query($con,$sql);

error_log(print_r($sql, TRUE)); 


echo "</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  foreach (range(0, $col) as $number) {
    echo "<td>" . $row[$number] . "</td>";
  }
  echo "</tr>";
}

echo "</table>";
?>
</body>
</html>