<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Edit report</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel=stylesheet href="../style.css" type="text/css" />
</head>

<?php
	function yes_no_menu($option) {
		if($option == 0) {
			echo "<option value = 0 selected>Not received yet</option>";
			echo "<option value = 1>Received</option>";
		}
		else {
			echo "<option value = 0>Not received yet</option>";
			echo "<option value = 1 selected>Received</option>";
		}
	}
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
				}
					?>
					<form action="reports_update.php" method="post">
						<input type="hidden" name="id_report_form" value="
							<?php
								echo $report_id;
							?>
						">
						<p>Client 
							<select name="client_form">
								<?php
									foreach($database_connection->query('select * from clients order by clients_name') as $rowclient) {
										if($row['reports_client_id'] == $rowclient['clients_id']) {
											echo "<option value=".$rowclient['clients_id']." selected>".$rowclient['clients_name']."</option>";
										}
										else{
											echo "<option value=".$rowclient['clients_id'].">".$rowclient['clients_name']."</option>";
										}
									}
								?>
							</select>
						</p>

						<p>Report title <textarea name="report_title_form" cols=80 rows=1><?php echo $row['reports_title'];?></textarea></p>

						<p>Report state 
							<select name="report_state_form">
								<?php
									foreach($database_connection->query('select * from reports_state order by reports_state_id') as $rowstate) {
										if($row['reports_state'] == $rowstate['reports_state_id']) {
											echo "<option value=".$rowstate['reports_state_id']." selected>".$rowstate['reports_state_description']."</option>";
										}
										else{
											echo "<option value=".$rowstate['reports_state_id'].">".$rowstate['reports_state_description']."</option>";
										}
									}
								?>
							</select>
						</p>

						<p>Report date 
							<?php
								$report_day = date("d", strtotime($row['reports_date']));
								$report_month = date("m", strtotime($row['reports_date']));
								$report_year = date("Y", strtotime($row['reports_date']));
								$starting_day = 1;
								$ending_day = 31;
								$starting_month = 1;
								$ending_month = 12;
								$starting_year = 2020;
								$ending_year = date("Y") + 1;
								
								echo "<select name='report_day_form'>";
								while($starting_day <= $ending_day) {
									if($starting_day == $report_day) {
										echo "<option value=".$starting_day." selected>".$starting_day."</option>";
									}
									else {
										echo "<option value=".$starting_day.">".$starting_day."</option>";
									}
									
									++$starting_day;
								}
								echo "</select>";
								
								echo "<select name='report_month_form'>";
								while($starting_month <= $ending_month) {
									if($starting_month == $report_month) {
										echo "<option value=".$starting_month." selected>".$starting_month."</option>";
									}
									else {
										echo "<option value=".$starting_month.">".$starting_month."</option>";
									}
									
									++$starting_month;
								}
								echo "</select>";
								
								echo "<select name='report_year_form'>";
								while($starting_year <= $ending_year) {
									if($starting_year == $report_year) {
										echo "<option value=".$starting_year." selected>".$starting_year."</option>";
									}
									else {
										echo "<option value=".$starting_year.">".$starting_year."</option>";
									}
									
									++$starting_year;
								}
								echo "</select>";
							?>
						</p>

						<br>
						<hr>
						<br>
						<p><b>Necessary documents</b></p>
						
						<p>Invoice 
							<select name="invoice_form">
							<?php
								yes_no_menu($row['reports_invoice']);
							?>
							</select>
						</p>

						<p>Photos 
							<select name="photos_form">
							<?php
								yes_no_menu($row['reports_photos']);
							?>
							</select>
						</p>

						<p>Invoice 
							<select name="authorisation_form">
							<?php
								yes_no_menu($row['reports_authorisation']);
							?>
							</select>
						</p>

						<br>
						<input type="submit" value="Edit report">
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
