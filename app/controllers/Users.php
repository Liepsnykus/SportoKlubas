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
        redirect('pages/index');
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

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($this->vld->ifRequestIsPostAndSanitize()) {

            $data = [
                'email'     => trim($_POST['email']),
                'password'  => trim($_POST['password']),
                'errors' => [
                    'emailErr'     => '',
                    'passwordErr'  => '',
                ],
            ];

            $data['errors']['emailErr'] = $this->vld->validateLoginEmail($data['email'], $this->userModel);

            $data['errors']['passwordErr'] = $this->vld->validateEmpty($data['password'], 'Please enter your password');

            if ($this->vld->ifEmptyArr($data['errors'])) {

                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {

                    $this->createUserSession($loggedInUser);
                    print_r($loggedInUser);
                } else {
                    $data['errors']['passwordErr'] = 'Wrong password or email';
                    $data['currentPage'] = 'login';
                    $data['title'] = 'Prisijunkite';

                    $this->view('users/login', $data);
                }
            } else {
                $data['currentPage'] = 'login';
                $data['title'] = 'Prisijunkite';

                $this->view('users/login', $data);
            }
        } else {

            $data = [
                'email'     => '',
                'password'  => '',
                'errors' => [
                    'emailErr'     => '',
                    'passwordErr'  => '',
                ]
            ];
            $data['currentPage'] = 'login';
            $data['title'] = 'Prisijunkite';

            $this->view('users/login', $data);
        }
    }

    public function createUserSession($userRow)
    {
        $_SESSION['user_id'] = $userRow->id;
        $_SESSION['user_email'] = $userRow->email;
        $_SESSION['user_name'] = $userRow->name;
        redirect('pages/index');
    }
}
