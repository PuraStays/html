var app = angular.module('pura');

app.controller('AppCtrl', function($scope, $uibModal, $log, $window){	
   $scope.openSmry = false;
  
	 $scope.openSummry = function(){
     if($scope.openSmry == false){
        $scope.openSmry = true;
     }else{
       $scope.openSmry = false;
     }
   }


   // In your controller
    var w = angular.element($window);
    $scope.$watch(
      function () {
        return $window.innerWidth;
      },
      function (value) {
        $scope.windowWidth = value;
        if(value<767){
          $scope.openSmry = false;
        }else{
          $scope.openSmry = true;
        }
      },
      true
    );

    w.bind('resize', function(){
      $scope.$apply();
    });

})

app.controller('SideBarCtrl', function($scope,$rootScope, $uibModal, $log, sideBarSrvc, $state){  
   $scope.whereData = sideBarSrvc.getWhere();
   $scope.whenData = sideBarSrvc.getWhen();  
   $scope.personData = sideBarSrvc.getPerson();

   $rootScope.$on("sideBarCtrlWhereMethod", function(){
       $scope.updateWhere();
    });

   $scope.updateWhere = function(){
     $scope.whereData = sideBarSrvc.getWhere();      
   }

   $rootScope.$on("sideBarCtrlWhenMethod", function(){
       $scope.updateWhen();
    });

   $scope.updateWhen = function(){
     $scope.whenData = sideBarSrvc.getWhen();     
   }

   $rootScope.$on("sideBarCtrlPersonMethod", function(){
       $scope.updatePerson();
    });

   $scope.updatePerson = function(){
     $scope.personData = sideBarSrvc.getPerson();  
     console.log($scope.personData);    
   }

   //naavigations
   $scope.goToWhere = function(){
     $state.go('booking.where');
     $scope.pageClass = "fade";
   }

   $scope.goToWhen = function(){
     $state.go('booking.when');
     $scope.pageClass = "fade";
   }

   $scope.goToPerson = function(){
     $state.go('booking.person');
     $scope.pageClass = "fade";
   }

   $scope.goToPackage = function(){
     $state.go('booking.rooms');
     $scope.pageClass = "fade";
   }

})

app.controller('WhereCtrl', function($rootScope, $scope, $state, clusterList, sideBarSrvc){
  $scope.itemArray = clusterList;
  $scope.selected = { value: $scope.itemArray[0] };

  $scope.next = function(){
    $state.go('booking.when');
    $scope.pageClass = "forward";
    sideBarSrvc.setWhere($scope.selected.value);    
    //update where data
    $rootScope.$emit("sideBarCtrlWhereMethod", {});
  }
})

app.controller('WhenCtrl', function($rootScope, $scope, $state, sideBarSrvc, $filter){
  
 
  $scope.next = function(){
    $scope.pageClass = "forward";
     if($scope.when.diff>0){       
      $state.go('booking.person');      
      sideBarSrvc.setWhen($scope.when);
      //update when data
      $rootScope.$emit("sideBarCtrlWhenMethod", {});
    }
  }

  $scope.back = function(){
    $scope.pageClass = "backward";
  	$state.go('booking.where');
  }

   var today = new Date();
   today = $filter('date')(new Date(), 'MM/dd/yyyy');
   $scope.when = {
      start: today,
      end: today
   }

  $scope.diff = function() {
    var dt1 = $scope.when.start.split('/'),
    dt2 = $scope.when.end.split('/'),
    one = new Date(dt1),
    two = new Date(dt2);   

    var millisecondsPerDay = 1000 * 60 * 60 * 24;
    var millisBetween = two.getTime() - one.getTime();
    
    var days = millisBetween / millisecondsPerDay;        
    return Math.floor(days);      
  };
   
  $scope.color = function() {
    return ($scope.diff() < 0) ? true : false;        
  };

  $scope.$watch('[when.start, when.end]', function(currScope,newVal,oldVal) {        
    $scope.when.diff = $scope.diff();       
    $scope.txtcolor = $scope.color();  
    if($scope.when.diff>0){
      $scope.activebtn = true;
    }else{
      $scope.activebtn = false;
    }
  });
})

