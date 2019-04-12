<?PHP
	$error = " ";
	$pass_changed = FALSE;

	//updating password when submitted
	if(isset($_POST['submit'])){
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
	
		if(($pass1 == $pass2)&&($pass1 != '')){
			$pass1 = md5($pass1);
			$query = "UPDATE users SET user_password = '$pass1' WHERE user_username = '$user_username'";
			mysql_query($query);
			$error = "Your password has been successfully changed.";
			$pass_changed = TRUE;
		}else{
			$error = "Passwords don't match!";
		}
	
	}
?>

<link rel="stylesheet" href="/css/change_password.css">
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="change_password" class="clearfix">
		<form name="change" action="" method="post">
			<label id="new_password_group">
				<p id="new_password_text">
				New Password&#x3a;
				</p>
				<input id="new_password_input" type="password" value="" name="pass1"></input>
			</label>
			<label id="new_password_again_group">
				<p id="new_password_again_text">
				New Password &#x28;Again&#x29;&#x3a;
				</p>
				<input id="new_password_again_input" type="password" value="" name="pass2"></input>
			</label>
				<p id="error_text">
					<?PHP echo $error; ?>
				</p>
					<input id="change_password_button2" type="submit" value="Change Password" name="submit"></input>
		</form>
	</div>
</div>
</body>
