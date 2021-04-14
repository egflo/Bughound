<?php
	$table_name = $_POST['table_export'];
	$export_type = $_POST['export_type'];
	
	date_default_timezone_set('America/Los_Angeles');
	$date = getdate();
	
	$month = $date['mon'];
	$day = $date['mday'];
	$year = $date['year'];
	
	$hr = $date['hours'];
	$min = $date['minutes'];
	$sec = $date['seconds'];
	
	$date_str = sprintf("%d/%d/%d %d:%d:%d", $month, $day, $year, $hr, $min, $sec);
	
	if($export_type == "ASCII")
	{
		//$location = "C:/Export/{$table_name}.txt";
		$location = "..\\Bughound\\exports\\{$table_name}.txt";
	
		$directory = "..\\Bughound\\exports\\";
		if(!file_exists($directory))
		{
			mkdir("..\\Bughound\\exports\\");
		}
			
		//$export_query = "SELECT * INTO OUTFILE '{$location}' FROM {$table_name}";
		
		//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
		$query = "DESCRIBE {$table_name}";
		$result = mysqli_query($con, $query);
		
		$ascii_file = fopen("$location", "w");
		
		$time_stamp = "Created: ".$date_str;
		fwrite($ascii_file, $time_stamp.PHP_EOL);
		
		$txt = sprintf("%-22s %-22s %-22s %-22s %-22s %-22s \n", "Field" ,"Type","Null","Key","Default","Extra");		
		fwrite($ascii_file, $txt);
		
		$txt = sprintf("%'-128s \n",  "-");
		fwrite($ascii_file, $txt);
		
		while($row=mysqli_fetch_array($result)) {
			
			$txt = sprintf("%-22s %-22s %-22s %-22s %-22s %-22s \n", $row['Field'],$row['Type'],$row['Null'],$row['Key'],$row['Default'],$row['Extra']);		
			fwrite($ascii_file, $txt);
		}
		
		$str_replace = str_replace("\\","/",$location);
		echo "<SCRIPT type='text/javascript'>
		alert('ASCII File Located At: {$location}');
		window.location.replace('main.php');
		</SCRIPT>";
		
	}
	
	if($export_type == "XML")
	{

		//$location = "C:/Export/{$table_name}.txt";
		$location = "..\\Bughound\\exports\\{$table_name}.xml";
	
		$directory = "..\\Bughound\\exports\\";
		if(!file_exists($directory))
		{
			mkdir("..\\Bughound\\exports\\");
		}
			
		$xml_file = fopen("$location", "w");
		//<!--Your comment-->
		
		$xml_date = "<!-- Created: {$date_str}-->".PHP_EOL;
		
		fwrite($xml_file, $xml_date);
		
		$txt = '<?xml version="1.0" encoding="utf-8"?>'.PHP_EOL;
		fwrite($xml_file, $txt);
		
		$txt = '<pma_xml_export version="1.0" xmlns:pma="https://www.phpmyadmin.net/some_doc_url/">'.PHP_EOL;
		fwrite($xml_file, $txt);	
		
		$txt = '<pma:structure_schemas>'.PHP_EOL;
		fwrite($xml_file, $txt);	
		
		$txt = '<pma:database name="bug_hound" collation="latin1_swedish_ci" charset="latin1">'.PHP_EOL;
		fwrite($xml_file, $txt);

		$txt = '<pma:table name="bugs">'.PHP_EOL;
		fwrite($xml_file, $txt);	

		$txt = "CREATE TABLE `{$table_name}` (".PHP_EOL;
		fwrite($xml_file, $txt);			
	
		//Connect to Database
include 'dbConnection.php';	
$con = Database::getConnection();
$result = mysqli_query($con, $query);
		mysqli_select_db($con, "bug_hound");
		$query = "DESCRIBE {$table_name}";
		$result = mysqli_query($con, $query);
		
		while($row=mysqli_fetch_array($result)) {
			$txt = " '{$row['Field']}' {$row['Type']} ";
			
			if($row['Null'] = 'NO')
			{
				$txt.= "NOT NULL ";
			}
			else {
				$txt.= "NULL ";
			}
			
			if(strlen($row['Extra']) > 0)
			{
				$txt.= "{$row['Extra']}";
			}
			
			$txt.= ",".PHP_EOL;
			fwrite($xml_file, $txt);																			
		}
				
		mysqli_data_seek($result,0);
			
		while($row=mysqli_fetch_array($result)) {
			$text = "";
			if(strlen($row['Key']) > 0)
			{
				if($row['Key'] == "PRI")
				{
					$txt = "PRIMARY KEY (`{$row['Field']}`)".PHP_EOL;	
					//$txt.= "`{$row['Field']}` )";
					fwrite($xml_file, $txt);
				}
			}																			
		}
		
		$query = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'bug_hound' AND TABLE_NAME = '{$table_name}'";
		$result_value = mysqli_query($con, $query);
				
		$row_result = mysqli_fetch_array($result_value);
		$next_value = $row_result['AUTO_INCREMENT'];
		
		$txt = ") ENGINE=InnoDB AUTO_INCREMENT={$next_value} DEFAULT CHARSET=latin1;".PHP_EOL;	
		fwrite($xml_file, $txt);
		
		$txt = "</pma:table>".PHP_EOL;
		fwrite($xml_file, $txt);		 
		$txt = "</pma:database>".PHP_EOL;
		fwrite($xml_file, $txt);		 
		$txt = "</pma:structure_schemas>".PHP_EOL;
		fwrite($xml_file, $txt);
		
		
		$str_replace = str_replace("\\","/",$location);
		echo "<SCRIPT type='text/javascript'>
		alert('XML File Located At: {$str_replace}');
		window.location.replace('main.php');
		</SCRIPT>";
				
	}	
	
	//header("Location: main.php");
?>