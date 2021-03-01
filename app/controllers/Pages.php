<?php

namespace MyApp\app\controllers;

use MyApp\app\libraries\Controller;

class Pages extends Controller
{


    public function __construct()
    {
   
    }

    public function index()
    {
 
    
        $data = [
            'title' => SITENAME,
            'currentPage' => 'index'
        ];

        $this->view('pages/index', $data);
    }

    public function comments()
    {
        $data = [
            'title' => 'This is Comments page',
            'currentPage' => 'comments'
        ];
        $this->view('pages/comments', $data);
    }
}
