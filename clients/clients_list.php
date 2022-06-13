<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Clients list</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel=stylesheet href="../style.css" type="text/css" />
</head>

<body>
	<div id="container">
		<div id="header">
			<h1>PHP Report Manager</h1>
		</div>
		<div id="leftcolumn">
			<a href="../index.php">Index</a><br>
			<br>
			<a href="clients_new.php">New client</a><br>
			<br>
			<a href="clients_list.php">Clients list</a><br>
			<br>
			<a href="../reports/reports_new.php">New report</a><br>
			<br>
			<a href="../reports/reports_list.php">Reports list</a><br>
			<br>
			<a href="../search/search.php">Search</a><br>
		</div>
		<div id="body">
			<?php
				$server = "localhost";
				$database = "php_report_manager";
 
				$database_user = "php_rm_user";
				$database_user_password = "this_is_a_password";

				try {
					$database_connection = new PDO('mysql:host='.$server.';dbname='.$database.'', ''.$database_user.'', ''.$database_user_password.'', 
					array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				}
				catch(PDOException $exception) {
					echo "Can't connect to database.";
					$exception->getMessage();
				}
				
				$total_clients_count = $database_connection->query('select count(clients_id) from clients')->fetchColumn();
				echo "<b>Number of clients = ".$total_clients_count."</b><br><br>";
				
				echo "<table>";
				echo "<tr><th>Client name</th><th>Customer type</th><th>Last report date</th></tr>";
				
				foreach($database_connection->query('select * from clients order by clients_name') as $row) {
					echo "<tr><td>".$row['clients_name']."</td>";
					
					echo "<td>";
						foreach($database_connection->query('select * from clients_type where clients_type_id = '.$row['clients_type'].'') as $rowct) {
							echo $rowct['clients_type_description'];
						}
					echo "</td>";
					
					echo "<td>";
					echo "TO DO";
					
					/*
					foreach($database_connection->query('select reports_date from reports where reports_client_id ='.$row['clients_id'].' 
					order by reports_date desc limit 1') as $repdate) {
						
						$presentdate = time();
						$initialdate = strtotime($repdate['reports_date']);
						$diff = $presentdate - $initialdate;
						if($diff > (180*24*3600)) { //If the last report is older than 6 months, we mark it in red
							echo "<font color=red>".date("d/m/Y", strtotime($repdate['reports_date']))."</font>";
						}
						else {
							echo date("d/m/Y", strtotime($repdate['reports_date']));
						}
						
					}
					*/
					
					echo "</td>";
					
					echo "<td><a href=\"clients_show.php?client_id=".$row['clients_id']."\">Show information</a></td>";
					echo "<td><a href=\"clients_edit.php?client_id=".$row['clients_id']."\">Edit client</a></td>";
					echo "<td><a href=\"../search/search_reports_from_client.php?client_id=".$row['clients_id']."\">Show client's reports</a></td></tr>";
				}
				
				echo "</table>";
				
				$database_connection = null;
			?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>