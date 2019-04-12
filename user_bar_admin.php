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
	
	$requested_page_id = htmlspecialchars($_GET["page"]);
	
	if($requested_page_id == "e-mail_settings"){
		$page_name = "E-Mail Settings";
	} else if($requested_page_id == "manage_users"){
		$page_name = "Manage Users";
	} else if($requested_page_id == "add_users"){
		$page_name = "Add Users";
	} else if($requested_page_id == "edit_users"){
		$page_name = "Edit Users";
	} else{
		header('location:user_bar_admin.php?page=e-mail_settings');
	}
	
?>

<!DOCTYPE html>
<html>

    <head>
	<title>Inventory System  | <?PHP echo $page_name; ?></title>
	<link rel="stylesheet" href="/css/boilerplate.css">
	<link rel="stylesheet" href="/css/user_bar_admin.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="user_bar_admin" class="clearfix">
            <div id="main" class="clearfix">
                <p id="e-mail_settings_button">
					<a href="user_bar_admin.php?page=e-mail_settings">
						E-Mail Settings
					</a>
                </p>
                <p id="seperator">
                &#x7c;<br />
                </p>
                <p id="manage_users_button">
					<a href="user_bar_admin.php?page=manage_users">
						Manage Users
					</a>
                </p>
                <p id="seperator1">
                &#x7c;<br />
                </p>
                <p id="home_page_button">
					<a href="index.php">
						Home Page
					</a>
                </p>
                <p id="seperator2">
                &#x7c;<br />
                </p>
                <p id="log_out_button">
					<a href="log_out.php">
						Log Out
					</a>
                </p>
				<?PHP 
					if($requested_page_id == "e-mail_settings"){
						require('email_settings.php');
					}else if($requested_page_id == "manage_users"){
						require('manage_users.php');
					} else if($requested_page_id == "add_users"){
						require('manage_users_add.php');
					} else if($requested_page_id == "edit_users"){
						require('manage_users_edit.php');
					}
				?>	
            </div>
        </div>
    </div>
    </body>
</html>
