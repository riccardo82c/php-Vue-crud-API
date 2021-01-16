<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include Database connection and Todo Model

include_once '../../config/Database.php';
include_once '../../models/Todo.php';

// Create Database istance and start conenct method
$database = new Database();
$db = $database->connect();

// Create istance of Todo
$todo = new Todo($db);

//GET ID
$todo->id = isset($_GET['id']) ? $_GET['id'] : die();

// GET TODO
$todo->show();

// CREATE ARRAY
$todo_arr = array(
    'id' => $todo->id,
    'title' => $todo->title,
);

echo json_encode($todo_arr);