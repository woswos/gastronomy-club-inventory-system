<?PHP

	$message = " ";
	
	if(isset($_POST['submit'])){
		
		//getting variables
		$ingredient_name = $_POST['ingredient_name'];
		$user_id = $_SESSION['user_id'];
		$ingredient_brand = $_POST['ingredient_brand'];
		$ingredient_amount = $_POST['ingredient_amount'];
		$ingredient_amount_unit = $_POST['ingredient_amount_unit'];
		$ingredient_expiration_date = $_POST['ingredient_expiration_date'];
		$ingredient_purchase_date = $_POST['ingredient_purchase_date'];
		$ingredient_note = $_POST['ingredient_note'];
	
		/*
		echo $ingredient_name;
		echo '<br>';
		echo $user_id;
		echo '<br>';
		echo $ingredient_brand;
		echo '<br>';
		echo $ingredient_amount;
		echo '<br>';
		echo $ingredient_unit;
		echo '<br>';
		echo $ingredient_expiration_date;
		echo '<br>';
		echo $ingredient_purchase_date;
		echo '<br>';
		echo $ingredient_note;
		*/
		

		$query = "INSERT INTO  ingredients (user_id, ingredient_name, ingredient_brand, ingredient_amount, 
		ingredient_amount_unit, ingredient_expiration_date, ingredient_purchase_date, ingredient_note) 
		VALUES ('$user_id', '$ingredient_name', '$ingredient_brand', '$ingredient_amount', '$ingredient_amount_unit', 
		'$ingredient_expiration_date', '$ingredient_purchase_date', '$ingredient_note')";

		mysql_query($query);

		require('emailer_new.php');
				
		$message = "<br><a style='color:red;'>Ingredient is successfully added!</a>";
		
	}
?>

<head>
<link rel="stylesheet" href="/css/modify_ingredients_add.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	 $( function() {
		$( "#ingredient_remaining_input1" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
	 } );
	 $( function() {
		$( "#ingredient_remaining_input12" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
	 } );
 </script>
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="modify_ingredients_add" class="clearfix">
		<p id="modify_ingredients_add_text">
		Add&nbsp;Ingredients 
		<?PHP echo $message; ?>
		</p>
		<form name="change" action="" method="post" autocomplete="off">
			<label id="ingredient_name_group">
				<p id="ingredient_name_text">
				Name of the Ingredient&#x3a;
				</p>
				<input id="ingredient_name_input" type="text" value="" name="ingredient_name" required="required"></input>
			</label>
			<label id="ingredient_brand_group">
				<p id="ingredient_brand_text">
				Brand&#x3a;<br />
				</p>
				<input id="ingredient_brand_input" type="text" value="" name="ingredient_brand"></input>
			</label>
			<label id="ingredient_unit_group">
				<p id="ingredient_unit_text">
				Measurement Unit&#x3a;
				</p>
				<select id="ingredient_unit_drop_down" type="select" name="ingredient_amount_unit">
					<option>Kilogram</option>
					<option>Gram</option>
					<option>Piece</option>
					<option>Liter</option>
					<option>Milliliter</option>
					<option>Centimeter</option>
					<option>Meter</option>
					<option>Gallon</option>
					<option>Ounce</option>
					<option>Pint</option>
					<option>Libre</option>
					<option>Teaspoon</option>
					<option>Tablespoon</option>
					<option>1 Cup</option>
					<option>1/2 Cup</option>
					<option>1/4 Cup</option>
				</select>
			</label>
			<label id="ingredient_remaining_group">
				<p id="ingredient_remaining_text">
				Remaining Amount&#x3a;<br />
				</p>
				<input id="ingredient_remaining_input" required="required" type="text" value="" name="ingredient_amount" class="date_picker"></input>
			</label>
			<label id="ingredient_expiration_group">
				<p id="ingredient_remaining_text1">
				Expiration Date&#x3a;
				</p>
				<input id="ingredient_remaining_input1" type="text" value="" name="ingredient_expiration_date" class="date_picker"></input>
			</label>
			<label id="ingredient_expiration_group">
				<p id="ingredient_remaining_text1">
				Purchase Date&#x3a;
				</p>
				<input id="ingredient_remaining_input12" required="required" type="text" value="" name="ingredient_purchase_date"></input>
			</label>
			<label id="ingredient_notes_group">
				<p id="ingredient_notes_text">
				Notes&#x3a;<br />
				</p>
				<textarea id="ingredient_notes_input" name="ingredient_note"></textarea>
			</label>
				<input id="save_button" type="submit" name="submit" value="Save"></input>
		</form>
	</div>
</div>
</body>