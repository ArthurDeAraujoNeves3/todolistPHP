<?php 

Class Controller{
	public function loadView($viewName, $viewData = array() ){
		extract($viewData);
		require 'Views/'.$viewName.'.php';
	}

	public function loadTemplateSite($viewName, $viewData = array()){	
		require 'Views/Templates/'.TEMPLATE.'.php';
	}
	public function loadTemplateAdmin($viewName, $viewData = array()){	
		require 'Views/Templates/'.TEMPLATE_ADMIN.'.php';
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