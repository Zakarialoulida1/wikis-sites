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
        
      if(isset($_SESSION['user_role'])){
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
                
                redirect('pages/index');
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
    }}else{
      redirect("users/login");
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
          
          
            if( $this->wikis->update_wiki($id_wiki,$_POST)) {
             
          if( $this->tags->delete_tags($id_wiki)){
           $selectedTagsString = $_POST['selected_tag_id'];
           $selectedTagsArray = json_decode($selectedTagsString, true);
           $this->tags->add_wiki_tags($id_wiki,$selectedTagsArray);
           redirect('pages/index');
          }}
        }else{
        $wiki=$this->wikis->get_this_wikis($id_wiki);
        $user=$this->user->findUserByid($wiki->user_id);
        $category=$this->category->get__this_category($wiki->category_id);
        $tags=$this->tags-> get_tags_wiki($id_wiki);
        
        $data=[
          'wiki'=>$wiki,
          'user'=>$user,
          'mycategory'=>$category,
          'mytags'=>$tags,
          'categories'=>$this->category->fetch_categories(),
          'tags'=>$this->tags->fetch_tags(),
        ];
      // var_dump($category);die();
        $this->view('pages/update_wiki',$data);
      }}


      public function search_wiki()
      {
          if (isset($_POST['input'])) {
              $input = $_POST['input'];
      
              $wikis = $this->wikis->found_wiki($input);
      
              foreach ($wikis as $wiki) {
                  echo '<div class="flex max-lg:flex-col bg-white  cursor-pointer rounded-md overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] hover:scale-105 transition-all duration-300">';
                  echo '<img src="' . URLROOT . '/img/' . $wiki->wiki_picture . '" alt="Blog Post 2" class="lg:w-1/3 min-h-[250px] h-full object-cover" />';
                  echo '<div class="p-6 lg:w-3/5">';
                  echo '<h3 class="text-xl font-bold text-[#333]">' . $wiki->title . '</h3>';
                  echo '<span class="text-sm block text-gray-400 mt-2">' . $wiki->created_at . '| by ' . $wiki->nom . ' ' . $wiki->prenom . '</span>';
                  echo '<p class="text-sm max-h-[15vh] overflow-y-hidden mt-4">' . $wiki->content . '</p>';
                  echo '<a href="' . URLROOT . '/wikis/read_more/' . $wiki->wiki_id . '" class="mt-4 inline-block text-blue-600 text-sm hover:underline">Read More</a>';
      
                  if (!empty($wiki->tag_names)) {
                      echo '<div class="flex  flex-wrap gap-2 mt-4">';
                      $tags = explode(",", $wiki->tag_names);
                      foreach ($tags as $tag) {
                          echo '<span class="bg-gray-300 p-2 rounded">' . $tag . '</span>';
                      }
                      echo '</div>';
                  }
      
                  echo '<div class="flex w-full mt-16  justify-around ">';
                  if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                      echo '<a href="' . URLROOT . '/wikis/archiver_wiki/' . $wiki->wiki_id . '" class="p-2 bg-red-400  rounded cursor-pointer "><i class="fa-solid fa-box-archive "> ARCHIVER</i></a>';
                  }
      
                  if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])  && $wiki->user_id == $_SESSION['user_id']) {
                      echo '<a href="' . URLROOT . '/wikis/delete_wiki/' . $wiki->wiki_id . '" class="p-2 bg-red-400  rounded cursor-pointer "><i class="fa-solid fa-box-archive "> DELETE</i></a>';
                      echo '<a href="' . URLROOT . '/wikis/update_wiki/' . $wiki->wiki_id . '" class="p-2 bg-green-400 rounded cursor-pointer "><i class="fa-regular fa-pen-to-square "> UPDATE</i></a>';
                  }
      
                  echo '</div></div></div>';
              }
          }
      }
      


    public function stats() {

      $totalWikis = $this->wikis->getTotalWikis();

    
      $UserWithMostWikis = $this->wikis->getUserWithMostWikis();
     
      $totalTags = $this->wikis->getTotalTags();
      $totalAuthors = $this->wikis->getTotalAuthors();
      $totalCategories = $this->wikis->getTotalCategories();
      $mostUsedCategory = $this->wikis->getMostUsedCategory();
     
      $data = [
          'totalWikis' => $totalWikis,
          'UserWithMostWikis' => $UserWithMostWikis,
          'totalTags' => $totalTags,
          'totalAuthors' => $totalAuthors,
          'totalCategories' => $totalCategories,
          'mostUsedCategory' => $mostUsedCategory,
      ];
      // var_dump($data);
      // die();

      // Load the dashboard view with the retrieved data
      $this->view('pages/stats',$data);
  }
    
}