<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-type: application/json; charset=utf-8");


$method = $_SERVER['REQUEST_METHOD'];
if ($method === "GET") {
    session_start();

    if ( isset($_SESSION ) ) {
        echo "Session exist";
        
    } else {
        echo "No session";
    }

    $response = new stdClass;
    $response->success = true;
    $response->message = "Session";
    $response->session = $_SESSION;
    echo json_encode($response);
    


    // if( ! isset($_SESSION["user_id"]) ) {
    //     http_response_code(401);
    //     exit();
    // } else {
    //     $response->success = true;
    //     $response->message = "Login success - PHP";
    //     $response->sessionToken = session_id();
    //     $response->session = $_SESSION;
    //     echo json_encode($response);
    // }
}

