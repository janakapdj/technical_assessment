<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function register($data) {
            $this->db->query('INSERT INTO users (first_name, last_name, username, password) VALUES(:first_name, :last_name, :username, :password)');
    
            //Bind values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
    
            //Execute function
            if($this->db->execute()) {
                return true;
            }else {
                return false;
            }
        }
    
        public function login($username, $password) {
            $this->db->query('SELECT * FROM users WHERE username = :username');
    
            //Bind value
            $this->db->bind(':username', $username);
            $row = $this->db->single();
            $hashedPassword = $row->password;
    
            if(password_verify($password, $hashedPassword)) {
                return $row;
            }else {
                return false;
            }
        }
    }