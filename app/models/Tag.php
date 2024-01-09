<?php
class Tag
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function fetch_tags(){
    $this->db->query(" SELECT * FROM tags");
    $this->db->execute();
    return  $this->db->resultSet();
  }
  public function add_wiki_tags($id){
    
  }

}