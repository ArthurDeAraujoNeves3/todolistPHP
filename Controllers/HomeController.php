<?php

class HomeController extends Controller {

    private $data = array();

    public function index() {

        if ( !$_SESSION[CONF_SESSION_NAME] ) {

            header("location: ".BASE_URL."Login");

        } else {

            $this->loadTemplateSite('Home/index', $this->data);

        };

    }

};
