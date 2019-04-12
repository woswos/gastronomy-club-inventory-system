<?PHP

	$message = " ";
	$selected = FALSE;
	
	//select an ingredient from url
	$requested_ingredient_id = htmlspecialchars($_GET["ingredient"]);
	if($requested_ingredient_id > 0){

		$selected_ingredient_id = $requested_ingredient_id;
	
		$_SESSION['selected_ingredient_id'] = $selected_ingredient_id;
		
		$sql = "SELECT * FROM ingredients WHERE ingredient_id = '$selected_ingredient_id'";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$ingredient_name = $row[2];
			$ingredient_brand = $row[3];
			$ingredient_amount = $row[4];
			$ingredient_amount_unit = $row[5];
			$ingredient_expiration_date = $row[6];
			$ingredient_purchase_date = $row[7];
			$ingredient_note = $row[8];
		}
		
		$selected = TRUE;
	}
	
	//select an ingredient to edit
	if(isset($_POST['submit'])){

		$selected_ingredient_id = $_POST['selected_ingredient'];
	
		$_SESSION['selected_ingredient_id'] = $selected_ingredient_id;
		
		$sql = "SELECT * FROM ingredients WHERE ingredient_id = '$selected_ingredient_id'";
	
		$query = mysql_query($sql);
		while($row = mysql_fetch_row($query)){
			$ingredient_name = $row[2];
			$ingredient_brand = $row[3];
			$ingredient_amount = $row[4];
			$ingredient_amount_unit = $row[5];
			$ingredient_expiration_date = $row[6];
			$ingredient_purchase_date = $row[7];
			$ingredient_note = $row[8];
			
			$ingredient_amount_previous = $row[4];
			
			$_SESSION['ingredient_amount_previous'] = $ingredient_amount_previous;
		}
		
		$selected = TRUE;
	}
	
	//edit selected ingredient
	if(isset($_POST['submit2'])){
		
		//getting variables
		$ingredient_id = $_SESSION['selected_ingredient_id'];
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
		echo $ingredient_amount_unit;
		echo '<br>';
		echo $ingredient_unit;
		echo '<br>';
		echo $ingredient_expiration_date;
		echo '<br>';
		echo $ingredient_purchase_date;
		echo '<br>';
		echo $ingredient_note;
		*/
		

		$query = "UPDATE ingredients SET user_id = '$user_id', ingredient_name = '$ingredient_name', ingredient_brand = '$ingredient_brand', ingredient_amount = '$ingredient_amount', 
		ingredient_amount_unit = '$ingredient_amount_unit', ingredient_expiration_date = '$ingredient_expiration_date', ingredient_purchase_date = '$ingredient_purchase_date', 
		ingredient_note = '$ingredient_note' WHERE ingredient_id = '$ingredient_id'";
	
		mysql_query($query);
		
		$ingredient_amount_previous = $_SESSION['ingredient_amount_previous'];
		
		$ingredient_amount_previous = 0.25*$ingredient_amount_previous;
		
		if($ingredient_amount < $ingredient_amount_previous){
			
			require('emailer_out_of_stock.php');
			
		}
				
		$message = "<br><a style='color:red;'>Ingredient is successfully edited!</a>";
		
	}
	
