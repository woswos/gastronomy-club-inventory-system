<?PHP
$dbname = "guruDB";
$dbuser = "username";
$dbpass = "password";
mysql_connect('localhost',$dbuser, $dbpass);
mysql_select_db($dbname) or die('unable to select db');
mysql_set_charset('utf8');

//echo 'no problem';
?>
