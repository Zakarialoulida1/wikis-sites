<?php
class Wiki {
    
        private $db;
      
        public function __construct()
        {
            $this->db = new Database;

}

public function add_wiki($data){
    $this->db->query('INSERT INTO wikis (wiki_picture,title, content,user_id,category_id) VALUES (:wiki_picture,:title,:content,:user_id,:category_id)');
    $this->db->bind(':wiki_picture', $data['wiki_picture']);
    $this->db->bind(':title', $data['titre']);
    $this->db->bind(':content', $data['description']);
    $this->db->bind(':user_id', $_SESSION['user_id']);
    $this->db->bind(':category_id',$data['category_id']);



    if ($this->db->execute()) {
        // Get the last inserted ID
        $lastInsertId = $this->db->lastInsertId();
        return $lastInsertId;
    } else {
        return false;
    }
}

}