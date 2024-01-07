<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  //************ register user *************
  public function register($data)
  {

    $this->db->query('INSERT INTO users (prénom, nom, téléphone, email, motdepasse, roleuser, image) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $this->db->bind($data['name']);
    $this->db->bind($data['userlastname']);
    $this->db->bind($data['phoneNumber']);
    $this->db->bind($data['email']);
    $this->db->bind($data['password']);
    $this->db->bind($data['roleuser']);
    $this->db->bind($data['product_picture']);



    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
 
  public function login($email, $password)
  {
    $this->db->query("SELECT * FROM users WHERE email = '$email' ");


    $row = $this->db->single();
    $hashed_password = $row->motdepasse;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  
  public function findUserByEmail($email)
  {
    $this->db->query("SELECT * FROM users WHERE email = '$email' ");


    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
