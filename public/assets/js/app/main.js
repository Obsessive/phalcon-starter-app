var app = angular.module('BandManagerApp', []);

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

				angular.forEach($scope.events, function(ev, key){
					$scope.events[key].start_time.date = moment(ev.start_time.date).format('LLLL');
				});

				angular.element('#eventsList').removeClass('hidden');
				angular.element('#eventsList').addClass('animated slideInUp');
			});
	};

	$scope.init();
}]);


// Rehersals controller
app.controller('rehersalsCtrl', 
['$scope' , '$http',
function($scope, $http) {

	$scope.bandId;
	$scope.location;
	$scope.note = '';

	$scope.today = moment().format('YYYY-MM-DD hh:mm');
	$scope.dateTime = new Date($scope.today);

	$scope.addRehersal = function() {
		
		$scope.bandId = angular.element('option:selected').val();

		if (! $scope.bandId || ! $scope.location) {
			$.notify('Band and location are required.');
			return;
		}

		if (moment($scope.dateTime) < moment()) {
			$.notify('Date and time of the rehersal must be in the future.');
			return;
		}

		var parsedDateTime = moment($scope.dateTime).format('YYYY-MM-DD HH:mm') + ':00';

		var params = {
			method: 'POST',
			url: '/rehersals/add',
			data: { 
				band_id : $scope.bandId,
				location: $scope.location,
				date_time: parsedDateTime,
				note: $scope.note
			}
		};

		var rehersalPromise = $http(params);

		rehersalPromise
			.then(function(response) {
				var data = response.data;
				console.log(data);
				
				if (data.code == 0) {
					$.notify(data.error);
				}
				else {
					window.location.reload();
				}
			});

	};

}]);