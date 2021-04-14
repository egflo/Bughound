<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Employee Details</title>
    </head>
    <body>
        <h1>Edit Employee Details</h1>
        
        <?php
        //Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
		mysqli_select_db($con, "bug_hound");
		$bug = $_POST['bug'];
		
		switch($bug){
			case 1:
				$bid = $_POST['bid'];
				$query1 = "SELECT * from bugs WHERE problem_report_num = $bid";
				$result = mysqli_query($con, $query1);
				break;
			case 2:
				$program = $_POST['program'];
				$query2 = "SELECT * from bugs WHERE program = $program";
				$result = mysqli_query($con, $query2);
				break;
			case 3:
				$report = $_POST['report'];
				$query3 = "SELECT * from bugs WHERE report_type = $report";
				$result = mysqli_query($con, $query3);
				break;
			case 4:
				$severity = $_POST['severity'];
				$query4 = "SELECT * from bugs WHERE severity = $severity";
				$result = mysqli_query($con, $query4);
				break;
			case 5:
				$area = $_POST['area'];
				$query5 = "SELECT * from bugs WHERE area = $area";
				$result = mysqli_query($con, $query5);
				break;
			case 6:
				$assigned = $_POST['assigned'];
				$query6 = "SELECT * from bugs WHERE assigned_to = $assigned";
				$result = mysqli_query($con, $query6);
				break;
			case 7:
				$status = $_POST['status'];
				$query7 = "SELECT * from bugs WHERE status = $status";
				$result = mysqli_query($con, $query7);
				break;
			case 8:
				$priority = $_POST['priority'];
				$query8 = "SELECT * from bugs WHERE priority = $priority";
				$result = mysqli_query($con, $query8);
				break;
			case 9:
				$reslution = $_POST['reslution'];
				$query9 = "SELECT * from bugs WHERE resolution = $resolution";
				$result = mysqli_query($con, $query9);
				break;
			case 10:
				$rp_by = $_POST['rp_by'];
				$query10 = "SELECT * from bugs WHERE reported_by = $rp_by";
				$result = mysqli_query($con, $query10);
				break;
			case 11:
				$rp_dt = $_POST['rp_dt'];
				$query11 = "SELECT * from bugs WHERE report_date = $rp_dt";
				$result = mysqli_query($con, $query11);
				break;
			case 12:
				$rs_by = $_POST['rs_by'];
				$query12 = "SELECT * from bugs WHERE resolved_by = $rs_by";
				$result = mysqli_query($con, $query12);
				break;
			default:
				printf("%d",$bug);
		}
		echo "<table border=1 id = 'table'>
			<th>Bug ID</th>
			<th>Program</th>
			<th>Report Type</th>
			<th>Problem</th>
			<th>Area</th>
			\n";
			while($row=mysqli_fetch_row($result)) {
				$query2 = "SELECT ProgName FROM programs WHERE ProgID = $row[1]";
				$result2=mysqli_query($con, $query2);
				$row2 = mysqli_fetch_row($result2);
				$query3 = "	SELECT	type FROM reports WHERE id = $row[2]";
				$result3=mysqli_query($con, $query3);
				$row3 = mysqli_fetch_row($result3);
				$query4 = "SELECT name FROM functional_area WHERE id = $row[10]";
				$result4=mysqli_query($con, $query4);
				$row4 = mysqli_fetch_row($result4);
				printf("<tr>
					<td>%d</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					</tr>\n",
					$row[0],
					$row2[0],
					$row3[0],
					$row[6],
					$row4[0]
					);
		}?>
		</table>
		<p>
		
		<INPUT type="button" value="Edit" id=button2 name=button2 onclick="search()">
		<INPUT type="button" value="Return" id=button3 name=button3 onclick="cancel()">
		<form action="edit_bug.php" method="post" id ="bugid">
		<input type = "Text" name ="ID" id = "ID" >
		</form>
		<script language=Javascript>
			var table = document.getElementById('table'),rIndex;
			document.getElementById("bugid").style.visibility = "hidden";
			for(var i = 0; i<table.rows.length;i++)
			{
				table.rows[i].onclick = function()
				{
					rindex = this.rowIndex;
					document.getElementById("ID").value = this.cells[0].innerHTML;
					document.getElementById("bugid").submit();
				}
			}
			function search() {
				window.location.replace("search_bug.php");
			}
			function cancel(){
				window.location.replace("bug.php");
			}
		</script>  
	</body>
</html>