<?php

require 'parts/DB_connect.php';  

/* catergory:  */

$comp_votes = 0;
$sql = "SELECT SUM(count) AS cnt FROM vote_cnt_comp;";
$result = $conn->query($sql);

if ($result->num_rows == 1) 
{
    $row = $result->fetch_assoc();
	$comp_votes = $row['cnt'];
}

$char_votes = 0;
$sql = "SELECT SUM(count) AS cnt FROM vote_cnt_char;";
$result = $conn->query($sql);

if ($result->num_rows == 1) 
{
    $row = $result->fetch_assoc();
	$char_votes = $row['cnt'];
}

$mann_votes = 0;
$sql = "SELECT SUM(count) AS cnt FROM vote_cnt_mann;";
$result = $conn->query($sql);

if ($result->num_rows == 1) 
{
    $row = $result->fetch_assoc();
	$mann_votes = $row['cnt'];
}



echo '[';
echo    "\"$comp_votes\",";
echo    "\"$char_votes\",";
echo    "\"$mann_votes\"";
echo "]";
?>

<?php
    $conn->close();
?>