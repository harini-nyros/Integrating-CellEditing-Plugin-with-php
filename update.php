<?php
   $connection = mysql_connect('localhost','root','root');
	$db = mysql_select_db('extjs', $connection);
	$id=$_GET['id'];
	//echo $id;
	$title=$_GET['title'];
	$director=$_GET['director'];
	$released=$_GET['released'];
echo "<script>alert($title);</script>";
	//$released="Tue Jun 25 2013 00:00:00 GMT+0530 (IST)";
	$str2 = substr($released,3);
	//echo $str2;
	//$val= substr($str2,0,11);
	//echo $val;
	$date=date("Y-m-d",strtotime($str2));
	 //echo $date;
	$genre=$_GET['genre'];
	$tagline=$_GET['tagline'];
	$result = mysql_query("UPDATE movies SET title='$title',director='$director',released='$released',genre='$genre',tagline='$tagline' where id='$id'");
	//header("Location:index.php");
?>
