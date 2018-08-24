<?php

/* file di funzioni */
error_reporting(E_ERROR | E_PARSE);

/* STATIC VAR */
$dbhost_versivo = '';
$dbuser_versivo = '';
$dbpass_versivo = '';
$dbhost_nedi = '';
$dbuser_nedi = '';
$dbpass_nedi = '';

/* DB */
$db_versivo = mysql_connect($dbhost_versivo, $dbuser_versivo, $dbpass_versivo);
$db_nedi = mysql_connect($dbhost_nedi, $dbuser_nedi, $dbpass_nedi);

/* session manager */
session_start();

/* header tpl */
function head()
{
	// session_start();
	echo "<!DOCTYPE html>\n";
	echo "<html lang=\"en\">\n";
	echo "<head>\n";
	echo "<meta charset=\"utf-8\">\n";
	echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
	echo "<meta name=\"viewport\" content=\"width=device-width, shrink-to-fit=no, initial-scale=1\">\n";
	echo "<meta name=\"description\" content=\"Versivo Octopus Datacenter Dashboard\">\n";
	echo "<meta name=\"author\" content=\"VERSIVO - http://www.versivo.it\">\n";
	echo "<title>[VERSIVO] Octopus</title>\n";
	echo "<link href=\"css/bootstrap.css\" rel=\"stylesheet\">\n";
	echo "<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n";
	echo "<link href=\"css/simple-sidebar.css\" rel=\"stylesheet\">\n";
	echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js\"></script>\n";
	echo "<!--[if lt IE 9]>\n";
	echo "<script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>\n";
	echo "<script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>\n";
	echo "<![endif]-->\n";
	echo "</head>\n";
	echo "<body>\n";
	echo "<div id=\"wrapper\">\n";
	echo "<!-- Sidebar -->\n";
	echo "<div id=\"sidebar-wrapper\">\n";
	echo "<ul class=\"sidebar-nav\">\n";
	if ($_SESSION["username"] != null)
	{
		echo "<br />\n";
		echo "<li><a href=\"./index.php\">Dashboard</a></li>\n";
		echo "<li><a href=\"./radio_net.php\">Radio Network</a></li>\n";
		echo "<li><a href=\"./backbone_net.php\">Backbone Network</a></li>\n";
		echo "<li><a href=\"./virtual_env.php\">Virtual Environment</a></li>\n";
		echo "<li><a href=\"./backup_env.php\">Backup Environment</a></li>\n";
		echo "<hr />\n";
		echo "<li><a href=\"./logout.php\">Logout</a></li>\n";
	}
	echo "</ul>\n";
	echo "</div>\n";
	echo "<!-- /#sidebar-wrapper -->\n";
	echo "<!-- Page Content -->\n";
	echo "<div id=\"page-content-wrapper\">\n";
	echo "<div class=\"container-fluid\">\n";
	echo "<div class=\"row\">\n";
	echo "<div class=\"col-lg-12\">\n";
}

function footer()
{
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "<!-- /#page-content-wrapper -->\n";
	echo "</div>\n";
	echo "<!-- /#wrapper -->\n";
	echo "<!-- jQuery -->\n";
	echo "<script src=\"js/jquery.js\"></script>\n";
	echo "<!-- Bootstrap Core JavaScript -->\n";
	echo "<script src=\"js/bootstrap.min.js\"></script>\n";
	echo "<!-- Menu Toggle Script -->\n";
	echo "<script>\n";
	echo "$(\"#menu-toggle\").click(function(e) {\n";
	echo "e.preventDefault();\n";
	echo "$(\"#wrapper\").toggleClass(\"toggled\");\n";
	echo "});\n";
	echo "</script>\n";
	echo "</body>\n";
	echo "</html>\n";
}

function audit($user_id, $tenant_id, $username, $action, $time, $y_alert, $r_alert, $ip, $page, $msg, $conn)
{
	if ($user_id == null) { $user_id = 0; }
	if ($tenant_id == null) { $tenant_id = 0; }
	if ($username == null) { $username = 'anonymous'; }

	mysql_select_db('pl_main', $conn);
	$sql_audit = "INSERT INTO `audit`
		(`user_id`, `tenant_id`, `username`, `action`, `time`, `y_alert`, `r_alert`, `ip`, `page`, `msg`) VALUES
		('$user_id', '$tenant_id', '$username', '$action', '$time', '$y_alert', '$r_alert', '$ip', '$page', '$msg')";
	$res_audit = mysql_query($sql_audit, $conn);
}

function loginForm()
{
	echo "<p align=\"center\"><b>v.octop login page</b></p>\n";
	echo "<br />\n";	
	echo "<form action=\"./login.php\" method=\"post\">\n";
	echo "<p align=\"center\"><input type=\"text\" name=\"username\" size=\"50\" style=\"border: 1px solid black; width: 350px; height: 50px;\" /></p>\n";
	echo "<p align=\"center\"><input type=\"password\" name=\"password\" size=\"50\" style=\"border: 1px solid black; width: 350px; height: 50px;\" /></p>\n";
	echo "<p align=\"center\"><input type=\"submit\" name=\"login\" value=\"| login |\" style=\"border: 1px solid black; width: 350px; height: 50px;\" /></p>\n";
}

function content($page_content, $username)
{
	if ($_SESSION["username"] != null)
	{
		print($page_content);
	}
	else
	{
		echo "<p align=\"center\"><b>v.octop login page</b></p>\n";
		echo "<br />\n";
		echo "<form action=\"./login.php\" method=\"post\">\n";
		echo "<p align=\"center\"><input type=\"text\" name=\"username\" size=\"50\" style=\"border: 1px solid black; width: 350px; height: 50px;\" /></p>\n";
		echo "<p align=\"center\"><input type=\"password\" name=\"password\" size=\"50\" style=\"border: 1px solid black; width: 350px; height: 50px;\" /></p>\n";
		echo "<p align=\"center\"><input type=\"submit\" name=\"login\" value=\"| login |\" style=\"border: 1px solid black; width: 350px; height: 50px;\" /></p>\n";

	}
}

?>
