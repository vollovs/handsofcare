<?php
/*
 * Created on Feb 24, 2012
 *
 * Bootstrap the request
 */
 
/** Check if environment is development and display errors **/
function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
	}
}

/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function performAction($controller,$action,$queryString = null,$doNotrender = 0) {	
	$controllerName = ucfirst($controller).'Controller';
	$dispatch = new $controllerName($controller,$action);
	$dispatch->doNotRenderHeader = $doNotrender;
	return call_user_func_array(array($dispatch,$action),$queryString);
}

/**
 * create a model instance and call method
 */
function callModel($model, $method, $parameters = array()){	
	$modelName = ucfirst($model);
	$instance = new $modelName();
	return call_user_func_array(array($instance,$method),$parameters);
}

function removeMagicQuotes() {
	if ( get_magic_quotes_gpc() ) {
		$_GET    = stripSlashesDeep($_GET   );
		$_POST   = stripSlashesDeep($_POST  );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

/** Routing **/
function routeURL($url) {
	global $routing;
	
	foreach ( $routing as $pattern => $result ) {		
		if ( preg_match( $pattern, $url ) ) {
			return preg_replace( $pattern, $result, $url );
		}
	}	

	return null;
}
 
/**
 * Main Function for each http request.
 * The url pattern: controller/action/querystring
 */
function callHook() {
	global $url;
	global $default;
	
	$queryString = array();

	if (!isset($url)) {
		$controller = $default['controller'];
		$action = $default['action'];
	} else {
		$url = routeURL($url);
		// if $url is null, return 404 error
		if(empty($url)) {
			$controller = $default['controller'];
			$action = 'error';
		} else {
//debug statement
//echo "url->".$url;
			$urlArray = array();
			$urlArray = explode("/",$url);
//debug statement
//print_r($urlArray);
	
			// fetch controller form array 0	
			$controller = $urlArray[0];
			//shift out the first array element
			array_shift($urlArray);
	
			if (isset($urlArray[0])) {
				$action = $urlArray[0];			
			} else {
				$action = $default['action'];
			}
			
			//process controller parameters
			if(count($urlArray) > 1) {
				array_shift($urlArray);
			} else {
				$urlArray = array();
			}		
				
			$queryString = $urlArray;
		} //end else
	}
	
	$controllerName = ucfirst($controller).'Controller';
	$dispatch = new $controllerName($controller,$action);
	
	//echo 'ctrl->'.$controller.' act->'.$action;
	
	if ((int)method_exists($controllerName, $action)) {
		call_user_func_array(array($dispatch,$action),$queryString);
	} else {
		/* Error Generation Code Here */
	}
}

/** Autoload any classes that are required **/
function __autoload($className) {
	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower(substr($className, 0, 1)).substr($className,1) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower(substr($className, 0, 1)).substr($className,1) . '.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

setReporting();
removeMagicQuotes();
callHook();
