<?php

class Todo {

    private $conn;
    private $table = 'todos';

    public $id;
    public $title;

    //  Cosctructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //  Return all todos
    public function index() {
        // Create query
        $query = 'SELECT * FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    //  Return single todo
    public function show() {

        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //   Bind id with first ?
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET PROP
        $this->id = $row['id'];
        $this->title = $row['title'];

    }

    //  Create a todo

    public function create() {
        /* $query = 'INSERT INTO ' . $this->table . ' (a) VALUES (:title)'; */
        $query = 'INSERT INTO ' . $this->table . ' SET title = :title';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //   CLEAN DATA
        /* $this->title = htmlspecialchars(strip_tags($this->title)); */

        //   Bind id with first ?
        $stmt->bindParam(':title', $this->title);

        if ($stmt->execute()) {
            return true;
        }

        //   print error
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    //  update todo

    public function update() {

        $query = 'UPDATE ' . $this->table . ' SET title = :title WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //   Bind id with first ?
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {

            return true;
        }

        //   print error
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    //  Delete todo
    public function delete() {

        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //   Bind id
        $stmt->bindParam(':id', $this->id);

        //   execute query
        if ($stmt->execute()) {
            return true;
        }

        //   print error
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

}