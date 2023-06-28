<?php

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, HEAD");
// // header("Access-Control-Allow-Headers: Content-Type");
// header("Content-Type : application/json; charset=utf-8");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-type: application/json; charset=utf-8");

$userLogin = new stdClass;
$userLogin->id = 1;
$userLogin->username = "monika";
$userLogin->password = "123";

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $data = json_decode(file_get_contents('php://input'));
        $response = new stdClass;
        $response->success = false;
        $response->message = "Login failed";
        $response->sessionToken = null;
        if (
            ($data->username == $userLogin->username) &&
            ($data->password == $userLogin->password)
        ) {
            session_start();
            $_SESSION["user_id"] = $userLogin->id;
            $response->success = true;
            $response->message = "Login success - PHP";
            $response->sessionToken = session_id();
            $response->session = $_SESSION;
        }
        echo json_encode($response);
        break;
}