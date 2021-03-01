<?php

class Pages extends Controller
{


    public function __construct()
    {
   
    }

    public function index()
    {
 
    
        $data = [
            'title' => 'Welcome to ' . SITENAME,
        ];

        $this->view('pages/index', $data);
    }
}
