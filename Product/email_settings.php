<?PHP

	$message = " ";
		
	$sql = "SELECT * FROM emailer";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$emailer_on_off = $row[0];
			$emailer_expiration = $row[1];
			$emailer_new_ingredients = $row[2];
			$emailer_out_of_stock = $row[3];
		}
		
	if(isset($_POST['submit'])){
		
		//getting variables
		$emailer_on_off = $_POST['emailer_on_off'];
		if($emailer_on_off == "on"){
			$emailer_on_off = 1;
		} else {
			$emailer_on_off = 0;
		}
		$emailer_expiration = $_POST['emailer_expiration'];
		if($emailer_expiration == "on"){
			$emailer_expiration = 1;
		} else {
			$emailer_expiration = 0;
		}
		$emailer_new_ingredients = $_POST['emailer_new_ingredients'];
		if($emailer_new_ingredients == "on"){
			$emailer_new_ingredients = 1;
		} else {
			$emailer_new_ingredients = 0;
		}
		$emailer_out_of_stock = $_POST['emailer_out_of_stock'];
		if($emailer_out_of_stock == "on"){
			$emailer_out_of_stock = 1;
		} else {
			$emailer_out_of_stock = 0;
		}

		/*
		echo $emailer_on_off;
		echo '<br>';
		echo $emailer_expiration;
		echo '<br>';
		echo $emailer_new_ingredients;
		echo '<br>';
		echo $emailer_out_of_stock;
		*/
	
		$query = "UPDATE emailer SET emailer_on_off = '$emailer_on_off', emailer_expiration = '$emailer_expiration', emailer_new_ingredients = '$emailer_new_ingredients', emailer_out_of_stock = '$emailer_out_of_stock' ";
		mysql_query($query);
		
		$message = "<br><b><a style='color:red;'>Settings successfully saved !</a></b>";
		
	}
?>

<head>
<link rel="stylesheet" href="/css/email_settings.css">
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="e-mail_settings" class="clearfix">
		<p id="e-mail_settings_text">
		E-Mail Settings
		</p>
		<form name="change" action="" method="post" autocomplete="off">
			<label id="e-mail_system_on_off_group">
				<p id="e-mail_system_on_off_text">
				E-Mailing system ON&#x2f;OFF
				</p>
				<label class="switch">
					<input type="checkbox" style="display:none" id="e-mail_system_on_off_checkbox" name="emailer_on_off" <?PHP if($emailer_on_off == "1") { echo "checked='checked'"; }?> ></input>
					<div class="slider round"></div>
				</label>
			</label>
			<label id="e-mail_system_expiration_group">
				<p id="e-mail_system_expiration_text">
				Notify by e-mail for expiration dates
				</p>
				<label class="switch">
					<input type="checkbox" style="display:none" id="e-mail_system_expiration_input" name="emailer_expiration" <?PHP if($emailer_expiration == "1") { echo "checked='checked'"; }?> ></input>
					<div class="slider round"></div>
				</label>
			</label>
			<label id="e-mail_system_new_added_group">
				<p id="e-mail_system_new_added_text">
				Notify by e-mail for new added ingredients
				</p>
				<label class="switch">
					<input type="checkbox" style="display:none" id="e-mail_system_new_added_checkbox" name="emailer_new_ingredients" <?PHP if($emailer_new_ingredients == "1") { echo "checked='checked'"; }?> ></input>
					<div class="slider round"></div>
				</label>
			</label>
			<label id="e-mail_system_out_of_stock_group">
				<p id="e-mail_system_out_of_stock_text">
				Notify by e-mail for ingredients out of stock
				</p>
				<label class="switch">
					<input type="checkbox" style="display:none" id="e-mail_system_out_of_stock_checkbox" name="emailer_out_of_stock" <?PHP if($emailer_out_of_stock == "1") { echo "checked='checked'"; }?> ></input>
					<div class="slider round"></div>
				</label>
			</label>
			<!--
				<label id="e-mail_system_recipients_group">
					<p id="e-mail_system_recipients_text">
					E-Mail Recipient&#x28;s&#x29; [Seperate emails by using ";"]&#x3a;<br />
					</p>
					<textarea id="e-mail_system_recipients_input" type="text" value=""></textarea>
				</label>
				<label id="e-mail_system_subject_line_group">
					<p id="e-mail_system_subject_line_text">
					Subject line for the e-mail&#x3a;
					</p>
					<input id="e-mail_system_subject_line_input" type="text" value=""></input>
				</label>
			-->
			<p><?PHP echo $message; ?></p>
			<a href="email_settings.html">
				<input id="save_settings_button" type="submit" name="submit" value="Save Settings"></input>
			</a>
		</form>
	</div>
</div>
</body>
