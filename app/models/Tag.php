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
  public function add_wiki_tags($id,$tags){
    // var_dump($tags);
    // var_dump($id);
    // die();
    foreach ($tags as $tag) {
     
      // Assuming your table is named "tags" with columns "tag_id" and "name"
      $this->db->query( "INSERT INTO wiki_tags (wiki_id,tag_id) VALUES (:wiki_id,:tag_id)");
      $this->db->bind(':wiki_id',$id);
      $this->db->bind(':tag_id',$tag);
      $this->db->execute();
  }
  echo "Record inserted successfully ";

}
public function get_tags_wiki($id_wiki){
  $this->db->query( "SELECT * FROM tags join wiki_tags on wiki_tags.tag_id = tags.tag_id WHERE wiki_tags.wiki_id=:wiki_id ");
      $this->db->bind(':wiki_id',$id_wiki);
      
      return $this->db->resultSet();
}


}