<?php

namespace MyApp\app\models;

use MyApp\app\libraries\Database;

class Comment {

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getComments()
    {
        $this->db->query('SELECT * FROM comments ORDER BY created_at DESC');

        $comments = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $comments;
        }
        return false;
    }

    public function addComment($data)
    {
        // get data and add comment using data
        $this->db->query("INSERT INTO comments (name, text, user_id) VALUES (:name, :text, :user_id)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':text', $data['text']);
        $this->db->bind(':user_id', $data['user_id']);

        // make query 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}