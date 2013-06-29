<?php
$id=$_POST['did'];
$connection = mysql_connect('localhost','root','root');
$db = mysql_select_db('extjs', $connection);
$result = mysql_query("DELETE FROM  movies where id=$id");
header("Location:index.php");

?>
