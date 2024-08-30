<?php 

Class Controller{
	public function loadView($viewName, $viewData = array() ){
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}
	public function loadViewInTemplate($viewName, $viewData = array()){
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

	public function loadLibrary($lib){
		if(file_exists('Vendor/'.$lib.'.php')){
			require_once 'Vendor/'.$lib.'.php';

		}
	}
}