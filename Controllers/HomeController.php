<?php

class HomeController extends Controller {

    private $data = array();

    public function index() {

        //var_dump($_SESSION);
        
        if ( !$_SESSION[CONF_SESSION_NAME] ) {

            header("location: ".BASE_URL."Login");
            exit();

        } else {

            $this->loadView('Home/index', $this->data);

        };

    }

};
