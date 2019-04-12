<?PHP

	$message = " ";
	$selected = FALSE;


	//select an user from url
	$requested_user_id = htmlspecialchars($_GET["user"]);
	
	if($requested_user_id > 0){

		$selected_user_id = $requested_user_id;
		
		$_SESSION['selected_user_id'] = $selected_user_id;
		
		$sql = "SELECT * FROM users WHERE user_id = '$selected_user_id'";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$user_name_search = $row[2];
			$user_surname_search = $row[3];
			$user_username_search = $row[1];
			$user_email_search = $row[5];
			$user_type_search = $row[6];
		}
		
		$selected = TRUE;
	}
	
	
	//select an user to edit
	if(isset($_POST['submit'])){
	
		$selected_user_id = $_POST['selected_user_id'];
		
		$_SESSION['selected_user_id'] = $selected_user_id;
		
		$sql = "SELECT * FROM users WHERE user_id = '$selected_user_id'";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$user_name_search = $row[2];
			$user_surname_search = $row[3];
			$user_username_search = $row[1];
			$user_email_search = $row[5];
			$user_type_search = $row[6];
		}
		
		$selected = TRUE;
	}
	
	
	//edit selected user
	if(isset($_POST['submit2'])){
		
		//getting variables
		$user_id = $_SESSION['selected_user_id'];
		$user_name = $_POST['user_name'];
		$user_surname = $_POST['user_surname'];
		$user_username = $_POST['user_username'];
		$user_email = $_POST['user_email'];
		$user_type = $_POST['user_type'];
	
		/*
		echo $user_name;
		echo '<br>';
		echo $user_surname;
		echo '<br>';
		echo $user_username;
		echo '<br>';
		echo $user_email;
		echo '<br>';
		echo $user_type;
		echo '<br>';
		*/
		

		$query = "UPDATE users SET user_name = '$user_name', user_surname = '$user_surname', user_username = '$user_username', 
		user_email = '$user_email', user_type = '$user_type' WHERE user_id = '$user_id'";
	
		mysql_query($query);
		
		$message = "<a style='color:red;'>Ingredient is successfully edited!</a>";
	}
	
?>

<head>
<link rel="stylesheet" href="/css/manage_users_edit.css">
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="manage_users_edit" class="clearfix">
		<p id="manage_users_edit_text">
		Edit Users<br />
		<?PHP echo $message; ?>
		</p>
		<form name="select" action="" method="post" autocomplete="off">
			<label id="select_users_group">
				<p id="select_users_text">
				Select an user to edit
				</p>
				<select id="select_users_drop_down" type="select" name="selected_user_id">
					<?PHP
						//getting avaliable users
						$sql = "SELECT user_username, user_id FROM users";
						$query = mysql_query($sql);
						while($row = mysql_fetch_row($query)){
							echo " <option value='";
							echo $row[1];
							echo "'>";
							echo $row[0];
							echo "</option>"; 
						}
					?>
				</select>
			</label>
			<input id="select_users_button" type="submit" name="submit" value="Select"></input>
		</form>
		<form name="save" action="" method="post" autocomplete="off">
			<label id="user_name_group">
				<p id="user_name_text">
				Name&#x3a;
				</p>
				<input id="user_name_input" type="text" value="<?PHP echo $user_name_search; ?>" name="user_name"></input>
			</label>
			<label id="user_surname_group">
				<p id="user_surname_text">
				Surname&#x3a;
				</p>
				<input id="user_surname_input" type="text" value="<?PHP echo $user_surname_search; ?>" name="user_surname"></input>
			</label>
			<label id="user_username_group">
				<p id="user_username_text">
				Username&#x3a;
				</p>
				<input id="user_username_input" type="text" value="<?PHP echo $user_username_search; ?>" name="user_username"></input>
			</label>
			<label id="user_e-mail_group">
				<p id="user_e-mail_text">
				E-Mail Address&#x3a;
				</p>
				<input id="user_e-mail_input" type="text" value="<?PHP echo $user_email_search; ?>" name="user_email"></input>
			</label>
			<label id="user_e-mail_group1">
				<p id="user_e-mail_text1">
				User Type&#x3a;<br />
				</p>
				<select id="user_e-mail_drop_down" type="select" name="user_type">
				<option value="normal" <?PHP if($user_type_search == "normal") { echo "selected='yes'"; } ?> >Normal</option>
				<option value="admin" <?PHP if($user_type_search == "admin") { echo "selected='yes'"; } ?> >Admin</option>
				</select>
			</label>
			<input id="save_button" type="submit" value="Save" name="submit2" <?PHP if($selected == FALSE){ echo "disabled='disabled'";} ?>></input>
		</form>
	</div>
</div>
</body>
