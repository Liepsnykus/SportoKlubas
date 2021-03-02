<?php

namespace MyApp\app\controllers;

use MyApp\app\libraries\Controller;
use MyApp\app\libraries\Validation;
use MyApp\app\models\User;

class Users extends Controller
{
    private $userModel;
    private $vld;


    public function __construct()
    {
        $this->userModel = new User;
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
                'lastname' => trim($_POST['lastname']),
                'email'     => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'adress' => trim($_POST['adress']),
                'password'  => trim($_POST['password']),
                'passwordRepeat' => trim($_POST['passwordRepeat']),
                'errors' => [
                    'nameErr'      => '',
                    'lastnameErr' => '',
                    'emailErr'     => '',
                    'phoneErr' => '',
                    'adressErr' => '',
                    'passwordErr'  => '',
                    'passwordRepeatErr' => '',
                ],
            ];

            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);

            $data['errors']['lastnameErr'] = $this->vld->validateLastname($data['lastname']);

            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);

            $data['errors']['phoneErr'] = $this->vld->validatePhone($data['phone']);

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
                'lastname' => '',
                'email'     => '',
                'phone' => '',
                'adress' => '',
                'password'  => '',
                'passwordRepeat' => '',
                'errors' => [
                    'nameErr'      => '',
                    'lastnameErr' => '',
                    'emailErr'     => '',
                    'phoneErr' => '',
                    'adressErr' => '',
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

            $data['errors']['passwordErr'] = $this->vld->validateEmpty($data['password'], 'Įveskite slaptažodį');

            if ($this->vld->ifEmptyArr($data['errors'])) {

                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {

                    $this->createUserSession($loggedInUser);
                    print_r($loggedInUser);
                } else {
                    $data['errors']['passwordErr'] = 'Neteisingas slaptažodis arba el. paštas';
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
        $_SESSION['id'] = $userRow->id;
        $_SESSION['email'] = $userRow->email;
        $_SESSION['name'] = $userRow->name;
        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);

        session_destroy();

        redirect('/pages/index');
    }
}
