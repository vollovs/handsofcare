<?php
class Template {

	protected $variables = array();
	protected $_controller;
	protected $_action;
	
	// reset current view
	protected $_view;

	function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_view = $action;
	}

	/**
	 *  Set variables for view page 
	 */
	function set($name,$value) {
		$this->variables[$name] = $value;
	}
	
	/**
	 *  Display Template page
	 */
	function render($doNotRenderHeader = 0) {
		
		extract($this->variables);
		
		if ($doNotRenderHeader == 0) {
			
			if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
				include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
			} else {
				include (ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
			}

		include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_view . '.php');		 

			if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
				include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
			} else {
				include (ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
			}
		}
    }

}
