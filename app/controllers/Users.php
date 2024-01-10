<?php

class Users extends Controller
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function register()
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            // init data
            $data = [

                'product_picture' => trim($_FILES['product_picture']['name']),
                'name' => trim($_POST['name']),
                'userlastname' => trim($_POST['userlastname']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'roleuser' => 'user',
                'product_picture_err' => '',
                'name_err' => '',
                'userlastname_err' => '',
                'phoneNumber_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //*******  VALIDATE DATA***********


            if (empty($data['product_picture'])) {
                $data['product_picture_err'] = 'please enter picture ';
            }
            if (empty($data['name'])) {
                $data['name_err'] = 'please enter name ';
            }

            if (empty($data['userlastname'])) {
                $data['userlastname_err'] = 'please enter name ';
            }

            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = 'please  phoneNumber';
            }


            if (empty($data['email'])) {
                $data['email_err'] = 'please enter email ';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'EMAIL ALREADY EXIST ';
                }
            }


            if (empty($data['password'])) {
                $data['password_err'] = 'please ENTER PASSWORD ';
            } elseif (strlen($data['password']) < 2) {
                $data['password_err'] = ' PASSWORD  MUST BE AT LEAST 2';
            }


            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'please ENTER confirm_password ';
            } else {
                if ($data['password'] !=  $data['confirm_password']) {
                    $data['confirm_password_err'] = ' PASSWORD DO NOT MATCH';
                }
            }

            if (empty($data['product_picture_err']) && empty($data['name_err']) && empty($data['userlastname_err']) && empty($data['phoneNumber_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // validated

                //********haching password *********
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // var_dump($this->userModel);die();

                /************registring data by class User from the model that they have a function register ************** */
                if ($this->userModel->register($data)) {

                    redirect('users/login');
                } else {
                    die('something went wrong');
                }
            } else {
                // load the view
                $this->view('users/register', $data);
            }
        } else {
           
            $data = [
                'product_picture' => '',
                'name' => '',
                'userlastname' => '',
                'phoneNumber' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'roleuser' => '',
                'product_picture_err' => '',
                'name_err' => '',
                'userlastname_err' => '',
                'phoneNumber_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];


            $this->view('users/register', $data);
        }
    }
    public function login()
    {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),

                'email_err' => '',
                'password_err' => '',
            ];
            // *************check the email*****************
            if (empty($data['email'])) {
                $data['email_err'] = 'please enter email ';
            }
            // /*************Check the password */
            if (empty($data['password'])) {
                $data['password_err'] = 'please ENTER PASSWORD ';
            }
            /**check if this user exist or not *********** */
            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {

                $data['email_err'] = 'no user found';
            }




            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                // var_dump($loggedInUser);
                // die();

                if ($loggedInUser) {

                    /********* * Create Session  ************/
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];


            $this->view('users/login', $data);
        }
    }




    public function createUserSession($user)
    {
      
        $_SESSION['user_id'] = $user->user_id ;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->prenom;
        $_SESSION['user_image'] = $user->image;
        $_SESSION['user_lastname'] = $user->nom;
        $_SESSION['user_phone'] = $user->telephone;
        $_SESSION['user_role'] = $user->roleuser;
        if($_SESSION['user_role']== 'user'){
        redirect('pages/index');
        }elseif($_SESSION['user_role']== 'admin'){
            redirect('categories/index');   
        }
     
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
       
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
