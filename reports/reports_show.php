<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Show report's information</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel=stylesheet href="../style.css" type="text/css" />
</head>

<?php
	include'../php_functions/php_functions.php';
?>

<body>
	<div id="container">
		<div id="header">
			<h1>PHP Report Manager</h1>
		</div>
		<div id="leftcolumn">
			<a href="../index.php">Index</a><br>
			<br>
			<a href="../clients/clients_new.php">New client</a><br>
			<br>
			<a href="../clients/clients_list.php">Clients list</a><br>
			<br>
			<a href="reports_new.php">New report</a><br>
			<br>
			<a href="reports_list.php">Reports list</a><br>
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
				
				$report_id = $_GET['report_id'];
			
				foreach($database_connection->query('select * from reports where reports_id = '.$report_id.'') as $row) {
					echo "<p>Client: ";
						foreach($database_connection->query('select * from clients where clients_id = '.$row['reports_client_id'].'') as $rowclients) {
							echo $rowclients['clients_name'];
						}
					echo "</p>";

					echo "<p>Report title: ";
						echo $row['reports_title'];
					echo "</p>";

					echo "<p>Report state: ";
						foreach($database_connection->query('select * from reports_state where reports_state_id = '.$row['reports_state'].'') as $rowstate) {
							echo $rowstate['reports_state_description'];
						}
					echo "</p>";

					echo "<p>Report date: ".date("d/m/Y", strtotime($row['reports_date']))."</p>";
					
					echo "<br><hr><br><p><b>Necessary documents</b></p>";
					
					echo "<p>Invoice: ";
					received_or_not($row['reports_invoice']);
					echo "</p>";
					
					echo"<p>Photos: ";
					received_or_not($row['reports_photos']);
					echo "</p>";
					
					echo "<p>Authorisation: ";
					received_or_not($row['reports_authorisation']);
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
