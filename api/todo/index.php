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

// Return query on todo
$result = $todo->index();

// Get number of row
$num = $result->rowCount();

// Check if any post
if ($num > 0) {

    $todos_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $todo_item = array(
            'id' => $id,
            'title' => $title,
        );

        //   push data
        array_push($todos_arr, $todo_item);

    }

    //   Turn to JSON and output

    echo json_encode($todos_arr);

} else {

    //   No todos

    echo json_encode(array('message' => 'There are no todos'));

}
