<?PHP
	 
	require('db_connect.php');
	
	$sql = "SELECT * FROM emailer";
	$query = mysql_query($sql);
	while($row = mysql_fetch_row($query)){
		$emailer_on_off = $row[0];
		$emailer_expiration = $row[1];
		$emailer_new_ingredients = $row[2];
		$emailer_out_of_stock = $row[3];
	}
		
	/*	
	echo $emailer_on_off;
	echo '<br>';
	echo $emailer_expiration;
	echo '<br>';
	echo $emailer_new_ingredients;
	echo '<br>';
	echo $emailer_out_of_stock;
	*/
	
		
	if($emailer_on_off == 1){
		$recipients = array();
			$sql = "SELECT user_email FROM users";
				$query = mysql_query($sql);
				while($row = mysql_fetch_row($query)){
					$recipients[] = $row[0];
				}
		//var_dump($recipients);
		
		$email_subject = "Some ingredients are about to expire!";
		//$email_subject = "New ingredients are added!";
		//$email_subject = "Some ingredients are about to out of stock!";
			
		if($emailer_expiration == 1){
			
			$today = date('Y-m-d');
			$expired_ingredients_to_be_notified = array();
			
			$sql = "SELECT * FROM ingredients";
			$query = mysql_query($sql);
			while($row = mysql_fetch_row($query)){
				//compare today's date and the expiration date on the database
				$ingredient_expiration_date = $row[6];
				$ingredient_id = $row[0];
				$date1 = date_create($today);
				$date2 = date_create($ingredient_expiration_date);
				$diff = date_diff($date1,$date2);
				$diff_variable = $diff->format("%R%a");
				
				//get the list of expired ingredients
				if($diff_variable < 10){
					array_push($expired_ingredients_to_be_notified, $ingredient_id);
				}
			}
		
			//var_dump($expired_ingredients_to_be_notified);
		
		}	
		
		if(sizeof($expired_ingredients_to_be_notified) > 0){
			
			$email_message = '<html>
								<head>
									<style type="text/css">
									table{
										border-bottom: 1px solid #ddd;
										border-collapse: collapse;
										width:auto;
									}
									th {
										padding: 10px;
										border-collapse: collapse;
										border-bottom: 1px solid black;
									}

									td {
										padding: 5px;
										border-bottom: 1px solid #ddd;
										border-collapse: collapse;
										text-align: center;
									}

									table tr:nth-child(even) {
										background-color: #ddd;
									}
									table tr:nth-child(odd) {
										background-color: #fff;
									}

									</style>
								</head>
								<body>
									<a style="font-size:20px;" >Following ingredients are about to expire:</a>
									<table>
										<thead>		
											<tr>
												<th style="font-size:17px;" >Name</th>
												<th style="font-size:17px;" >Brand</th>
												<th style="font-size:17px;" >Remaining Amount</th>
												<th style="font-size:17px;" >Expiration Date</th>
												<th style="font-size:17px;" >Purchase Date</th>
												<th style="font-size:17px;" >Remaining Days</th>
											</tr>
										</thead>
										<tbody>';
											
											ob_start();
											
											$x = 0;
											while($x < sizeof($expired_ingredients_to_be_notified)){
												$current_ingredient_id = $expired_ingredients_to_be_notified[$x];
												
												
												$sql = "SELECT * FROM ingredients WHERE ingredient_id = $current_ingredient_id";
												
												$query = mysql_query($sql);
												while($row = mysql_fetch_row($query)){
													$ingredient_name = $row[2];
													$ingredient_brand = $row[3];
													$ingredient_amount = $row[4]." ".$row[5];
													$ingredient_expiration_date = $row[6];
													$ingredient_purchase_date = $row[7];
													$date1 = date_create($today);
													$date2 = date_create($ingredient_expiration_date);
													$diff = date_diff($date1,$date2);
													$diff_variable = $diff->format("%R%a");
												
													echo '
														<tr>
															<td>'.$ingredient_name.'</td> 
															<td>'.$ingredient_brand.'</td> 
															<td>'.$ingredient_amount.'</td>
															<td>'.$ingredient_expiration_date.'</td>
															<td>'.$ingredient_purchase_date.'</td>
															<td>'.$diff_variable.'</td> 
														</tr>';
												
												$x = $x + 1;
												
												}
											}
											
											echo '	
										</tbody>
									</table>
								</body>
							</html>';
			$email_message_body = ob_get_contents();
			ob_end_clean();
			
			$email_message = $email_message.$email_message_body;

			require('emailer.php');
		} else {
			echo "emailer_expiration = OFF";
			echo "<br>";
			
		}
		
	} else {
		echo "emailer = OFF";
		echo "<br>";
		
	}
?>