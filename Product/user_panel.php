<?PHP
	session_start();
	 
	require('db_connect.php');
	 
	$login = $_SESSION['login'];
	
	if(!isset($_SESSION['login'])||$_SESSION['login']!= TRUE){
		header('location:log_in.php');
	}
	
	$user_id = $_SESSION['user_id'];
	$user_username = $_SESSION['user_username'];
	$user_name = $_SESSION['user_name'];
	$user_surname = $_SESSION['user_surname'];
	$user_email = $_SESSION['user_email'];
	$user_type = $_SESSION['user_type'];
	
	//get total number of items in the kitchen
	$sql = "SELECT * FROM ingredients WHERE ingredient_amount > '0'";
	$query = mysql_query($sql);
	$item_number = mysql_num_rows($query);

	//grammar correction
	if($item_number == 0){
		$item_number_message = "There is no item in the kitchen.";
	}
	else if($item_number == 1){
		$item_number_message = "There is only one item in the kitchen.";
	}
	else{
		$item_number_message = "There are ".$item_number." different items in the kitchen.";
	}
?>

<!DOCTYPE html>
<html>

    <head>
	<title>Inventory System  | <?PHP if($user_type == normal){echo 'User';}else{echo 'Admin';} ?> Panel</title>
	<link rel="stylesheet" href="/css/boilerplate.css">
	<link rel="stylesheet" href="/css/navigation.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="user_panel" class="clearfix">
            <div id="main_box" class="clearfix">
                <p id="welcome_text">
                Welcome, <?PHP echo $user_name; ?> &#x21;
                </p>
                <p id="description_text">
                <?PHP echo $item_number_message; ?>
                </p>
                <a href="modify_ingredients.php">
                    <input id="modify_ingredients_button" type="button" value="Modify Ingredients"></input>
                </a>
                <a href="index.php">
                    <input id="home_page_button" type="button" value="Home Page"></input>
                </a
				<?PHP 
					if($user_type == admin){
						echo '
							<a href="email_settings.php">
								<input id="e-mail_settings_button" type="button" value="E-Mail Settings"></input>
							</a>
							<a href="manage_users.php">
								<input id="manage_users_button" type="button" value="Manage Users"></input>
							</a>
						';
					}
				?>
                <a href="change_password.php">
                    <input id="change_password_button" type="button" value="Change Password"></input>
                </a>
                <a href="log_out.php">
                    <input id="log_out_buttton" type="button" value="Log Out"></input>
                </a>
            </div>
        </div>
    </div>
    </body>
</html>
