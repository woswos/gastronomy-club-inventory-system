<?PHP
	//select an ingredient from url
	$requested_user_id = htmlspecialchars($_GET["remove"]);
	
	if($requested_user_id > 0){

		$selected_user_id = $requested_user_id; 
		
		$sql = "SELECT * FROM users WHERE user_id = '$selected_user_id'";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$selected_user_name = $row[2];
		}
	
		echo '
			<div id="myModal" class="modal">
				<div class="modal-content">
					<center>
						<p>Please Confirm to Remove "
						';
						echo $selected_user_name;
						echo '"</p>
						<br>
						<a href="user_bar_admin.php?page=manage_users&remove='; 
						echo $selected_user_id;
						echo '&confirmation=yes" >
							<input id="modal_button_yes" type="button" value="Yes"></input>
						</a>
						<a href="user_bar_admin.php?page=manage_users" >
							<input id="modal_button_no" type="button" value="No"></input>
						</a>
					</center>
				</div>
			</div>
			';
	}
	
	//removal confirmation
	$removal_confirmation = htmlspecialchars($_GET["confirmation"]);
	
	if($removal_confirmation == yes){
		
		$sql = "DELETE FROM users WHERE user_id = '$requested_user_id'";
	
		$query = mysql_query($sql);
		
		header('location:user_bar_admin.php?page=manage_users');
	}
?>
<head>
<link rel="stylesheet" href="/css/manage_users.css">
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="manage_users" class="clearfix">
		<p id="manage_users_text">
		Manage Users
		</p>
		<a href="user_bar_admin.php?page=add_users">
			<input id="add_users_button" type="button" value="Add Users"></input>
		</a>
		<a href="user_bar_admin.php?page=edit_users">
			<input id="edit_users_button" type="button" value="Edit Users"></input>
		</a>
		<div id="table" class="clearfix">
		<table>
			<thead>
				<tr>
					<th>Name&#9660;&#9650;</th>
					<th>Surname</th>
					<th>Username</th>
					<th>E-Mail</th>
					<th>User Type</th>
					<th>Modify</th>
				</tr>
			</thead>
			<tbody>
				<?PHP
					$sql = "SELECT * FROM users ORDER BY user_name ASC";
					$query = mysql_query($sql);
					while($row = mysql_fetch_row($query)){
						echo "
							<tr>
								<td>$row[2]</td> 
								<td>$row[3]</td>
								<td>$row[1]</td>
								<td>$row[5]</td>
								<td>$row[6]</td> 
								<td><a href='user_bar_admin.php?page=edit_users&user=$row[0]'>EDIT</a> / <a href='user_bar_admin.php?page=manage_users&remove=$row[0]'>REMOVE</a></td>
							</tr>
						";
					}
				?>
			</tbody>
		</table>
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
