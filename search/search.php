<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Search</title>
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
			?>
			<h2>Search all the reports from a client</h2>
			<form action="search_reports_from_client_alternative.php" method="post">
				Clients 
					<select name="client_id_form">
						<?php
							foreach($database_connection->query('select * from clients order by clients_name') as $rowclients) {
								echo "<option value=".$rowclients['clients_id'].">".$rowclients['clients_name']."</option>";
							}
						?>
					</select>
				<br>
				<br>
				<input type="submit" value="Search">
			</form>
			<br>
			<hr>
			<br>
			<h2>Search reports by date</h2>
			<form action="search_reports_by_dates.php" method="post">
				Search from 
				<?php
					$starting_day = 1;
					$ending_day = 31;
					$starting_month = 1;
					$ending_month = 12;
					$starting_year = 2020;
					$ending_year = date("Y") + 1;
					
					echo "<select name='report_day_form_start'>";
					while($starting_day <= $ending_day) {
						echo "<option value=".$starting_day.">".$starting_day."</option>";
						++$starting_day;
					}
					echo "</select>";
					
					echo "<select name='report_month_form_start'>";
					while($starting_month <= $ending_month) {
						echo "<option value=".$starting_month.">".$starting_month."</option>";
						++$starting_month;
					}
					echo "</select>";
					
					echo "<select name='report_year_form_start'>";
					while($starting_year <= $ending_year) {
						echo "<option value=".$starting_year.">".$starting_year."</option>";
						++$starting_year;
					}
					echo "</select>";
				?>
				to 
				<?php
					$starting_day = 1;
					$ending_day = 31;
					$starting_month = 1;
					$ending_month = 12;
					$starting_year = 2020;
					$ending_year = date("Y") + 1;
					
					echo "<select name='report_day_form_end'>";
					while($starting_day <= $ending_day) {
						echo "<option value=".$starting_day.">".$starting_day."</option>";
						++$starting_day;
					}
					echo "</select>";
					
					echo "<select name='report_month_form_end'>";
					while($starting_month <= $ending_month) {
						echo "<option value=".$starting_month.">".$starting_month."</option>";
						++$starting_month;
					}
					echo "</select>";
					
					echo "<select name='report_year_form_end'>";
					while($starting_year <= $ending_year) {
						echo "<option value=".$starting_year.">".$starting_year."</option>";
						++$starting_year;
					}
					echo "</select>";
				?>
				<br>
				<br>
				<input type="submit" value="Search">
			</form>
			<br>
			<hr>
			<br>
			<h2>Search all the reports from a client by date</h2>
			<form action="search_reports_from_client_by_dates.php" method="post">
				Clients 
					<select name="client_id_form">
						<?php
							foreach($database_connection->query('select * from clients order by clients_name') as $rowclients) {
								echo "<option value=".$rowclients['clients_id'].">".$rowclients['clients_name']."</option>";
							}
						?>
					</select>
				<br>
				<br>
				Search from 
				<?php
					$starting_day = 1;
					$ending_day = 31;
					$starting_month = 1;
					$ending_month = 12;
					$starting_year = 2020;
					$ending_year = date("Y") + 1;
					
					echo "<select name='report_day_form_start'>";
					while($starting_day <= $ending_day) {
						echo "<option value=".$starting_day.">".$starting_day."</option>";
						++$starting_day;
					}
					echo "</select>";
					
					echo "<select name='report_month_form_start'>";
					while($starting_month <= $ending_month) {
						echo "<option value=".$starting_month.">".$starting_month."</option>";
						++$starting_month;
					}
					echo "</select>";
					
					echo "<select name='report_year_form_start'>";
					while($starting_year <= $ending_year) {
						echo "<option value=".$starting_year.">".$starting_year."</option>";
						++$starting_year;
					}
					echo "</select>";
				?>
				to 
				<?php
					$starting_day = 1;
					$ending_day = 31;
					$starting_month = 1;
					$ending_month = 12;
					$starting_year = 2020;
					$ending_year = date("Y") + 1;
					
					echo "<select name='report_day_form_end'>";
					while($starting_day <= $ending_day) {
						echo "<option value=".$starting_day.">".$starting_day."</option>";
						++$starting_day;
					}
					echo "</select>";
					
					echo "<select name='report_month_form_end'>";
					while($starting_month <= $ending_month) {
						echo "<option value=".$starting_month.">".$starting_month."</option>";
						++$starting_month;
					}
					echo "</select>";
					
					echo "<select name='report_year_form_end'>";
					while($starting_year <= $ending_year) {
						echo "<option value=".$starting_year.">".$starting_year."</option>";
						++$starting_year;
					}
					echo "</select>";
				?>
				<br>
				<br>
				<input type="submit" value="Search">
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