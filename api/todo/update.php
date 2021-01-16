<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include Database connection and Todo Model

include_once '../../config/Database.php';
include_once '../../models/Todo.php';

// Create Database istance and start conenct method
$database = new Database();
$db = $database->connect();

// Create istance of Todo
$todo = new Todo($db);

//GET RAW POSTED DATA
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$todo->id = $data->id;
$todo->title = $data->title;

// Update todo
if ($todo->update()) {
    echo json_encode(
        array('message' => 'Todo updated')
    );
} else {
    echo json_encode(
        array('message' => 'Todo NOT updated')
    );
}
