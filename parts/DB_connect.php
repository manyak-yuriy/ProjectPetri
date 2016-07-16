<?php
$arrSources = array(
/*0*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/batienko/tutors/chair-mmsa/foto/Batiyenko.png",
/*1*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/bidyuk/tutors/chair-mmsa/foto/Bydyuk.jpg",
/*2*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/bondarenko/tutors/chair-mmsa/foto/Bondarenko.jpg",
/*3*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/bogdanskiy/tutors/chair-mmsa/foto/Bohdanskyy.jpg",
/*4*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/foto/Didkokvska.jpg",
/*5*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/kaniovskaya/tutors/chair-mmsa/foto/Kanyovskaya.jpg",
/*6*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/malcev/tutors/chair-mmsa/foto/Maltsev.jpg",
/*7*/   "http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/podkolzin/tutors/chair-mmsa/foto/Podkolzyn.jpg",
"http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/foto/Tymoshenko.jpg/image_preview",
"http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/foto/Stus.jpg/image_preview",
"http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/foto/SHvachko.jpg/image_preview",
"http://iasa.kpi.ua/community-uk/tutors/chair-mmsa/kasyanov/tutors/chair-mmsa/foto/Kasyanov.jpg"
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
