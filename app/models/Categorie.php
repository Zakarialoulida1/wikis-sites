<?php
class Categorie
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function  fetch_categories(){
    $this->db->query(" SELECT * FROM categories");
    $this->db->execute();
    return  $this->db->resultSet();
  }
}