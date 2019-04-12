<?PHP

	$message = " ";
	
	if(isset($_POST['submit'])){
		
		//getting variables
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
		*/
		

		$query = "INSERT INTO  users (user_name, user_surname, user_username, user_email, 
		user_type) VALUES ('$user_name', '$user_surname', '$user_username', '$user_email', '$user_type')";

		mysql_query($query);

		$message = "<br><a style='color:red;'>User is successfully added!</a>";
		
	}
?>


<head>
<link rel="stylesheet" href="/css/manage_users_add.css">
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="manage_users_add" class="clearfix">
		<p id="manage_users_add_text" style="width: 900px;">
		Add Users
		<?PHP echo $message; ?>
		</p>
		<form name="change" action="" method="post" autocomplete="off">
			<label id="user_name_group">
				<p id="user_name_group_text">
				Name&#x3a;
				</p>
				<input id="user_name_input" type="text" value="" name="user_name"></input>
			</label>
			<label id="user_surname_group">
				<p id="user_surname_text">
				Surname&#x3a;
				</p>
				<input id="user_surname_input" type="text" value="" name="user_surname"></input>
			</label>
			<label id="user_username_group">
				<p id="user_username_text">
				Username&#x3a;<br />
				</p>
				<input id="user_username_input" type="text" value="" name="user_username" required="required"></input>
			</label>
			<label id="user_e-mail_group">
				<p id="user_e-mail_text">
				E-Mail Address&#x3a;
				</p>
				<input id="user_e-mail_input" type="email" value="" name="user_email"></input>
			</label>
			<label id="user_type_group">
				<p id="user_type_text">
				User Type&#x3a;
				</p>
				<select id="user_type_drop_down" type="select" name="user_type">
					<option value="normal">Normal</option>
					<option value="admin">Admin</option>
				</select>
			</label>
			<input id="save_button" type="submit" value="Save" name="submit"></input>
		</form>
	</div>
</div>
</body>

