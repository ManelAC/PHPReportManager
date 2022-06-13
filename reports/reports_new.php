<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>New report</title>
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
			?>
			<form action="reports_insert.php" method="post">
				<p>Client <select name="client_form">
					<?php
						foreach($database_connection->query('select * from clients order by clients_name') as $rowclients) {
							echo "<option value=".$rowclients['clients_id'].">".$rowclients['clients_name']."</option>";
						}
					?></select></p>
				<p>Report title <textarea name="report_title_form" cols=80 rows=1></textarea></p>
				<p>Report state <select name="report_state_form">
					<?php
						foreach($database_connection->query('select * from reports_state order by reports_state_id') as $rowstate) {
							echo "<option value=".$rowstate['reports_state_id'].">".$rowstate['reports_state_description']."</option>";
						}
					?></select></p>
				<p>Report date 
					<?php
						$starting_day = 1;
						$ending_day = 31;
						$starting_month = 1;
						$ending_month = 12;
						$starting_year = 2020;
						$ending_year = date("Y") + 1;
						
						echo "<select name='report_day_form'>";
						while($starting_day <= $ending_day) {
							echo "<option value=".$starting_day.">".$starting_day."</option>";
							++$starting_day;
						}
						echo "</select>";
						
						echo "<select name='report_month_form'>";
						while($starting_month <= $ending_month) {
							echo "<option value=".$starting_month.">".$starting_month."</option>";
							++$starting_month;
						}
						echo "</select>";
						
						echo "<select name='report_year_form'>";
						while($starting_year <= $ending_year) {
							echo "<option value=".$starting_year.">".$starting_year."</option>";
							++$starting_year;
						}
						echo "</select>";
						
					?></p>
				<br>
				<hr>
				<p><b>Necessary documents</b></p>
				<p>Invoice 
					<select name="invoice_form">
						<option value=0 selected>Not received yet</option>
						<option value=1>Received</option>
					</select>
				</p>

				<p>Photos 
					<select name="photos_form">
						<option value=0 selected>Not received yet</option>
						<option value=1>Received</option>
					</select>
				</p>

				<p>Authorisation 
					<select name="authorisation_form">
						<option value=0 selected>Not received yet</option>
						<option value=1>Received</option>
					</select>
				</p>

				<br>
				<input type="submit" value="Create report">
			</form>
			<?php
				$database_connection = null;
			?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
