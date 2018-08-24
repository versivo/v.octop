<?php

// header
include("./functions.php");
head();

// define user and session
$username = $_SESSION["username"];
if(isset($_SESSION["username"]))
{
	// get user info
	mysqli_select_db($db_versivo, 'versivo_octop');
	$sql_user = "SELECT * FROM `users` WHERE `username` = '".$username."' ORDER BY `id`";
	$res_user = mysqli_query($db_versivo, $sql_user);
	$out_user = mysqli_fetch_array($res_user);
	$user_id = $out_user["id"];
	$user_level = $out_user["level"];
	$customer_id = $out_user["customer"];

	// get customer info
	mysqli_select_db($db_versivo, 'versivo_octop');
	$sql_customer = "SELECT * FROM `customers` WHERE `id` = '".$customer_id."' ORDER BY `id`";
	$res_customer = mysqli_query($db_versivo, $sql_customer);
	$out_customer = mysqli_fetch_array($res_customer);
	$customer_id = $out_customer["customer_id"];
	$customer_name = $out_customer["customer_name"];
	$customer_label = $out_customer["customer_label"];

	// content
	echo "<div style=\"width: 100%; margin: 5px;\"><h1>$customer_label :: Dashboard</h1></div>\n";

	// box-left-begin
	echo "<div style=\"width: 100%; float: left; margin: 5px;\">\n";
	
		// pos01
		echo "<div id=\"pos01\" style=\"width: 100%; height: 300px; float: left; border: 1px dashed black; margin: 5px; padding: 5px;\"></div>\n";
		// pos02
		// echo "<div id=\"pos02\" style=\"width: 100%; float: left; border: 1px dashed black; margin: 5px; padding: 5px;\"></div>\n";

	echo "</div>\n";
	// box-left-end
}
else
{
	loginForm();
}

footer();

?>