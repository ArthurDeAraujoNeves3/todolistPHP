<?php

class RegisterController extends Controller {

    public function index() {

        $data = array();

        $this->loadView("Register/index", $data);

    }

}
