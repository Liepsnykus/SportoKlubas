<?php

namespace MyApp\app\models;

use MyApp\app\libraries\Database;

// User class 
// for getting and setting database values 

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Check if email already exists
     *
     * @param string $email
     * @return void
     */
    public function findUserByEmail($email)
    {

        $this->db->query("SELECT * FROM users WHERE `email` = :email");

        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Add new user to DB
     *
     * @param array $data
     * @return void
     */
    public function register($data)
    {
        $this->db->query("INSERT INTO users (`name`, `lastname`, `email`, `phone`, `adress`, `password`) VALUES (:name, :lastname, :email, :phone, :adress, :password)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':adress', $data['adress']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function login($email, $notHashedPass)
    {

        $this->db->query("SELECT * FROM users WHERE `email` = :email");

        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($row) {
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        if (password_verify($notHashedPass, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT name, email FROM users WHERE id = :id");

        $this->db->bind(':id', $id);

        $row = $this->db->singleRow();

        if ($this->db->rowCount() > 0) return $row;
        return false;
    }
}