app.controller('PersonCtrl', function($rootScope, $scope, $state, sideBarSrvc, roomDataSrvc){  
  $scope.person = {};
  $scope.person.adult = {number:1, min:1, max:15};
  $scope.person.child = {number:0, min:0, max:5};  
 
  $scope.next = function(){
    $scope.pageClass = "forward";
    sideBarSrvc.setPerson($scope.person);
    if(!$scope.txtcolor){
    	$state.go('booking.rooms');
      $rootScope.$emit("sideBarCtrlPersonMethod", {});
      roomDataSrvc.setHotels();
    }
  }
  $scope.back = function(){
    $scope.pageClass = "backward";
  	$state.go('booking.when');
  }
 
  $scope.$watch('[person.adult.number, person.child.number]', function(currScope,newVal,oldVal) {        
    if($scope.person.adult.number>0 && $scope.person.child.number >=0){
      $scope.activebtn = true;
      $scope.txtcolor = false;
    }else{
      $scope.activebtn = false;
      $scope.txtcolor = true;
    }          
  });

})

app.controller('RoomsCtrl', function($scope, $state, $uibModal, $log, roomDataSrvc){
  $scope.$on('$viewContentLoaded', function() {
    $scope.hotellist = roomDataSrvc.getHotels();
  });

  $scope.next = function(){
    $scope.pageClass = "forward";
  	$state.go('booking.programs');
  }
  $scope.back = function(){
    $scope.pageClass = "backward";
  	$state.go('booking.person');
  }
  $scope.open = function (size) {
      var modalInstance = $uibModal.open({
      backdrop  : 'static',
  	  keyboard  : false,
      animation: true,
      templateUrl: 'partials/modal/room-selection.html',
      controller: 'RoomSelectionModalCtrl',
      size: size,
      resolve: {
          hotels: function () {
            return $scope.hotellist;
          }
        }
      });

      modalInstance.result.then(function (selectedItem) {
        $scope.selected = selectedItem;
      }, function () {
        $log.info('Modal dismissed at: ' + new Date());
      });
  }

	  
})

app.controller('ProgramsCtrl', function($scope, $state, $uibModal, $log){
  $scope.next = function(){
      $scope.pageClass = "forward";
    	$state.go('booking.summary');
    }
    $scope.back = function(){
      $scope.pageClass = "backward";
    	$state.go('booking.rooms');
    }
    $scope.open = function(size){
        var modalInstance = $uibModal.open({
        backdrop  : 'static',
        keyboard  : false,
        animation: true,
        templateUrl: 'partials/modal/program-selection.html',
        controller: 'ProgramSelectionModalCtrl',
        size: size,
        resolve: {
            items: function () {
              return $scope.items;
            }
          }
        });

        modalInstance.result.then(function (selectedItem) {
          $scope.selected = selectedItem;
        }, function () {
          $log.info('Modal dismissed at: ' + new Date());
        });    
    }
})

app.controller('SummaryCtrl', function($scope, $state){
  $scope.back = function(){
      $scope.pageClass = "backward";
    	$state.go('booking.programs');
    }
})

app.controller('TabsDemoCtrl', function ($scope, $window) {
  $scope.tabs = [
    { title:'Dynamic Title 1', content:'Dynamic content 1' },
    { title:'Dynamic Title 2', content:'Dynamic content 2', disabled: true }
  ];

  $scope.alertMe = function() {
    setTimeout(function() {
      $window.alert('You\'ve selected the alert tab!');
    });
  };

  $scope.model = {
    name: 'Tabs'
  };
});



app.controller('RoomSelectionModalCtrl', function ($scope, $uibModalInstance, hotels) {

  $scope.hotelslist = hotels.hotels;

  $scope.ok = function () {
    $uibModalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});

app.controller('ProgramSelectionModalCtrl', function ($scope, $uibModalInstance) {

  $scope.ok = function () {
    $uibModalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});

