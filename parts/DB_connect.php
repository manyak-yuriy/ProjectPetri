<?php
$arrSources = array(
/*0*/   "new_img/erokhin.jpg",
/*1*/   "new_img/deundiak.jpg",
/*2*/   "new_img/fridman.jpg",
/*3*/   "new_img/gritsaiuk.jpg",
/*4*/   "new_img/belas.jpg",
/*5*/   "new_img/mikhailuk.png",
/*6*/   
/*7*/   "new_img/manyak.png",
"new_img/livinskiy.jpg",
"new_img/puhachev.jpg",
"new_img/morugiy.jpg",
"new_img/rohovoy.jpg",
"new_img/sagan.jpg",
"new_img/skorohod.jpg",
"new_img/sliota.jpg",
"new_img/tarasiuk.jpg",
"new_img/varava.jpg",
"new_img/yakovets.jpg", 
"new_img/romanko.jpg"
);

    $servername = 'fdb5.freehostingeu.com';
    $username = '2057126_db';
    $password = 'i77JjWO58MU5mmDj8Tp9';
	$dbname = '2057126_db';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
       die("Connection failed: " . $conn->connect_error);
    } 
	 
       //console.log("Connected successfully");
?>
