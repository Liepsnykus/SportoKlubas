<?php
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
        $this->db->query("INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
  
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
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