?>
<head>
<link rel="stylesheet" href="/css/modify_ingredients_edit.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	 $( function() {
		$( "#ingredient_expiration_input" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
	 } );
	 $( function() {
		$( "#ingredient_expiration_input1" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
	 } );
 </script>
</head>
<body>

<div id="primaryContainer" class="primaryContainer clearfix">
	<div id="modify_ingredients_edit" class="clearfix">
		<p id="modify_ingredients_edit_text">
		Edit Ingredients
		<?PHP echo $message; ?>
		</p>
		
		<form name="select" action="" method="post" autocomplete="off">
			<label id="select_ingeredient_group">
				<p id="select_ingeredient_text">
				Select an ingredient to edit
				</p>
				<select id="select_ingeredient_drop_down" type="select" name="selected_ingredient">
					<?PHP
						//getting avaliable ingredients
						$sql = "SELECT ingredient_name, ingredient_id FROM ingredients";
						$query = mysql_query($sql);
						while($row = mysql_fetch_row($query)){
							echo " <option value='";
							echo $row[1];
							echo "'>";
							echo $row[0];
							echo "</option>"; 
						}
					?>
				</select>
			</label>
			<input id="select_ingeredient_button" type="submit" name="submit" value="Select"></input>
		</form>
		<form name="save" action="" method="post" autocomplete="off">
			<label id="ingredient_name_group">
				<p id="ingredient_name_text">
				Name of the Ingredient&#x3a;
				</p>
				<input id="ingredient_name_input" type="text" value="<?PHP echo $ingredient_name; ?>" name="ingredient_name" required="required"></input>
			</label>
			<label id="ingredient_brand_group">
				<p id="ingredient_brand_text">
				Brand&#x3a;<br />
				</p>
				<input id="ingredient_brand_input" type="text" value="<?PHP echo $ingredient_brand; ?>" name="ingredient_brand"></input>
			</label>
			<label id="ingredient_unit_group">
				<p id="ingredient_unit_text">
				Measurement Unit&#x3a;
				</p>
				<select id="ingredient_unit_drop_down" type="select" name="ingredient_amount_unit">
					<option value="Kilogram" <?PHP if($ingredient_amount_unit == "Kilogram") { echo "selected='yes'"; } ?> >Kilogram</option>
					<option value="Gram" <?PHP if($ingredient_amount_unit == "Gram") { echo "selected='yes'"; } ?> >Gram</option>
					<option value="Piece" <?PHP if($ingredient_amount_unit == "Piece") { echo "selected='yes'"; } ?> >Piece</option>
					<option value="Liter" <?PHP if($ingredient_amount_unit == "Liter") { echo "selected='yes'"; } ?> >Liter</option>
					<option value="Milliliter" <?PHP if($ingredient_amount_unit == "Milliliter") { echo "selected='yes'"; } ?> >Milliliter</option>
					<option value="Centimeter" <?PHP if($ingredient_amount_unit == "Centimeter") { echo "selected='yes'"; } ?> >Centimeter</option>
					<option value="Meter" <?PHP if($ingredient_amount_unit == "Meter") { echo "selected='yes'"; } ?> >Meter</option>
					<option value="Gallon" <?PHP if($ingredient_amount_unit == "Gallon") { echo "selected='yes'"; } ?> >Gallon</option>
					<option value="Ounce" <?PHP if($ingredient_amount_unit == "Ounce") { echo "selected='yes'"; } ?> >Ounce</option>
					<option value="Pint" <?PHP if($ingredient_amount_unit == "Pint") { echo "selected='yes'"; } ?> >Pint</option>
					<option value="Libre" <?PHP if($ingredient_amount_unit == "Libre") { echo "selected='yes'"; } ?> >Libre</option>
					<option value="Teaspoon" <?PHP if($ingredient_amount_unit == "Teaspoon") { echo "selected='yes'"; } ?> >Teaspoon</option>
					<option value="Tablespoon" <?PHP if($ingredient_amount_unit == "Tablespoon") { echo "selected='yes'"; } ?> >Tablespoon</option>
					<option value="1 Cup" <?PHP if($ingredient_amount_unit == "1 Cup") { echo "selected='yes'"; } ?> >1 Cup</option>
					<option value="1/2 Cup" <?PHP if($ingredient_amount_unit == "1/2 Cup") { echo "selected='yes'"; } ?> >1/2 Cup</option>
					<option value="1/4 Cup" <?PHP if($ingredient_amount_unit == "1/4 Cup") { echo "selected='yes'"; } ?> >1/4 Cup</option>
				</select>
			</label>
			<label id="ingredient_remaining_group">
				<p id="ingredient_unit_text1">
				Remaining Amount&#x3a;<br />
				</p>
				<input id="ingredient_unit_input" type="text" value="<?PHP echo $ingredient_amount; ?>" name="ingredient_amount"></input>
			</label>
			<label id="ingredient_expiration_group">
				<p id="ingredient_expiration_text">
				Expiration Date&#x3a;
				</p>
				<input id="ingredient_expiration_input" type="text" value="<?PHP echo $ingredient_expiration_date; ?>" name="ingredient_expiration_date"></input>
			</label>
			<label id="ingredient_expiration_group">
				<p id="ingredient_expiration_text">
				Purchase Date&#x3a;
				</p>
				<input id="ingredient_expiration_input1" type="text" value="<?PHP echo $ingredient_purchase_date; ?>" name="ingredient_purchase_date"></input>
			</label>
			<label id="ingredient_notes_group">
				<p id="ingredient_notes_text">
				Notes&#x3a;<br />
				</p>
				<textarea id="ingredient_notes_input" name="ingredient_note"><?PHP echo $ingredient_note; ?></textarea>
			</label>
			<input id="save_button" type="submit" name="submit2" value="Save" <?PHP if($selected == FALSE){ echo "disabled='disabled'";} ?>></input>
		</form>
	</div>
</div>
</body>
