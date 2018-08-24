<?php

// header
include("./functions.php");
head();

// verify credentials and content
$content = '';
if ( isset($_POST['username']) && isset($_POST['password']) )
{
	$username = addslashes(stripslashes($_POST['username']));
	$password = addslashes(stripslashes($_POST['password']));
	$password = md5($password);
	
	mysqli_select_db($db_versivo, 'versivo_octop');
	$sql_user = "SELECT * FROM `users` WHERE `username` = '".$username."' ORDER BY `id`";
	if (!$res_user = mysqli_query($db_versivo, $sql_user))
	{
		$content .= "Query error.\n"; // echo "$res<br />\n";
		$content .= "<!-- $sql_user -->\n";
	}
	else
	{
		$out_user = mysqli_fetch_array($res_user);
		if ( $password == $out_user['password'] )
		{
			if ($out_user["email"] != null)
			{
				$_SESSION["username"] = $username;
				// $sql_last = "SELECT * FROM `audit` WHERE `username` = '".$username."' ORDER BY `time` DESC LIMIT 0, 1";
				// $res_last = mysql_query($sql_last, $conn);
				// $out_last = mysql_fetch_array($res_last);
				// $last_login = date("j M Y G:i:s", $out_last["time"]);
				
				// $content .= "Welcome <b>".$_SESSION["username"]."</b>. Last login: $last_login<br />\n";
				$content .= "Welcome <b>".$_SESSION["username"]."</b>.<br />\n";
				$content .= "Go to <a href=\"./index.php\"><i>Dashboard</i></a><br />\n";
				// logging
				// audit($out_user["id"], $out_user["tenant_id"], $username, 'login', time(), 0, 0, $_SERVER['REMOTE_ADDR'], 'login.php', 'login ok', $conn);
			}
		}
		else
		{
			$content .= "Error: incorrect username or password. <a href=\"./index.php\">Retry</a>.\n";
			// logging
			// audit($out_user["id"], $out_user["tenant_id"], $username, 'login', time(), 1, 0, $_SERVER['REMOTE_ADDR'], 'login.php', 'login errata', $conn);
		}
	}
}
else
{
	$content .= "Error: invalid values. <a href=\"./index.php\">Retry</a>.\n";
	// logging
	// audit($out_user["id"], $out_user["tenant_id"], $username, 'login', time(), 1, 0, $_SERVER['REMOTE_ADDR'], 'login.php', 'empty data in form', $conn);
}
echo $content;

// footer
footer();

?>