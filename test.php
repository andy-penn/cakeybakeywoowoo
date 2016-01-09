<?php 
$slocation = "ws11pq";
$xml = simplexml_load_file("http://nominatim.openstreetmap.org/search?format=xml&addressdetails=0&q=".$slocation."");
$e1 = (string) $xml->place[0]['lat'];
$n1 = (string) $xml->place[0]['lon'];
//convert postcode to county
$town = (string) $xml->place[0]['display_name'];
$array = explode(',', $town);
$town = $array [2];


echo'<p>town: '.$town .'</p>';
echo'<p>lat: '.$e1.'</p>';
echo'<p>lon: '.$n1.'</p>';
?>