<?php 

class SiteController extends Controller{

    public function __construct(){
		// construct of class
	}

    public function index(){
		
        $data = array();

        if ( !$_SESSION["id"] ) {

            header("location: ".BASE_URL."Login");

        } else {

            $this->loadTemplateSite('Home/index', $data);

        };
        
    }
}