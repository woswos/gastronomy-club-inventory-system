<?PHP
	session_start();
	 
	require('db_connect.php');
	 
	$login = $_SESSION['login'];
	
	if(!isset($_SESSION['login'])||$_SESSION['login']!= TRUE){
		$user_type = "none";
	} else {
		$user_id = $_SESSION['user_id'];
		$user_username = $_SESSION['user_username'];
		$user_name = $_SESSION['user_name'];
		$user_surname = $_SESSION['user_surname'];
		$user_email = $_SESSION['user_email'];
		$user_type = $_SESSION['user_type'];		
	}
	
?>

<!DOCTYPE html>
<html>

    <head>
	<title>Inventory System</title>
	<link rel="stylesheet" href="/css/boilerplate.css">
	<link rel="stylesheet" href="/css/index.css">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0">
    </head>
    <body>

    <div id="primaryContainer" class="primaryContainer clearfix">
        <div id="index" class="clearfix">
            <p id="hello_text">
            Hello&#x21;
            </p>
            <a href="<?PHP if($user_type == none){echo 'log_in.php';}else{echo 'navigation.php';} ?>">
                <input id="user_panel_button" type="button" value="<?PHP if($user_type == none){echo 'Log In';}else if($user_type == admin){echo 'Admin Panel';}else{echo 'User Panel';} ?>"></input>
            </a>
            <p id="welcome_text">
            Welcome to Gastronomy Club&#x27;s Inventory System
            </p>
            <div id="table" class="clearfix">
				<table>
					<thead>
						<tr>
							<th>Name&#9660;&#9650;</th>
							<th>Brand</th>
							<th>Remaining Amount</th>
							<th>Expiration Date</th>
							<th>Purchase Date</th>
							<th>Notes</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
							$sql = "SELECT * FROM ingredients ORDER BY ingredient_name ASC";
							$query = mysql_query($sql);
							while($row = mysql_fetch_row($query)){
								echo "
									<tr>
										<td>$row[2]</td> 
										<td>$row[3]</td>
										<td>$row[4] $row[5]</td>
										<td>$row[6]</td>
										<td>$row[7]</td>
										<td>$row[8]</td>
									</tr>
								";
							}
						?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
	<script type="text/javascript">
	function sortTable(table, col, reverse) {
		var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
			tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
			i;
		reverse = -((+reverse) || -1);
		tr = tr.sort(function (a, b) { // sort rows
			return reverse // `-1 *` if want opposite order
				* (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
					.localeCompare(b.cells[col].textContent.trim())
				   );
		});
		for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
	}

	function makeSortable(table) {
		var th = table.tHead, i;
		th && (th = th.rows[0]) && (th = th.cells);
		if (th) i = th.length;
		else return; // if no `<thead>` then do nothing
		while (--i >= 0) (function (i) {
			var dir = 1;
			th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
		}(i));
	}

	function makeAllSortable(parent) {
		parent = parent || document.body;
		var t = parent.getElementsByTagName('table'), i = t.length;
		while (--i >= 0) makeSortable(t[i]);
	}

	window.onload = function () {makeAllSortable();};
	</script>
    </body>
</html>
