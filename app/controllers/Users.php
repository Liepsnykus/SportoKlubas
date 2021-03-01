<?php

class Users extends Controller
{
    private $userModel; 
    private $vld;


    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->vld = new Validation;
    }

    public function index()
    {
        redirect('pages/posts');
    }

    public function register()
    {
        if ($this->vld->ifRequestIsPostAndSanitize()) {

            $data = [
                'name'      => trim($_POST['name']),
                'email'     => trim($_POST['email']),
                'password'  => trim($_POST['password']),
                'passwordRepeat' => trim($_POST['passwordRepeat']),
                'errors' => [
                    'nameErr'      => '',
                    'emailErr'     => '',
                    'passwordErr'  => '',
                    'passwordRepeatErr' => '',
                ],

            ];

            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);

            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);

            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 6, 10);

            $data['errors']['passwordRepeatErr'] = $this->vld->confirmPassword($data['passwordRepeat']);


      
            if ($this->vld->ifEmptyArr($data['errors'])) {
            
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    redirect('/pages/index');
                } else {
                    die('Something went wrong in adding user to db');
                }
            } else {

                $data['currentPage'] = 'register';
                $data['title'] = 'Užsiregistruokite';
       
                $this->view('users/register', $data);
            }
        } else {

            $data = [
                'name'      => '',
                'email'     => '',
                'password'  => '',
                'passwordRepeat' => '',
                'errors' => [
                    'nameErr'      => '',
                    'emailErr'     => '',
                    'passwordErr'  => '',
                    'passwordRepeatErr' => '',
                ],
                'currentPage' => 'register',
                'title' => 'Užsiregistruokite'
            ];

            $this->view('users/login', $data);
        }
    }
}
