<?php

$url = "https://jsonplaceholder.typicode.com/todos";


// $url = 'http://example.com/api/data'; // Replace with the URL of the resource you want to access

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
