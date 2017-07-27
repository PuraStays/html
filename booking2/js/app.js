var app = angular.module('pura', ['ui.router', 'ui.bootstrap', 'ngSanitize', 'ngAnimate', 'ngStorage']);

app.run(function($rootScope, $templateCache) {
   
});

app.config(function($stateProvider, $urlRouterProvider, $locationProvider, $localStorageProvider) {
 
  $localStorageProvider.setKeyPrefix('pura');
 
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
	          //var url = "data/cluster.json";
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
	});

	$stateProvider.state("Base", {});

    $stateProvider.state("booking.Modal", {
	    views:{
	      "modal": {
	        templateUrl: "modal.html"
	      }
	    },
	    onEnter: function($state){
	      // Hitting the ESC key closes the modal
	      $(document).on('keyup', function(e){
	        if(e.keyCode == 27){
	          $(document).off('keyup')
	          $state.go('Base')
	        }
	      });

	      // Clicking outside of the modal closes it
	      $(document).on('click', '.Modal-backdrop, .Modal-holder', function() {
	        $state.go('Base');
	      });

	      // Clickin on the modal or it's contents doesn't cause it to close
	      $(document).on('click', '.Modal-box, .Modal-box *', function(e) {
	        e.stopPropagation();
	      });
	    },
	    abstract: true
  	});

	  $stateProvider.state("Modal.confirmAddToCart", {
	    views:{
	      "modal": {
	        templateUrl: "partials/modals/confirm.html"
	      }
	    }
	  });

	  $stateProvider.state("Modal.success", {
	    views:{
	      "modal": {
	        templateUrl: "partials/modals/success.html"
	      }
	    }
	  });
});

app.directive('fallbackSrc', function () {
  var fallbackSrc = {
    link: function postLink(scope, iElement, iAttrs) {
      iElement.bind('error', function() {
        angular.element(this).attr("src", iAttrs.fallbackSrc);
      });
    }
   }
   return fallbackSrc;
});

app.directive("roomlist", function() {
    return {
        restrict: 'A',
        scope: {
        	addroom : '&'
        },
        link: function(scope, element, attrs) {            
            scope.room = JSON.parse(attrs.roomdata);
           	//checking object or array 
           	scope.images = [];
           	if( Array.isArray(scope.room.imgs.img) ){
           		scope.images = scope.room.imgs.img;
           	}else{
           		scope.images = [scope.room.imgs.img];
           	}
           	//checking object or array
           	scope.aminities = [];
           	if( Array.isArray(scope.room.amenities.amenity) ){
           		scope.aminities = scope.room.imgs.img;
           	}else{
           		scope.aminities = [scope.room.amenities.amenity];
           	}
           	//checking object or array
           	scope.rates = [];
           	if( Array.isArray(scope.room.rates.rate) ){
           		scope.rates = scope.room.rates.rate;
           	}else{
           		scope.rates = [scope.room.rates.rate];
           	}

            scope.roomcount = 0;
            scope.showDetails = false; 
            scope.added = false;   

            var totalPrice = function(price, room){
            	return (price==0 ? 0 : (price * room));
            }

            scope.addRm = function(){
            	//console.log(totalPrice(scope.room.rates[0]._price,5));            	           
            	scope.room.totalPrice = totalPrice(parseInt(scope.room.rates.rate[0]._price) + parseInt(scope.room.rates.rate[0]._tax), scope.roomcount);
            	scope.room.room_count = scope.roomcount;    
            	scope.addroom({roombooked : scope.room});          
            	console.log(scope.room); 
            }

            scope.checkfun = function(){
            	if(scope.added != false){
            		scope.added = false;
            	}else{
            		scope.added = true;
            	}
            }            

            scope.removed = function(){
            	if(scope.added != false){
            		scope.added = false;
            	}else{
            		scope.added = true;
            	}
            }

            scope.changeAminityDisplay = function(){
            	if(scope.showDetails != false){
            		scope.showDetails = false;
            	}else{
            		scope.showDetails = true;
            	}
            }        
            scope.substractOne = function () {
            	if(!scope.added){
		        	if(scope.roomcount > 0){
		            	scope.roomcount -= 1;
		        	}	
		        }	
	        };
    		scope.addOne = function () {
	    		if(!scope.added){
	    			if(scope.roomcount < scope.room._availableroom){
		            	scope.roomcount = parseInt(scope.roomcount) + 1;
		            }	
		        }    
	        };


        },
        templateUrl: 'partials/modal/room-list-directive.html'
    }
})

app.directive("activityProgram", function(){
	return{
		restrict: 'E',
		templateUrl: 'partials/modal/activity-program-directive.html',
		scope: {
			prgm: '=',
			addprogram: '&',
			removeprogram: '&'
		},
		link: function(scope, elem, attrs){
			scope.btnHide = false;
			var count = attrs.personcount;
			scope.totPerson = [];

			for(var i=1; i<= count; i++){
				scope.totPerson.push(i);
			}
			angular.forEach(scope.prgm.groups,function(ob, index){                
                angular.forEach(ob, function(ob1, index1){ 
                	ob1.activitiesCount = ob1.activities.length;               	
                	angular.forEach(ob1.activities,function(ob2, index2){	
                		ob2.checked = false;
                		ob2.seqId = index2;
                	})	
                })
            })

			console.log(scope.prgm);
			scope.totalActPrice = scope.prgm.unit_price * 0;
			scope.getCurrentPrice = function(curr){
				scope.forPersonCount = curr;				
				return scope.totalActPrice = scope.prgm.unit_price * curr;
			}

			scope.addPr = function(){
				scope.error = {"show": false}
				if(Object.getOwnPropertyNames(scope.selected).length != 0){
					if(scope.totalActPrice>0){
						scope.error = {"show": false};
						scope.prgm.forPerson = scope.forPersonCount;
						scope.prgm.selectedActivity = scope.selected;
						scope.prgm.totalPrice = scope.totalActPrice;
						scope.addprogram({pr: scope.prgm});				
					}else{
						scope.error = {"msg": "please select number of person", "show": true}
					}
				}else{
					scope.error = {"msg": "please select Activities you like", "show": true}
				}
			}

			scope.managebtn = function(){				
				if(scope.totalActPrice>0){
					scope.error = {"show": false};
					if(scope.btnHide == false){
						scope.btnHide = true;
					}
					else{
						scope.btnHide = false;	
					}
				}else{
					scope.totalActPrice=0;
					scope.error = {"msg": "please select number of person", "show": true}
				}
			}

			scope.selected = {};
	        scope.maxSelected = function(lim){
	            var count = 0;
	            for(x in scope.selected){
	                if(scope.selected[x]){
	                	count++;
	                }	
	            }

	            /*angular.forEach(scope.prgm.groups,function(ob, index){                
	                angular.forEach(ob, function(ob1, index1){                	
	                	angular.forEach(ob1.activities,function(ob2, index2){	
	                		ob2.checked = false;
	                		ob2.seqId = index2;
	                	})	
	                })
	            })*/

	            //console.log(scope.selected);
	            return (count===lim) ? true : false;
	        };
		}
	}
})



