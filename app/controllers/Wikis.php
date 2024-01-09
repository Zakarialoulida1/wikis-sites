<?php
class Wikis extends controller{
    private $wikis;
    private $user;
    private $category;
    private $tags;

    public function __construct(){
     $this->wikis=$this->model('wiki');
     $this->user=$this->model('user');
     $this->category=$this->model('categorie');
     $this->tags=$this->model('tag');
    }
    
 
    
    public function formWiki(){
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
          
            $data = [

                'wiki_picture' => trim($_POST['wiki_picture']),
                'category_id'=>trim($_POST['categorie']),
                'titre' => trim($_POST['titre']),
                'description' => trim($_POST['message']),
                'wiki_picture_err' => '',
                'titre_err' => '',
                'description_err' => ''
            ];

         
          
            $id_wiki=$this->wikis->add_wiki($data);
            
            if($id_wiki){
                
                $selectedTagsString = $_POST['selected_tag_id'];

                // Decode the JSON string to an array
                $selectedTagsArray = json_decode($selectedTagsString, true);
          
                $this->tags->add_wiki_tags($id_wiki,$selectedTagsArray);
                
                redirect('wikis/formWiki');
            }
        }
        else{
        $data = [
            'categories'=> $this->category->fetch_categories(),
            'tags'=>$this->tags->fetch_tags(),
            'selected_tags'=>'',
            'wiki_picture' => '',
            'titre' => '',
            'description' => '',
            'wiki_picture_err' => '',
            'titre_err' => '',
            'description_err' => ''
        ];
     
        $this->view('pages/form-wiki',$data);
    }
    }
    public function read_more($id_wiki){
        
        $wiki=$this->wikis->get_this_wikis($id_wiki);
        $user=$this->user->findUserByid($wiki->user_id);
        $category=$this->category->get__this_category($wiki->category_id);
        $tags=$this->tags-> get_tags_wiki($id_wiki);
       
        $data=[
          'wiki'=>$wiki,
          'user'=>$user,
          'category'=>$category,
          'tags'=>$tags,
        ];
    
  
       $this->view('pages/wiki_details', $data);
      }
      public function archiver_wiki($id_wiki){
        $this->wikis->archiver_wiki($id_wiki);
        redirect('pages/index');
      }
      public function update_wiki($id_wiki){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);
          die();

        }else{
        $wiki=$this->wikis->get_this_wikis($id_wiki);
        $user=$this->user->findUserByid($wiki->user_id);
        $category=$this->category->get__this_category($wiki->category_id);
        $tags=$this->tags-> get_tags_wiki($id_wiki);
       
        $data=[
          'wiki'=>$wiki,
          'user'=>$user,
          'category'=>$category,
          'mytags'=>$tags,
          'categories'=>$this->category->fetch_categories(),
          'tags'=>$this->tags->fetch_tags(),
        ];
        //  var_dump($data['wiki']);
        //  die();
        $this->view('pages/update_wiki',$data);
      }}

}