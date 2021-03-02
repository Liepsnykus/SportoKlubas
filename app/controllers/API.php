<?php

namespace MyApp\app\controllers;

use MyApp\app\libraries\Validation;
use MyApp\app\models\Comment;

class API
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment;
    }

    public function postComment()
    {

        $vld = new Validation;
        if ($vld->ifRequestIsPostAndSanitize()) {
            $data = [
                'user_id' => $_POST['user_id'],
                'name' => $_POST['user'],
                'text' => $_POST['text'],
                'errors' => [
                    'textError' => ''
                ]
            ];

            $data['errors']['textError'] = $vld->validateEmpty($data['text'], 'Įveskite komentarą');

            if(empty($data['errors']['textError'])){
                $data['errors']['textError'] = $vld->validateLength($data['text'], 'Komentaras negali viršyti 500 simbolių');
            }

            if(empty($data['errors']['textError'])) {
                if($this->commentModel->addComment($data)) {
                    $data['success'] = true;
                }
            } 
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        die();

    }

    public function getComments() {

        $comments = $this->commentModel->getComments();
        $data = [
            "comments" => $comments
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }
}
