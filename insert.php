<?php
   $connection = mysql_connect('localhost','root','root');
	$db = mysql_select_db('extjs', $connection);

	$result=MYSQL_QUERY("INSERT INTO movies(title,director,released,genre,tagline)".
"VALUES ('title', 'director', ' ', '0','tagline')");
	//header("Location:index.php");

	//$result = mysql_query("INSERT INTO movies (title,director,released,genre,tagline)".
//"VALUES ('', '', '', '','','');
?>
