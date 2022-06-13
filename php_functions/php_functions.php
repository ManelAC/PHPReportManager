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
	
	function availability_print($option) {
		if($option == 0) {
			echo "<td>Not received yet</td>";
		}
		else {
			echo "<td>Received</td>";
		}
	}
	
	function ready_to_be_done($var_title, $var_invoice, $var_photos, $var_authorisation) {
		if($var_invoice == 1 and $var_photos == 1 and $var_authorisation == 1) {
			echo "<td><font color=red><b>".$var_title."</b></font></td>";
		}
		else {
			echo "<td>".$var_title."</td>";
		}
	}
	
	function received_or_not($option) {
		if($option == 0) {
			echo "Not received yet";
		}
		else {
			echo "Received";
		}
	}
?>