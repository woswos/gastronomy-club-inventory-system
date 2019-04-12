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
	
	if($requested_page_id == modify_ingredients){
		$page_name = "Modif Ingredients";
	} else if($requested_page_id == change_password){
		$page_name = "Change Password";
	} else if($requested_page_id == add_ingredients){
		$page_name = "Add Ingredients";
	} else if($requested_page_id == edit_ingredients){
		$page_name = "Edit Ingredients";
	} else{
		header('location:user_bar.php?page=modify_ingredients');
	}
?>

<!DOCTYPE html>
<html>

    <head>
	<title>Inventory System  | <?PHP echo $page_name; ?></title>
	<link rel="stylesheet" href="/css/boilerplate.css">
	<link rel="stylesheet" href="/css/user_bar.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix" >
        <div id="user_bar" class="clearfix">
            <div id="main" class="clearfix">
                <p id="modify_ingredients_button">
					<a href="user_bar.php?page=modify_ingredients">
						Modify Ingredients
					</a>
                </p>
                <p id="seperator">
                &#x7c;<br />
                </p>
                <p id="home_page_button">
					<a href="index.php">
						Home Page
					</a>
                </p>
                <p id="seperator1">
                &#x7c;<br />
                </p>
                <p id="change_password_button">
					<a href="user_bar.php?page=change_password">
						Change Password
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
					if($requested_page_id == modify_ingredients){
						require('modify_ingredients.php');
					}else if($requested_page_id == change_password){
						require('change_password.php');
					} else if($requested_page_id == add_ingredients){
						require('modify_ingredients_add.php');
					} else if($requested_page_id == edit_ingredients){
						require('modify_ingredients_edit.php');
					}
				?>	
			</div>			
        </div>
    </div>
    </body>
</html>
