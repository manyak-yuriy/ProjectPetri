<?php


require 'parts/DB_connect.php';  
$ip = $_SERVER['REMOTE_ADDR'];
$hostname = $_SERVER['REMOTE_HOST'];

$first = rand(0, count($arrSources)-1);
do
{
   $second = mt_rand(0, count($arrSources)-1);
} while ($first == $second);

$type = mt_rand(1, 3); // 1 - competence   2 - charisma   3 - manners

echo "host: "; echo $hostname;

$sql = "INSERT INTO vote_queue(first, second, type, REMOTE_ADDR, REMOTE_HOST) VALUES ('$first', '$second', '$type', '$ip', '$hostname')";

if ($conn->query($sql) === TRUE) 
{
    //echo "New record created successfully";
} else 
{
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
$id = $conn->insert_id;

echo '[';
echo    "\"$arrSources[$first]\",";
echo    "\"$arrSources[$second]\",";
echo    "\"$id\"".",";
echo    "\"$type\"";
echo "]";

$conn->close();

?>