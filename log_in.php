 <?PHP
	session_start();
	 
	if($_SESSION['login'] == TRUE){
			header('location:index.php');
	}
	
	require('db_connect.php');
	 
	$error = ' ';
	
	//login check on submit
	if(isset($_POST['submit'])){
		$error = 'Wrong username or password&#x21;';
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$password = md5($password);
		
		$sql = "SELECT * FROM users WHERE user_username = '$username' AND user_password = '$password'";
		$result = mysql_query($sql);

		while($row = mysql_fetch_array($result)){
			$truepass = $row['user_password'];
			if ($password == $truepass){
				
				//store user info in the session
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['user_username'] = $row['user_username'];
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_surname'] = $row['user_surname'];
				$_SESSION['user_email'] = $row['user_email'];
				$_SESSION['user_type'] = $row['user_type'];
				$_SESSION['login'] = TRUE;
				header('location:navigation.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html>

    <head>
	<title>Inventory System  | Log In</title>
	<link rel="stylesheet" href="/css/boilerplate.css">
	<link rel="stylesheet" href="/css/log_in.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="log_in" class="clearfix">
            <p id="welcome_text">
            Welcome&#x21;
            </p>
            <p id="description_text">
            Access to the System
            </p>
			<form name="login" action="" method="post" autocomplete="off">
				<label id="username_group">
					<p id="username_text">
					Username&#x3a;
					</p>
					<input id="username_input" type="text" value="" name="username" autocomplete="off"></input>
				</label>
				<label id="password_group">
					<p id="password_text">
					Password&#x3a;
					</p>
					<input id="password_input" type="password" value="" name="password" autocomplete="off"></input>
				</label>
				<p id="error_text">
					<?PHP echo $error; ?>
				</p>
				<input id="log_in_button" type="submit" value="Log In" name="submit"></input>
				</form>
        </div>
    </div>
    </body>
</html>
