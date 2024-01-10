<?php

class Tags extends Controller
{
    private $tagmodel;

    public function __construct()
    {
        $this->tagmodel = $this->model('tag');
    }
    public function index()
    {
        // get Projects

        $tags = $this->tagmodel->fetch_tags();

        $data = [
            'tags' => $tags
        ];

        $this->view('tags/index', $data);
    }
    public function addTag(){

    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            // var_dump($_POST);
            // die();
            $data = [
                'tag_name' => trim($_POST['tagName']),
                'tag_id'=>'',
                'tag_name_error' => ''

            ];
            //Validate project_name
            if (empty($data['tag_name'])) {
                $data['tag_name_error'] = 'Please entre Categorie name';
            }

            //Make sure no errors
            if (empty($data['tag_name_error'])) {
               
             
                if ($this->tagmodel->addTag($data)) {
                  
                    redirect('tags/index');
                    # code...
                } else {
                    die('Something went wrong ');
                }


            } else {
                //Load view with errors
                $this->view('tags/index', $data);
            }

        } else {
            $data = [
                'categorie_name' => '',

            ];
            $this->view('categories/index', $data);
        }

    }
}