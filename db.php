<?php

$connection = mysql_connect('localhost','root','root');
$db = mysql_select_db('extjs', $connection);


$result = mysql_query('SELECT * FROM movies');
while ($row = mysql_fetch_assoc($result)) {

    for ($i=0; $i < mysql_num_fields($result); $i++) {
        $meta = mysql_fetch_field($result, $i);
        }
    $rows[] = $row;

}

print (json_encode($rows));
?>
