var app = angular.module('bandmanagerApp', []);

app.config(['$interpolateProvider', '$httpProvider', 
function($interpolateProvider, $httpProvider) {

	$interpolateProvider.startSymbol('{(').endSymbol(')}');
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

}]);

// Band controller
app.controller('bandCtrl', 
['$scope' , '$http', 
function($scope, $http) {
	
	$scope.pageId = pageId;	// Got this from backend

	$scope.init = function() {
		$scope.pageEvents();
	};

	$scope.pageEvents = function() {

		var params = {
			method: 'POST',
			url: '/band/events',
			data: { pageId: $scope.pageId }
		};

		var eventsPromise = $http(params);
		
		eventsPromise
			.then(function(response) {
				$scope.events = response.data.events;

				console.log($scope.events);
			});
	};

	$scope.init();

}]);