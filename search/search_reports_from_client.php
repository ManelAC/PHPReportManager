<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Search result</title>
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
			<a href="../reports/reports_new.php">New report</a><br>
			<br>
			<a href="../reports/reports_list.php">Reports list</a><br>
			<br>
			<a href="search.php">Search</a><br>
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
				
				foreach($database_connection->query('select * from reports_state order by reports_state_id asc') as $row) {
					echo "<hr>";
					echo "<h2>".$row['reports_state_description']."</h2>";
					
					echo "<table>";
					echo "<tr><th>Client</th><th>Report title</th><th>Date</th><th>Invoice</th><th>Photos</th><th>Authorisation</th></tr>";
					
					foreach($database_connection->query('select * from reports where (reports_state = '.$row['reports_state_id'].') and (reports_client_id = '.$client_id.') order by reports_date asc') as $rowreport) {
						
						foreach($database_connection->query('select clients_name from clients where clients_id = '.$rowreport['reports_client_id'].'') as $rowname) {
							echo "<tr><td>".$rowname['clients_name']."</td>";
						}
						
						if($row['reports_state_id'] == 2) {
							//If the report is ready to be done and we have all the documents, we mark the report title in red to notice it
							ready_to_be_done($rowreport['reports_title'], $rowreport['reports_invoice'], $rowreport['reports_photos'], $rowreport['reports_authorisation']);
						}
						else {
							echo "<td>".$rowreport['reports_title']."</td>";
						}
						
						echo "<td>".date("d/m/Y", strtotime($rowreport['reports_date']))."</td>";
						
						availability_print($rowreport['reports_invoice']);
						availability_print($rowreport['reports_photos']);
						availability_print($rowreport['reports_authorisation']);
						
						echo "<td><a href=\"reports_show.php?report_id=".$rowreport['reports_id']."\">Show report</a></td>";
						echo "<td><a href=\"reports_edit.php?report_id=".$rowreport['reports_id']."\">Edit report</a></td></tr>";
					}
					
					echo "</table><br>";
				}

				$database_connection = null;
			?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
