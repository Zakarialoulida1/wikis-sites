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

    $this->db->query('INSERT INTO users (prenom, nom, telephone, email, motdepasse, roleuser, image) VALUES (:prenom,:nom,:telephone,:email,:motdepasse,:roleuser,:image)');
    $this->db->bind(':prenom', $data['name']);
    $this->db->bind(':nom', $data['userlastname']);
    $this->db->bind(':telephone', $data['phoneNumber']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':motdepasse', $data['password']);
    $this->db->bind(':roleuser', $data['roleuser']);
    $this->db->bind(':image', $data['product_picture']);


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
