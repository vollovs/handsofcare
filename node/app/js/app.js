'use strict';

angular.module('siteApp', [ 'ngRoute' ])
	.config(function($routeProvider) {
		$routeProvider.when('/home', {
			templateUrl : 'views/home.html'
		})
		.when('/contacts', {
			templateUrl : 'views/contacts.html'
		})
		.when('/motor-vehicle-accident', {
			templateUrl : 'views/motor-vehicle-accident.html'
		})
		.otherwise({
			redirectTo : '/home'
		});
	});