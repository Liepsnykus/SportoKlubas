<?php

namespace MyApp\app\libraries;

use MyApp\app\controllers\API;
use MyApp\app\controllers\Pages;
use MyApp\app\controllers\Users;

/* App Core class
 * Create URL & loads controller
 * URL format /controller/method/params
 */
class Core
{
    // nusistatom pradines nustatytasias reiksmes
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {


        $url = $this->getUrl();
        // check if user asked for controller
        if (isset($url[0])) {
            // Look into controllers dir for the controller name
            // if such file exists
            if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->currentController = ucfirst($url[0]);
                // clean value that was taken
                unset($url[0]);
            }
        }
        // Require the controller that user asked
        //require_once '../app/controllers/' . $this->currentController . '.php';

        // instanciate an objec of current class
        // if entered pages
        // Pages = new Pages;
        if($this->currentController == 'Pages'){
            $this->currentController = new Pages;
        } elseif($this->currentController == 'Users') {
            $this->currentController = new Users;
        } elseif($this->currentController == 'API') {
            $this->currentController = new API;
        }

        // check for second(method) values in url params
        if (isset($url[1])) {
            // check if there is a method name in the class
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // clean value that was taken
                unset($url[1]);
            }
        }

        // to test if it works
        // echo 'our current method is: ' . $this->currentMethod;

        // Get params from url
        if (isset($url[2])) {
            $this->params = $url ? array_values($url) : [];
        }
        // print_r($this->params);

        // we call current controller and method and params if present
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // echo url parameter
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            // trim  slash from the right
            $url = rtrim($_GET['url'], '/');
            // sanitize url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // make url into array 
            $url = explode('/', $url);
            return $url;
        }
    }
}
