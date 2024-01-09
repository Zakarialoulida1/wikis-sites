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
  public function get__this_category($id_categ){
    $this->db->query(" SELECT * FROM categories WHERE category_id=:category_id");
    $this->db->bind(':category_id', $id_categ );
   
    return  $this->db->single();
  }
}