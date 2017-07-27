var app = angular.module('pura', ['ui.router', 'ui.bootstrap', 'ui.select', 'ngSanitize','ngAnimate']);

app.run(function($rootScope, $templateCache) {
    $rootScope.$on('$routeChangeStart', function(event, next, current) {
        if (typeof(current) !== 'undefined'){
            $templateCache.remove(current.templateUrl);
        }
    });
});

app.config(function($stateProvider, $urlRouterProvider, $locationProvider) {
  	
  // For any unmatched url, redirect to /state1
  $urlRouterProvider.otherwise("/booking/where");
  //
  // Now set up the states
	$stateProvider

	.state('booking', {
		url: '/booking',
		templateUrl: 'partials/booking.html',
		abstract: true,
		resolve: {
	        clusterList: function($q, $http) {
	          var defer = $q.defer();
	          var url = "http://api.purastays.com/clusters";
	          $http.get(url)
	          .success(function(data) {
	            defer.resolve(data.cluster);
	          })
	          return defer.promise;
	        }
	      }
	})
	
	.state('booking.where', {
		url: '/where',
		templateUrl: 'partials/booking/where.html',
		controller: 'WhereCtrl'
	})
	
	.state('booking.when', {
		url: '/when',
		templateUrl: 'partials/booking/when.html',
		controller: 'WhenCtrl'	
	})
	
	.state('booking.person', {
		url: '/person',
		templateUrl: 'partials/booking/person.html',
		controller: 'PersonCtrl'
	})
	
	.state('booking.rooms', {
		url: '/rooms',
		templateUrl: 'partials/booking/rooms.html',
		controller: 'RoomsCtrl'
	})
	
	.state('booking.programs', {
		url: '/programs',
		templateUrl: 'partials/booking/programs.html',
		controller: 'ProgramsCtrl'
	})
	
	.state('booking.summary', {
		url: '/summary',
		templateUrl: 'partials/booking/summary.html',
		controller: 'SummaryCtrl'
	})
	
});
