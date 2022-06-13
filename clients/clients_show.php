<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Show client's information</title>
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
				
				$client_id = $_GET['client_id'];
			
				foreach($database_connection->query('select * from clients where clients_id = '.$client_id.'') as $row) {
					echo "<p>Name: ";
						echo $row['clients_name'];
					echo "</p>";

					echo "<p>ID number: ";
						 echo $row['clients_id_number'];
					echo "</p>";

					echo "<p>Email: ";
						 echo $row['clients_email'];
					echo "</p>";

					echo "<p>Client type: ";
						foreach($database_connection->query('select * from clients_type where clients_type_id = '.$row['clients_type'].'') as $rowct) {
							echo $rowct['clients_type_description'];
						}
					echo "</p>";
				}
				$database_connection = null;
			?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
