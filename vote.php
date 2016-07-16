<?php

function swap(&$a, &$b) {
    $a = $a ^ $b;
    $b = $a ^ $b;
    $a = $a ^ $b;
}


require 'parts/DB_connect.php';  

$id = $_GET["id"];
$vote = $_GET["res"];
$ip = $_SERVER['REMOTE_ADDR'];
$hostname = $_SERVER['REMOTE_HOST'];

// Filter out SQL-injecions
if (!filter_var($id, FILTER_VALIDATE_INT) === true )
	echo "Invalid value of id";	

if (!filter_var($res, FILTER_VALIDATE_INT) === true )
    echo "Invalid value of vote result";	

$sql = "SELECT first, second, type FROM vote_queue WHERE id = $id;";
$result = $conn->query($sql);

if ($result->num_rows == 1) 
{
    $row = $result->fetch_assoc();
	$first = $row['first'];
	$second = $row['second'];
	$type = $row['type'];
	/*$sql = "DELETE FROM vote_queue WHERE id = $id;";
    $conn->query($sql);*/
	
	$table_name = "vote_cnt";
	
	switch ($type)
	{
		case "1":
		{
			$table_name = $table_name . "_comp";
			break;
		}
		case "2":
		{
			$table_name = $table_name . "_char";
			break;
		}
		case "3":
		{
			$table_name = $table_name . "_mann";
			break;
		}
		default;
		{
			echo "Strange type!";
			break;
		}
	}
	
	if ($vote == 2)
	{
		swap($first, $second); 
	}
	elseif ($vote != 1)
	{
	    echo "Invalid value of vote result";	
	}
	
	$sql = "SELECT id, count FROM $table_name WHERE first = $first AND second = $second;";
    $result = $conn->query($sql);
	if ($result->num_rows == 1) 
	{
		$row = $result->fetch_assoc();
		$new_count = $row['count'] + 1;
		$id = $row['id'];
		$sql = "UPDATE $table_name SET count = $new_count, REMOTE_ADDR = '$ip', REMOTE_HOST = '$hostname' WHERE id = $id";
        $conn->query($sql);
	}
	elseif($result->num_rows == 0) 
	{
		$sql = "INSERT INTO $table_name(first, second, count, REMOTE_ADDR, REMOTE_HOST) VALUES('$first', '$second', '1', '$ip', '$hostname');";
        $result = $conn->query($sql);
	}
	else
	{
		echo "Too many records in $table_name";
	}
} else 
{
    echo "Wrong vote id! $id";
}
 
?>

<?php
    $conn->close();
?>