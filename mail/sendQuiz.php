<?php
$is_empty = true;
$is_empty = !empty($_POST['Телефон']);
$subject = trim(htmlspecialchars($_POST['Тема']));

if ($is_empty) {
	$subject_letter = 'Опрос с сайта evolutor!';
	$to = 'bordyuh@gmail.com';

	$table = "";
	foreach ($_POST as $name => $value) {
		$is_for_send = $value !== $subject_letter && $value !== $to;
		$name = str_replace('_', ' ', $name);
		$value = str_replace('_', ' ', $value);
		if ($is_for_send) {
			$table .= "<tr><th><b>$name: </b></th><th>$value</th></tr>";
		}
	}

	$message = "
	<html> 
			<head> 
				<title>$subject_letter</title> 
				<style>
					table {
						max-width: 700px;
						width: 100%;
						margin: 0 auto;
					}
					table td {width: 100%;}
					table th {
						width: 50%;
						padding: 15px;
						text-align: left;
						text-transform: capitalize;
						background-color: rgba(211, 211, 211, 0.37);
					}
					table th:first-child {border-right: 2px solid #000000;}
					table tr:not(:last-child) {
						border: 2px solid #000000;
						border-bottom: 0px solid #000000;
					}
					table tr:last-child{
						border-bottom: 2px solid #000000;
					}
				</style>
			</head> 
			<body>
				<table>
					$table
				</table>
			</body>
	</html>";


	$server = $_SERVER['SERVER_NAME'];
	$headers  = "From: noreply@$server;\r\n";
	$headers .= "Content-type: text/html; charset=utf-8 \r\n";

	$return_message = "";
	if (mail($to, $subject_letter, $message, $headers)) {
		$return_message = "send_success";
	} else {
		$return_message = "send_error";
	}
	echo $return_message;
	exit();
}
