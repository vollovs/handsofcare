<?php
class Controller {
	protected $_controller;
	protected $_action;
	protected $_template;

	public $doNotRenderHeader;
	//public $render;
	
	function __construct($controller, $action) {

		$this->_controller = $controller;
		$this->_action = $action;
		
		$model = ucfirst($controller);
		$this->doNotRenderHeader = 0;
		//$this->render = 1;

		$this-> $model = new $model();
		$this->_template = new Template($controller,$action);

		//set global host url
		$host_url = 'http://'.$_SERVER['HTTP_HOST'];
		$this->_template->set('url_root',$host_url);
	}

	/**
	 * redirect view
	 */
	function redirect($controller, $view) {
		$this->_template->_view = $view;
		$this->_template->_controller = $controller;
	}
	
	function set($name, $value) {
		$this->_template->set($name, $value);
	}

	function __destruct() {
		$this->_template->render($this->doNotRenderHeader);
	}

}
