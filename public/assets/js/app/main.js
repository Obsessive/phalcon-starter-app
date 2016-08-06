
var app = angular.module('BandManagerApp', ['angular.filter']);

app.config(['$interpolateProvider', '$httpProvider', 
function($interpolateProvider, $httpProvider) {
	$interpolateProvider.startSymbol('{(').endSymbol(')}');
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
}]);


// Dashboard controller
app.controller('dashboardCtrl', ['$scope', '$http', 
function($scope, $http) {
	
	$scope.showHideEditProfileForm = function() {
		angular.element('#edit-profile-form').toggleClass('hidden animated fadeInLeft');
	};

	$scope.updateProfile = function() {

		if (!$scope.number || isNaN($scope.number)) {
			$.notify('Phone number is required and it can contain only digits <br> (Example: 385951112222)');
			return;
		}

		var data = {
			name: $scope.name,
			location: $scope.location,
			email: $scope.email,
			number: $scope.number
		}

		var params = {
			method: 'POST',
			url: '/dashboard/update_user',
			data: data
		};

		var updateProfilePromise = $http(params);

		updateProfilePromise
			.then(function(response) {
				if (data.code == 0) {
					$.notify(data.errorMsg);
				}
				else {
					window.location.reload();
				}
			}, function(error) {
				$.notify('Whoops...An error occured');
			});
	};

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

				if (! $scope.events) {
					$.notify("No events found.");
					return;
				}

				angular.forEach($scope.events, function(ev, key){
					$scope.events[key].start_time.date = moment(ev.start_time.date).format('LLLL');
				});

				angular.element('#eventsList').removeClass('hidden');
				angular.element('#eventsList').addClass('animated flipInY');

			}, function(response) {
				$.notify('Whoops...An error occured while fetching band events from Facebook');
			});
	};

	$scope.hideShowDescription = function(event) {
		angular.element('#descr-' + event.id).toggleClass('hidden animated flipInY');
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
				if (data.code == 0)
					$.notify(data.errorMsg);
				else
					window.location.reload();

			}, function(response) {
				$.notify('Whoops...An error occured, sorry. Please, try again.');
			});

	};

}]);

// Venues controller
app.controller('venuesCtrl', 
['$scope', '$http', 
function($scope, $http) {

	$scope.venues = [];

	$scope.getVenues = function() {

		var venuesPromise = $http.get('/venues/json');
		venuesPromise.
			then(function(response) {
				$scope.venues = response.data;
			}, function(err) {
				$.notify('Whoops...An error occured while loading venues, sorry.');
			});
	};

	$scope.showHideVenuesForCountry = function(country) {
		angular.element('#' + country).toggleClass('hidden animated fadeInLeft');
	};

	$scope.showVenueDetails = function(venue) {

		angular.element('#countries').fadeOut();

		var params = {
			method: 'POST',
			url: '/venues/details',
			data: {
				'place_id': venue.place_id
			}
		}

		var venueDetailsPromise = $http(params);

		venueDetailsPromise
			.then(function(response) {
				$scope.selectedVenueData = response.data.result;
				angular.element('#venueDetails').fadeIn();
			}, function(err) {
				$.notify("Whoops...Error while loading venue data, sorry");
			});
	};

	$scope.hideVenueDetails = function() {
		angular.element('#venueDetails').fadeOut(function() {
			angular.element('#countries').fadeIn();
		});
	};

	$scope.getVenues();

}]);