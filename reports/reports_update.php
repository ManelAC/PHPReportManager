<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Edit report</title>
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
			<a href="../clients/clients_new.php">New client</a><br>
			<br>
			<a href="../clients/clients_list.php">Clients list</a><br>
			<br>
			<a href="reports_new.php">New report</a><br>
			<br>
			<a href="reports_list.php">Reports list</a><br>
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
				
				$id_report = $_POST['id_report_form'];
			
				$date = $_POST['report_year_form'].'/'.$_POST['report_month_form'].'/'.$_POST['report_day_form'];
				
				$update_statement = $database_connection->prepare("update reports set
					reports_client_id = :report_client_id, 
					reports_title = :report_title, 
					reports_state = :report_state, 
					reports_date = :report_date, 
					reports_invoice = :report_invoice, 
					reports_photos = :report_photos, 
					reports_authorisation = :report_authorisation
					where reports_id = ".$id_report."");
				
				$update_statement->execute(
					array(
						':report_client_id' => $_POST['client_form'], 
						':report_title' => $_POST['report_title_form'], 
						':report_state' => $_POST['report_state_form'], 
						':report_date' => $date, 
						':report_invoice' => $_POST['invoice_form'], 
						':report_photos' => $_POST['photos_form'], 
						':report_authorisation' => $_POST['authorisation_form']
					)
				);
				
				echo "The report has been updated.";
				
				$database_connection = null;
			?>
			<br>
			<a href="../index.php">Return to the index</a>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
