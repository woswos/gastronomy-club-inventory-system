<?PHP
	//select an ingredient from url
	$requested_ingredient_id = htmlspecialchars($_GET["remove"]);
	
	if($requested_ingredient_id > 0){

		$selected_ingredient_id = $requested_ingredient_id; 
		
		$sql = "SELECT * FROM ingredients WHERE ingredient_id = '$selected_ingredient_id'";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$ingredient_name = $row[2];
		}
	
		echo '
			<div id="myModal" class="modal">
				<div class="modal-content">
					<center>
						<p>Please Confirm to Remove "
						';
						echo $ingredient_name;
						echo '"</p>
						<br>
						<a href="user_bar.php?page=modify_ingredients&remove='; 
						echo $selected_ingredient_id;
						echo '&confirmation=yes" >
							<input id="modal_button_yes" type="button" value="Yes"></input>
						</a>
						<a href="user_bar.php?page=modify_ingredients" >
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
		
		$sql = "DELETE FROM ingredients WHERE ingredient_id = '$requested_ingredient_id'";
	
		$query = mysql_query($sql);
		
		header('location:user_bar.php?page=modify_ingredients');
	}
?>
<head>
<link rel="stylesheet" href="/css/modify_ingredients.css">
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="modify_ingredients" class="clearfix">
		<p id="modify_ingredients_text">
		Modify Ingredients
		</p>
		<a href="user_bar.php?page=add_ingredients">
			<input id="add_ingredients_button" type="button" value="Add Ingredients"></input>
		</a>
		<a href="user_bar.php?page=edit_ingredients">
			<input id="edit_ingredients_button" type="button" value="Edit Ingredients"></input>
		</a>
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
					<th>Modify</th>
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
								<td><a href='user_bar.php?page=edit_ingredients&ingredient=$row[0]'>EDIT</a> / <a href='user_bar.php?page=modify_ingredients&remove=$row[0]'>REMOVE</a></td>
							</tr>
						";
					}
				?>
			</tbody>
		</table>
	</div>
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