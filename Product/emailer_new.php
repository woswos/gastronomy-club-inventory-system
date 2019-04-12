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
		
		//$email_subject = "Some ingredients are about to expire!";
		$email_subject = "New ingredient is added!";
		//$email_subject = "Some ingredients are about to out of stock!";
			
		if($emailer_new_ingredients == 1){
			
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
									<a style="font-size:20px;" >Following ingredient is added to the system:</a>
									<table>
										<thead>		
											<tr>
												<th style="font-size:17px;" >Name</th>
												<th style="font-size:17px;" >Brand</th>
												<th style="font-size:17px;" >Remaining Amount</th>
												<th style="font-size:17px;" >Expiration Date</th>
												<th style="font-size:17px;" >Purchase Date</th>
											</tr>
										</thead>
										<tbody>';											
											ob_start();
												echo '
													<tr>
														<td>'.$ingredient_name.'</td> 
														<td>'.$ingredient_brand.'</td> 
														<td>'.$ingredient_amount.' '.$ingredient_amount_unit.'</td>
														<td>'.$ingredient_expiration_date.'</td>
														<td>'.$ingredient_purchase_date.'</td>
													</tr>';												
											echo '	
										</tbody>
									</table>
								</body>
							</html>';
			$email_message_body = ob_get_contents();
			ob_end_clean();
			
			$email_message = $email_message.$email_message_body;
		
		}	
		
		require('emailer.php');
		
	} 

?>