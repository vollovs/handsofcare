<?php
/*
 * Created on Mar 3, 2012
 *
 * dike.zhang@gmail.com
 * the controller just control the page
 */

class MainController extends Controller {

	function home() {
		$this->set('title', 'Home');
	}
	
	function contact() {
		$this->set('title', 'Contact Page');
	}
	
	function motor_vehicle_accident() {
		$this->set('title', 'motor vehicle accident');
	}
	
	function error() {
		$this->set('title', '404 Error: File not found');
	}
}
