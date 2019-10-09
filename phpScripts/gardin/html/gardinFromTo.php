<?php
include 'dbConnect.php';

$response = array();
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);


echo json_encode($response);

