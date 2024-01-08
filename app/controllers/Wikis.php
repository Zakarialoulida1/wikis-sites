<?php
class Wikis extends controller{
    private $wiki;
    private $categorie;
    private $tag;

    public function __construct()
    {
        $this->wiki=$this->model('wiki');
        $this->categorie=$this->model('categorie');
        $this->tag=$this->model('tag');
    }
    
    public function formWiki(){
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST);
            // die();
            $data = [

                'wiki_picture' => trim($_POST['wiki_picture']),
                'category_id'=>trim($_POST['categorie']),
                'selected_tags'=>trim($_POST['selected_tags']),
                'titre' => trim($_POST['titre']),
                'description' => trim($_POST['message']),
                'wiki_picture_err' => '',
                'titre_err' => '',
                'description_err' => ''
            ];
            if($this->wiki->add_wiki($data)){
                redirect('wikis/formWiki');
            }
        }
        else{
        $data = [
            'categories'=> $this->categorie->fetch_categories(),
            'tags'=>$this->tag->fetch_tags(),
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
}