var app = angular.module('pura');

app.controller('AppCtrl', function($scope, $rootScope, $uibModal, $log, $window){	
		localStorage.removeItem('purawhere');
		localStorage.removeItem('purawhen');
		localStorage.removeItem('puraperson');
		localStorage.removeItem('purarooms');
		localStorage.removeItem('puraprg');
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
   $scope.roomsData = sideBarSrvc.getRooms();
   $scope.programData = sideBarSrvc.getProgram();
   
   
   $rootScope.$on("sideBarCtrlWhereMethod", function(){        
    $scope.updateWhere();
	$scope.whenData = '';  
    $scope.personData = '';
    $scope.roomsData = '';
    $scope.programData = '';
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
   }

   $rootScope.$on("sideBarCtrlRoomsMethod", function(){
       $scope.updateRooms();
    });

   $scope.updateRooms = function(){     
     $scope.roomsData = sideBarSrvc.getRooms();
   }


   $rootScope.$on("sidebarCtrlProgramMethod", function(){
       $scope.updateProgram();
    });

   $scope.updateProgram = function(){         
     $scope.programData = sideBarSrvc.getProgram();              
   }

   //navigations
   $scope.goToWhere = function(){
     sideBarSrvc.setProgram([]);
     sideBarSrvc.setRooms([]);     
     $rootScope.$emit("sideBarCtrlRoomsMethod", {}); 
     $rootScope.$emit("sidebarCtrlProgramMethod", {});
     $state.go('booking.where');
     $scope.pageClass = "fade";
   }

   $scope.goToWhen = function(){
     sideBarSrvc.setProgram([]);
     sideBarSrvc.setRooms([]);     
     $rootScope.$emit("sideBarCtrlRoomsMethod", {}); 
     $rootScope.$emit("sidebarCtrlProgramMethod", {});
     $state.go('booking.when');
     $scope.pageClass = "fade";
   }

   $scope.goToPerson = function(){
     sideBarSrvc.setProgram([]);
     sideBarSrvc.setRooms([]);     
     $rootScope.$emit("sideBarCtrlRoomsMethod", {}); 
     $rootScope.$emit("sidebarCtrlProgramMethod", {}); 
     $state.go('booking.person');
     $scope.pageClass = "fade";
   }

   $scope.goToRooms = function(){
     sideBarSrvc.setProgram([]);
     $rootScope.$emit("sidebarCtrlProgramMethod", {});
     $state.go('booking.rooms');
     $scope.pageClass = "fade";

   }

   $scope.goToPrograms = function(){
     $state.go('booking.programs');
     $scope.pageClass = "fade";
   }

})

app.controller('WhereCtrl', function($rootScope, $window, $scope, $state, $localStorage, clusterList, sideBarSrvc, $http){
 
  $scope.itemArray = clusterList;
  $scope.where = {
     cluster: clusterList[0]
  };

  //getting resorts
  $scope.getResorts = function(param){ 
    $rootScope.overlay = true;    
    var url = 'http://api.purastays.com/resorts/id/'+param.id;
    $http.get(url).then(function(res){  
      $scope.where.resort = res.data.resorts.list[0];      
      $scope.resortList = res.data.resorts.list;      
      $rootScope.overlay = false;
    })    
  }

  if(sideBarSrvc.getWhere() == 0){
    //calling resort for the first time
    $scope.getResorts(clusterList[0]);
  }else{       
    $scope.where = sideBarSrvc.getWhere();
    $scope.where.cluster = sideBarSrvc.getWhere().cluster;
    $scope.where.resort = sideBarSrvc.getWhere().resort;
    $scope.getResorts($scope.where.cluster);    
  }

  
  $scope.next = function(){
    $state.go('booking.when');
    $scope.pageClass = "forward";
    sideBarSrvc.setWhere($scope.where);    
    //update where data
    $rootScope.$emit("sideBarCtrlWhereMethod", {});
  }
})

app.controller('WhenCtrl', function($rootScope, $scope, $state, sideBarSrvc, $filter, stateCheckSrvc){
  
  $scope.$on('$viewContentLoaded', function() {      
    stateCheckSrvc.checkAndStart();
  });   

  var today = new Date();
  var tomorrow = new Date();
  tomorrow.setDate(today.getDate() + 1);

  today = $filter('date')(new Date(), 'MM/dd/yyyy');
  tomorrow = $filter('date')(tomorrow, 'MM/dd/yyyy');

  $scope.when = {};

  if(sideBarSrvc.getWhen() == 0){
    $scope.when = {
      start: today,
      end: tomorrow
    }
  }else{    
    $scope.when.start = sideBarSrvc.getWhen().start;
    $scope.when.end = sideBarSrvc.getWhen().end;
  }   

  $scope.diff = function() {
    //var dt1 = $scope.when.start.split('/');
    //var dt2 = $scope.when.end.split('/');
    var one = new Date($scope.when.start);
    var two = new Date($scope.when.end);   

    var timeDiff = Math.abs(two.getTime() - one.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

    //var dates = two.getDate() - one.getDate();
    return Math.floor(diffDays);      
  };
   
  $scope.color = function() {
    return ($scope.diff() < 0) ? true : false;        
  };
 
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
    localStorage.removeItem('purawhen');
    localStorage.removeItem('puraperson');
    localStorage.removeItem('purarooms');
    localStorage.removeItem('puraprg');
    sideBarSrvc.setWhen({"start": today, "end": tomorrow, "diff": 1});    
    $rootScope.$emit("sideBarCtrlWhenMethod", {});    
  	$state.go('booking.where');    
  }

  

  $scope.$watch('[when.start, when.end]', function(newVal,oldVal) { 
       
    $scope.when.diff = $scope.diff();       
    $scope.txtcolor = $scope.color();  
    if($scope.when.diff>0){
      $scope.activebtn = true;
    }else{
      $scope.activebtn = false;
    }
  });
})

app.controller('PersonCtrl', function($q, $http, $rootScope, $scope, $state, sideBarSrvc, roomDataSrvc,stateCheckSrvc){  
  $scope.$on('$viewContentLoaded', function() {      
    stateCheckSrvc.checkAndStart();
  }); 
  $scope.person = {};
  $scope.person.room = 1;
  $scope.person.adult = {number:1, min:1, max:15,};
  $scope.person.child = {number:0, min:0, max:5};  

   if(sideBarSrvc.getPerson() == 0){
     $scope.person.room = 1;
     $scope.person.adult = {number:1, min:1, max:15};
     $scope.person.child = {number:0, min:0, max:5}; 
  }else{       
    $scope.person.room = sideBarSrvc.getPerson().room;
    $scope.person.adult.number = sideBarSrvc.getPerson().adult.number;
    $scope.person.child.number = sideBarSrvc.getPerson().child.number;

  }
 
  $scope.next = function(){    
    $scope.pageClass = "forward";
    sideBarSrvc.setPerson($scope.person);
    if(!$scope.txtcolor){
      var hotels = {};  
      $rootScope.$emit("sideBarCtrlPersonMethod", {});    
      $state.go('booking.rooms');
    }
  }

  
  $scope.back = function(){
    $scope.pageClass = "backward";
    localStorage.removeItem('puraperson');
    localStorage.removeItem('purarooms');
    localStorage.removeItem('puraprg');
    $rootScope.$emit("sideBarCtrlPersonMethod", {});
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

app.controller('RoomsCtrl', function($rootScope, $q, $http, $scope, $state, $uibModal, $log, roomDataSrvc, roomUpdateSrvc, sideBarSrvc, stateCheckSrvc){
  $scope.selected = false;
  $scope.activebtn = false;
  $scope.diableBtn = false;
  
  $scope.$on('$stateChangeSuccess', function() {
    stateCheckSrvc.checkAndStart();
    $scope.rooms = sideBarSrvc.getRooms();     
  })

  $scope.$on('$viewContentLoaded', function() {
    stateCheckSrvc.checkAndStart();
    //$scope.hotellist = roomDataSrvc.getHotels();
    $scope.reqData = {
        "sign": localStorage.getItem('sign'),
        "resortid": sideBarSrvc.getWhere().resort.id,
        "checkindate": sideBarSrvc.getWhen().start,
        "checkoutdate": sideBarSrvc.getWhen().end, 
        "adult":sideBarSrvc.getPerson().adult.number, 
        "child":sideBarSrvc.getPerson().child.number, 
        "infant":"0", 
        "roomrequire":sideBarSrvc.getPerson().room
    };

    $rootScope.overlay = true; 
    gettingData();    
  });

  var gettingData = function(){
    var defer = $q.defer();
    //var url = "http://api.purastays.com/hotelogix/rooms";   
    var url = 'http://api.purastays.com/hotelogix/resorts-rooms';              
    $http.post(url, $scope.reqData)      
     .success(function(data) {
       defer.resolve(data);  
       roomDataSrvc.setHotels(data); 
       if(roomDataSrvc.getHotels()==null){
       	  $scope.diableBtn = true;
       	  $rootScope.overlay = false; 
       }else{
       	  $scope.diableBtn = false;
       	  $scope.hotel = roomDataSrvc.getHotels().hotelogix.response.hotels.hotel;         
       	  $rootScope.overlay = false;  	
       }              
       
    })
    return defer.promise;
  } 

  $scope.rooms = [];

  $rootScope.$on("updateSelectedRoomList", function(){    
    $scope.rooms = sideBarSrvc.getRooms();         
  });



  $scope.remove = function(indx){    
    if(indx>=0){
      $scope.rooms = sideBarSrvc.getRooms();      
      $scope.rooms.splice(indx, 1);
      sideBarSrvc.setRooms($scope.rooms);
      $rootScope.$emit("updateSelectedRoomList", {});      
    }  
  }

  $scope.next = function(){
    var totalRoomCount = 0;
    angular.forEach($scope.rooms, function(item){
      totalRoomCount = totalRoomCount + item.room_count;  
    })
    if(totalRoomCount>0){
      $scope.activebtn = true;
      sideBarSrvc.setRooms($scope.rooms);
      $rootScope.$emit("sideBarCtrlRoomsMethod", {});
      $scope.pageClass = "forward";
    	$state.go('booking.programs');
    }else{
      $scope.activebtn = false;
    }
  }
  $scope.back = function(){
    $scope.pageClass = "backward";
  	$state.go('booking.person');
    localStorage.removeItem('purarooms');
    localStorage.removeItem('puraprg');
    sideBarSrvc.setProgram([]);
    sideBarSrvc.setRooms([]);
    $rootScope.$emit("sideBarCtrlRoomsMethod", {});
  }
  $scope.open = function (size) {
  	if($scope.diableBtn == false){
      var modalInstance = $uibModal.open({
      backdrop  : 'static',
  	  keyboard  : false,
      animation: true,
      templateUrl: 'partials/modal/room-selection.html',
      controller: 'RoomSelectionModalCtrl',
      size: size,
      resolve: {
          hotel: function () {
            return $scope.hotel;
          }
        }
      });

      modalInstance.result.then(function (selectedItem) {
        $scope.selected = selectedItem;
      }, function () {
        $log.info('Modal dismissed at: ' + new Date());
      });
    }  
  }

	  
})

app.controller('ProgramsCtrl', function($scope, $rootScope, $http, $state, $uibModal, $log, roomDataSrvc, sideBarSrvc, stateCheckSrvc){
  
  $scope.$on('$viewContentLoaded', function() {      
    stateCheckSrvc.checkAndStart();
    $rootScope.overlay = true; 
    var id = (JSON.parse(JSON.parse(localStorage.getItem('purawhere')))).resort.id;
    var link = 'http://api.purastays.com/booking-packages/id/'+id;    
    $http.get(link).then(function(res){      
      $scope.packages = res.data;      
      $rootScope.overlay = false; 
    })    
  });

  $scope.$on('$stateChangeSuccess', function() {
    $scope.programs = sideBarSrvc.getProgram(); 
  })

  $rootScope.$on("updateSelectedProgram", function(){            
    $scope.programs = sideBarSrvc.getProgram();       
  });

  $scope.next = function(){
    $scope.pageClass = "forward";
    $rootScope.$emit("sidebarCtrlProgramMethod", {});
  	$state.go('booking.summary');
  }
  $scope.back = function(){
    $scope.pageClass = "backward";
    localStorage.removeItem('puraprg');
    sideBarSrvc.setProgram([]);
    $rootScope.$emit("sidebarCtrlProgramMethod", {});
    $state.go('booking.rooms');
  }

  $scope.remove = function(indx){
    if(indx>=0){
      $scope.programs.splice(indx, 1);
      sideBarSrvc.setProgram($scope.programs);
      $rootScope.$emit("updateSelectedProgram", {});
    }  
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
          packages: function () {
            return $scope.packages;
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

app.controller('SummaryCtrl', function($scope,$rootScope, $log, $state, $http, sideBarSrvc, $uibModal, bookingDataSrvc, stateCheckSrvc){
  $scope.rooms = [];
  
  $scope.summaryPrice = function(){
    $scope.roomPrice = 0;
    $scope.roomBookingPrice = 0;
    $scope.actPrice = 0;

    angular.forEach($scope.rooms,function(ob, index){    	
    	$scope.roomBookingPrice += parseInt(ob.rates.rate[0].bookingpolicy._depositamount) * parseInt(ob.room_count);
    	//$scope.roomBookingPrice += parseInt($scope.rooms[index].rates.rate[0].bookingpolicy._depositamount) * ;       
        $scope.roomPrice += parseInt(ob.totalPrice); 
    });

    angular.forEach($scope.programs,function(ob, index){
      $scope.actPrice += parseInt(ob.totalPrice); 
    });
  }

  $scope.$on('$viewContentLoaded', function() {
    stateCheckSrvc.checkAndStart();
    //list on summary page user selected item
    $scope.rooms = sideBarSrvc.getRooms();     
    $scope.programs = sideBarSrvc.getProgram();
    $scope.summaryPrice();
    $scope.finalPrice = ($scope.roomPrice + $scope.actPrice); 
    $scope.finalPriceBooking = ($scope.roomBookingPrice + $scope.actPrice);
    localStorage.setItem('price', $scope.finalPrice);  
		if($scope.finalPrice==null)
		{
			window.location = ('http://www.purastays.com/booking/#/booking/where');
		}
    localStorage.setItem('price2', $scope.finalPriceBooking);   
    
    //bookingDataSrvc.setTotalPrice($scope.finalPrice);
  });

  

  $scope.back = function(){
    $scope.pageClass = "backward";
  	$state.go('booking.programs');
  }
    
  

  $scope.sendData = function(){
    if(localStorage.getItem('loginStatus')==1){
      startBooking();
    }else{
      $scope.checkLogin();
    }
  }

  
  var startBooking = function(){
  	$rootScope.overlay = true;
    $scope.allData = bookingDataSrvc.getAllData();
    var link = "http://api.purastays.com/booking";
    $scope.allData = {};
    $scope.allData = bookingDataSrvc.getAllData();
    $scope.allData.user = {"email": localStorage.getItem('email'), "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": localStorage.getItem('mobile')};                  
    $http.post(link, $scope.allData).then(function(res1){           	
      if(res1.data.status==1){ // success 1; failed 0 
        //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
        //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

        var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;        
        localStorage.removeItem('purawhere');
        localStorage.removeItem('purawhen');
        localStorage.removeItem('puraperson');
        localStorage.removeItem('purarooms');
        localStorage.removeItem('puraprg');
        window.location.href = url;
        $rootScope.overlay = false;
      }else{
        $scope.loginerror = res1.data.message;
        $rootScope.overlay = false;
      }    

    })
  }

  $scope.checkLogin = function(){
    var modalInstance = $uibModal.open({
    backdrop  : 'static',
    keyboard  : false,
    animation: true,
    templateUrl: 'partials/modal/login-modal.html',
    controller: 'LoginModalCtrl',
    size: 'md',
    resolve: {
        packages: function () {
          return $scope.packages;
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



app.controller('RoomSelectionModalCtrl', function ($rootScope,$state, $scope, $uibModalInstance, hotel, roomUpdateSrvc, sideBarSrvc, programUpdateSrvc) {

  $scope.hotelName = sideBarSrvc.getWhere().resort.name;  

  $scope.hotel = hotel; 
  $scope.showErrorRoom = false;
    if($scope.hotel.status._code==1408){ 
	    $scope.showErrorRoom = true;
	    $scope.showErrorMsg = $scope.hotel.status._message;
	  }else if($scope.hotel.status._code==1409){ 
	    $scope.showErrorRoom = true;
	    $scope.showErrorMsg = $scope.hotel.status._message;
	  }else{
	    $scope.roomsListData = hotel.roomtypes.roomtype;
	    $scope.rooms = [];
	    if( Array.isArray($scope.roomsListData) ){
	      $scope.rooms = $scope.roomsListData;
	    }else{
	      $scope.rooms = [$scope.roomsListData];
	    }
	} 
   

  
  //for combining gallery
  $scope.finalGall = [];
  angular.forEach($scope.rooms, function(ob, index){    
    if( Array.isArray(ob.imgs.img) ){
      angular.forEach(ob.imgs.img, function(ob1, index){
        $scope.finalGall.push(ob1);
      })             
    }else{
      angular.forEach([ob.imgs.img], function(ob1, index){
        $scope.finalGall.push(ob1);
      })       
    } 
  })  

  $scope.bookedrooms = [];
  $scope.resortDetails = {};
  $scope.resortDetails = sideBarSrvc.getWhere().resort;

  $scope.changeDate = function(){
    $state.go('booking.when');
    $uibModalInstance.close();
  }

  $scope.addingRooms = function(curr){
    $scope.bookedrooms.push(curr);
    sideBarSrvc.setRooms($scope.bookedrooms);
  }

  $scope.removingRooms = function(ind){ 
    $scope.bookedrooms.splice(ind);
    sideBarSrvc.setRooms($scope.bookedrooms);
  }

  $scope.personErrorCount = false;
  $scope.ok = function () {   	
  	currVar = 0;
    var totMaxPax = 0;
    angular.forEach($scope.bookedrooms, function(ob, index){
      totMaxPax += (parseInt(ob._maxpax)) * ob.room_count;       
    })
    var personCount = sideBarSrvc.getPerson().adult.number + sideBarSrvc.getPerson().child.number;    
    
    if(totMaxPax >= personCount){
      $scope.personErrorCount = false;
      $rootScope.$emit("updateSelectedRoomList", {});
      $uibModalInstance.close();
    }else{
      $scope.personErrorCount = true;
    }
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  
});


app.controller('ProgramSelectionModalCtrl', function ($rootScope, $scope, $uibModalInstance, packages, sideBarSrvc) {

  $scope.packagesData = packages;
  $scope.totalPerson = sideBarSrvc.getPerson().adult.number + sideBarSrvc.getPerson().child.number;

  $scope.choosenProgram = [];

  $scope.programAdded = function(prSelected) {      
    $scope.choosenProgram.push(prSelected);              
  }

  $scope.programRemoved = function(prSelected) {
    $scope.choosenProgram = []; 
    sideBarSrvc.removeProgram();   
  }

  $scope.ok = function () {      	
    sideBarSrvc.setProgram($scope.choosenProgram);
    $rootScope.$emit("updateSelectedProgram", {});
    $uibModalInstance.close();
  };  

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});

app.controller('LoginModalCtrl', function($scope, $http, $rootScope, $uibModalInstance, sideBarSrvc, $q, bookingDataSrvc, $facebook){
   $scope.showLogin = true;
   $scope.showSignup = false;
   $scope.showGuest = false;
   $scope.showOther = false;
   $scope.showEmail = false;
   $scope.showMobile = false;
   $scope.other = {};
   $scope.reg = {};
   $scope.guest = {};
   $scope.user = {};


   $scope.goToSignup = function(){
     $scope.showLogin = false;
     $scope.showSignup = true;
     $scope.showGuest = false;    
   }
   $scope.goToLogin = function(){
     $scope.showLogin = true;
     $scope.showSignup = false;
     $scope.showGuest = false;    
   }
   $scope.goToGuest = function(){
     $scope.showLogin = false;
     $scope.showSignup = false;
     $scope.showGuest = true;    
   }

   $scope.signupNormal = function(){
      $rootScope.overlay = true; 
      var link = 'http://api.purastays.com/signup/normal';    
      $http.post(link, $scope.reg).then(function(res){        
        if(res.data.status==1){
          localStorage.setItem('email', res.data.email);        
          localStorage.setItem('mobile', res.data.mobile);
          localStorage.setItem('name', res.data.name);
          localStorage.setItem('userid', res.data.userid);
          localStorage.setItem('loginStatus', 1); //update login status

          $scope.allData = {};
          $scope.allData = bookingDataSrvc.getAllData();
          $scope.allData.user = {"email": localStorage.getItem('email'), "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": localStorage.getItem('mobile')};                    
          var link1 = "http://api.purastays.com/booking";                    
          $http.post(link1, $scope.allData).then(function(res1){             
            if(res1.data.status==1){ // success 1; failed 0 
              //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
              //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

              var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;
              localStorage.removeItem('purawhere');
              localStorage.removeItem('purawhen');
              localStorage.removeItem('puraperson');
              localStorage.removeItem('purarooms');
              localStorage.removeItem('puraprg');
              window.location.href = url;
              $rootScope.overlay = false;

              $uibModalInstance.close();
            }else{
              $scope.loginerror = res1.data.message;
              $rootScope.overlay = false;
            }
          })

        }else{
            localStorage.setItem('loginStatus', 0);
            $scope.loginerror = res.data.message;
            $rootScope.overlay = false;
        }
      })
   }

   $scope.signupGuest = function(){
      $rootScope.overlay = true; 
      var link = 'http://api.purastays.com/signup/guest';
      
      $http.post(link, $scope.guest).then(function(res){
        if(res.data.status==1){
          localStorage.setItem('email', res.data.email);        
          localStorage.setItem('mobile', res.data.mobile);
          localStorage.setItem('name', res.data.name);
          localStorage.setItem('userid', res.data.userid);
          localStorage.setItem('loginStatus', 1); //update login status

          $scope.allData = {};
          $scope.allData = bookingDataSrvc.getAllData();
          $scope.allData.user = {"email": localStorage.getItem('email'), "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": localStorage.getItem('mobile')};                    
          var link1 = "http://api.purastays.com/booking";                              
          $http.post(link1, $scope.allData).then(function(res1){             
            if(res1.data.status==1){ // success 1; failed 0 
              //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
              //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

              var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;
              localStorage.removeItem('purawhere');
              localStorage.removeItem('purawhen');
              localStorage.removeItem('puraperson');
              localStorage.removeItem('purarooms');
              localStorage.removeItem('puraprg');
              window.location.href = url;
              $rootScope.overlay = false;
              $uibModalInstance.close();
            }else{
              $scope.loginerror = res1.data.message;
              $rootScope.overlay = false;
            }
          })

        }else{
            localStorage.setItem('loginStatus', 0);
            $scope.loginerror = res.data.message;
            $rootScope.overlay = false;
        }
      })
   }
   
   $scope.login = function(){
      $rootScope.overlay = true; 
      var link = 'http://api.purastays.com/login';      
      $http.post(link, $scope.user).then(function(res){ //login attempt    
        if(res.data.status==1){
          localStorage.setItem('email', res.data.email);        
          localStorage.setItem('mobile', res.data.mobile);
          localStorage.setItem('name', res.data.name);
          localStorage.setItem('userid', res.data.userid);
          localStorage.setItem('loginStatus', 1); //update login status

          $scope.allData = {};
          $scope.allData = bookingDataSrvc.getAllData();
          $scope.allData.user = {"email": localStorage.getItem('email'), "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": localStorage.getItem('mobile')};                    
          var link1 = "http://api.purastays.com/booking";                              
          $http.post(link1, $scope.allData).then(function(res1){ 
            if(res1.data.status==1){ // success 1; failed 0               
              //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
              //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

              var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;
              localStorage.removeItem('purawhere');
              localStorage.removeItem('purawhen');
              localStorage.removeItem('puraperson');
              localStorage.removeItem('purarooms');
              localStorage.removeItem('puraprg');
              window.location.href = url;
              $rootScope.overlay = false;

              $uibModalInstance.close();
            }else{
              $scope.loginerror = res1.data.message;
              $rootScope.overlay = false;
            }
          })

        }else{
            localStorage.setItem('loginStatus', 0);
            $scope.loginerror = res.data.message;
            $rootScope.overlay = false;
        }
      })
   }

   $scope.fblogin = function(){
    $rootScope.overlay = true; 
    $facebook.login().then(function() {
        refresh();
    });

    var refresh = function(){
      $facebook.api("/me?fields=id,gender,email, name").then(
        function(response) {
            $scope.welcomeMsg = "Welcome " + response.name + " " + response.id + " "+ response.email;                      
            $scope.isLoggedIn = true;
            var link = 'http://api.purastays.com/login/social';
            var reqData = {
              "fid": response.id,
              "gid": "",
              "name": response.name,
              "mobile": "",
              "email": response.email
            }
            $http.post(link, reqData).then(function(res){              
              if(res.data.status == 1){      
                $scope.other = {"userid": res.data.userid, "name": res.data.name, "mobile": res.data.mobile, "email": res.data.email, }          
                localStorage.setItem('name', res.data.name);
                localStorage.setItem('userid', res.data.userid);
                localStorage.setItem('mobile', res.data.mobile);
                localStorage.setItem('email', res.data.email);
                if(res.data.mobile != "" && res.data.email != ""){
                  localStorage.setItem('mobile', res.data.mobile);
                  localStorage.setItem('email', res.data.email);
                  //continue booking
                  localStorage.setItem('loginStatus', 1);
                  $scope.allData = {};
                  $scope.allData = bookingDataSrvc.getAllData();
                  localStorage.setItem('email', $scope.other.email);
                  localStorage.setItem('mobile', $scope.other.mobile);
                  $scope.allData.user = {"email": $scope.other.email, "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": $scope.other.mobile};                    
                  var link1 = "http://api.purastays.com/booking";                                             
                  $http.post(link1, $scope.allData).then(function(res1){                     
                    if(res1.data.status==1){ // success 1; failed 0 
                      //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
                      //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

                      var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;
                      localStorage.removeItem('purawhere');
                      localStorage.removeItem('purawhen');
                      localStorage.removeItem('puraperson');
                      localStorage.removeItem('purarooms');
                      localStorage.removeItem('puraprg');
                      window.location.href = url;
                      $rootScope.overlay = false;

                      $uibModalInstance.close();
                    }else{
                      $scope.loginerror = res1.data.message;
                      $rootScope.overlay = false;
                    }
                  })

                }else{
                  $rootScope.overlay = false; 
                  $scope.showLogin = false;
                  $scope.showSignup = false;
                  $scope.showGuest = false;
                  $scope.showOther = true;
                  if(res.data.mobile == ""){
                    $scope.showMobile = true;
                    $scope.showEmail = false;                    
                  }else if(res.data.email == ""){
                    $scope.showEmail = true;
                    $scope.showMobile = false;
                  }else{
                    $scope.showEmail = true;
                    $scope.showMobile = true;
                  }
                }                
              }else{

              }
            })

        },
        function(err) {
            $scope.welcomeMsg = "Please log in";
        });
    }
   }

   $scope.glogin = function(){   
	   var myParams = {
        'clientid' : '914569477210-pe29flgfb97a3lv6gelreopsmr2kmvc0.apps.googleusercontent.com',
        'cookiepolicy' : 'single_host_origin',
        'callback' : loginCallback,
        'approvalprompt':'force',
        'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
      };
      gapi.auth.signIn(myParams);
   	}

   	function loginCallback(result){      	
	   	if(result['status']['signed_in']){
	   		gapi.client.load('plus', 'v1',function() {
	            var request = gapi.client.plus.people.get({'userId': 'me'});            
	            request.execute(function (resp){	            	
	            	var link = 'http://api.purastays.com/login/social';
		            var reqData = {
		              "fid": "",
		              "gid": resp.id,
		              "name": resp.name.givenName +" "+resp.name.familyName,
		              "mobile": "",
		              "email": resp.emails[0].value
		            }            
		            $http.post(link, reqData).then(function(res){
						if(res.data.status==1){
							$scope.other = {"userid": res.data.userid, "name": res.data.name, "mobile": res.data.mobile, "email": res.data.email, }          
			                localStorage.setItem('name', res.data.name);
			                localStorage.setItem('userid', res.data.userid);
			                localStorage.setItem('mobile', res.data.mobile);
			                localStorage.setItem('email', res.data.email);
			                 if(res.data.mobile != "" && res.data.email != ""){
				                  localStorage.setItem('mobile', res.data.mobile);
				                  localStorage.setItem('email', res.data.email);
				                  //continue booking
				                  localStorage.setItem('loginStatus', 1);
				                  $scope.allData = {};
				                  $scope.allData = bookingDataSrvc.getAllData();
				                  localStorage.setItem('email', $scope.other.email);
				                  localStorage.setItem('mobile', $scope.other.mobile);
				                  $scope.allData.user = {"email": $scope.other.email, "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": $scope.other.mobile};                    
				                  var link1 = "http://api.purastays.com/booking";                                             
				                  $http.post(link1, $scope.allData).then(function(res1){ 				                    
				                    if(res1.data.status==1){ // success 1; failed 0 
				                      //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
				                      //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

				                      var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;
				                      localStorage.removeItem('purawhere');
				                      localStorage.removeItem('purawhen');
				                      localStorage.removeItem('puraperson');
				                      localStorage.removeItem('purarooms');
				                      localStorage.removeItem('puraprg');
				                      window.location.href = url;
				                      $rootScope.overlay = false;

				                      $uibModalInstance.close();
				                    }else{
				                      $scope.loginerror = res1.data.message;
				                      $rootScope.overlay = false;
				                    }
				                  })

				                }else{
				                  $rootScope.overlay = false; 
				                  $scope.showLogin = false;
				                  $scope.showSignup = false;
				                  $scope.showGuest = false;
				                  $scope.showOther = true;
				                  if(res.data.mobile == ""){
				                    $scope.showMobile = true;
				                    $scope.showEmail = false;                    
				                  }else if(res.data.email == ""){
				                    $scope.showEmail = true;
				                    $scope.showMobile = false;
				                  }else{
				                    $scope.showEmail = true;
				                    $scope.showMobile = true;
				                  }
				                }  
						}
		            	
		            })
	            }) 
	        })    
	    }
	}  






   $scope.updateDetails = function(){   
      $rootScope.overlay = true;        
      var link = "http://api.purastays.com/login/update-profile";
      $http.post(link, $scope.other).then(function(res){
         if(res.data.status == 1){
            localStorage.setItem('loginStatus', 1);
            $scope.allData = {};
            $scope.allData = bookingDataSrvc.getAllData();
            localStorage.setItem('email', $scope.other.email);
            localStorage.setItem('mobile', $scope.other.mobile);
            $scope.allData.user = {"email": $scope.other.email, "sign": localStorage.getItem('sign'), "room_price": bookingDataSrvc.getTotalRoomprice(), "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": $scope.other.mobile};                    
            var link1 = "http://api.purastays.com/booking";                               
            $http.post(link1, $scope.allData).then(function(res1){               
              if(res1.data.status==1){ // success 1; failed 0 
                //window.location.href = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn ;
                //var url = 'http://purastays.com/booking/pay/pay.php?userid='+res.data.userid+'&t='+res1.data.txn+ '&oid=' + res1.data.order_id +'&rid=' +res1.data.resort_id;            

                var url = 'http://purastays.com/booking/pay/pay.php?id='+res1.data.id +'&uid=' + res1.data.uid ;
                localStorage.removeItem('purawhere');
                localStorage.removeItem('purawhen');
                localStorage.removeItem('puraperson');
                localStorage.removeItem('purarooms');
                localStorage.removeItem('puraprg');
                $rootScope.overlay = false; 
                window.location.href = url;
                $rootScope.overlay = false;

                $uibModalInstance.close();
              }else{
                $rootScope.overlay = false; 
                $scope.loginerror = res1.data.message;
                $rootScope.overlay = false;
              }
            })
         }      
      })
   }

  $scope.ok = function () {
    $uibModalInstance.close();
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
})