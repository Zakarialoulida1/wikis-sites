<?php

class Categories extends Controller
{
    private $categoriesmodel;

    public function __construct()
    {
        $this->categoriesmodel = $this->model('categorie');
    }
    public function index()
    {
        // get Projects

        $categories = $this->categoriesmodel->getCategories();

        $data = [
            'categories' => $categories
        ];

        $this->view('categories/index', $data);
    }
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            // var_dump($_POST);
            // die();
            $data = [
                'categorie_name' => trim($_POST['categoryName']),
                'user_id' => $_SESSION['user_id'],
                'categorie_name_error' => ''

            ];
            //Validate project_name
            if (empty($data['categorie_name'])) {
                $data['categorie_name_error'] = 'Please entre Categorie name';
            }

            //Make sure no errors
            if (empty($data['categorie_name_error'])) {
               
             
                if ($this->categoriesmodel->addCategorie($data)) {
                    flash('categorie_message', 'categorie Added');
                    redirect('categories/index');
                    # code...
                } else {
                    die('Something went wrong ');
                }


            } else {
                //Load view with errors
                $this->view('categories/index', $data);
            }

        } else {
            $data = [
                'categorie_name' => '',

            ];
            $this->view('categories/index', $data);
        }

    }
    public function edit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data = [
                'CategoryID' => $_POST['categoryId'],
                'categorie_name' => trim($_POST['categoryName']),
                'categorie_name_error' => ''
            ];

            // Validate category_name
            if (empty($data['categorie_name'])) {
                $data['categorie_name_error'] = 'Please enter Category name';
            }


            // Make sure no errors
            if (empty($data['categorie_name_error'])) {
                // Validated
               
                if ($this->categoriesmodel->updateCategorie($data)) {
                    flash('categories_message', 'Category Modified');
                    redirect('categories/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                var_dump($data);
                die();
                // Load view with errors
                $this->view('categories/index', $data);
            }

        } else {
            // Get existing category from model
            $id =$_POST['categoryId'];
            $category = $this->categoriesmodel->getCategorieId($id);
            // Check for owner
          
            $data = [
                'CategoryID' =>$id,
                'categorie_name' => $category->CategoryName
            ];

            // Pass additional parameter for modal
            $data['modal'] = true;

            $this->view('categories/index', $data);
        }
    }
    public function delete($id)
    {
        if ($this->categoriesmodel->deleteCategory($id)) {
            flash('category_message', 'categorie Deleted');
            redirect('categories/index');
        } else {
            die('Something went wrong');
        }
    }
}