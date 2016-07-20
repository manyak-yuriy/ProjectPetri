<?php

require 'parts/DB_connect.php';  

/* cat : category */
$cat = $_GET["cat"];

$sql = "SELECT COUNT(*) AS cnt FROM vote_queue;";
$result = $conn->query($sql);

if ($result->num_rows == 1) 
{
    $row = $result->fetch_assoc();
	$counter = $row['cnt'];
	echo "{\"cnt\" : \"$counter\"}";
}

?>

<?php
    $conn->close();
?>