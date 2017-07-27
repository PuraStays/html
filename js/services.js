var app = angular.module("pura");

app.service('sideBarSrvc', function($http, $localStorage){	
  var whereData = {};
  var whenData = {};
  var personData = {};
  var roomsData = [];
  var programData = {};

  //where data
  var getWhere = function(){
    if($localStorage.where != undefined){
      return JSON.parse($localStorage.where);
    }else{
      return 0;
    }
  }

  var setWhere = function(where){    
    whereData = where;
    $localStorage.where = JSON.stringify(where);
  }

  //when data
  var getWhen = function(){  
    if($localStorage.when != undefined){
      return JSON.parse($localStorage.when);
    }else{
      return 0;
    }        
  }

  var setWhen = function(when){    
    whenData = when;
    $localStorage.when = JSON.stringify(when);
  }

  //person data
  var getPerson = function(){       
    //return personData;
    if($localStorage.person != undefined){
      return JSON.parse($localStorage.person);
    }else{
      return 0;
    } 
  }

  var setPerson = function(person){    
    personData = person;    
    $localStorage.person = JSON.stringify(person);
  }

  //room data
  var getRooms = function(){       
    //return personData;
    if($localStorage.rooms != undefined){
      return JSON.parse($localStorage.rooms);
    }else{
      return 0;
    } 
  }

  var setRooms = function(rooms){    
    roomsData = rooms;    
    $localStorage.rooms = JSON.stringify(rooms);
  }

  //program data
  var getProgram = function(){       
    //return personData;
    if($localStorage.prg != undefined){
      return JSON.parse($localStorage.prg);
    }else{
      return 0;
    } 
  }

  var setProgram = function(prg){    
    programData = prg;    
    $localStorage.prg = JSON.stringify(prg);
  }

  var removeProgram = function(){
    programData = [];
  }


  return {
    getWhere: getWhere,
    setWhere: setWhere,
    getWhen: getWhen,
    setWhen: setWhen,
    getPerson: getPerson,
    setPerson: setPerson,
    getRooms: getRooms,
    setRooms: setRooms,
    setProgram: setProgram,
    getProgram: getProgram,
    removeProgram: removeProgram
  };    
})

app.service('roomDataSrvc', function($q, $http){
  var hotels = {};
  var setHotels = function(htls){  
    var x2js = new X2JS();
    hotels = x2js.xml_str2json(htls);    
  }

  var getHotels = function(){
    return hotels;
  }

  return{
    setHotels: setHotels,
    getHotels: getHotels
  }
})

app.service('roomUpdateSrvc', function(){
  var room = [];
  var setRooms = function(rm){      
    room = rm;  
 }

  var getRooms = function(){        
    return room;
  }

  return{
    setRooms: setRooms,
    getRooms: getRooms
  }
})

app.service('programUpdateSrvc', function(){
  var programs = {};
  var setProgram = function(prg){  
    programs = prg;
  }

  var getPrograms = function(){
    return programs;
  }

  return{
    setProgram: setProgram,
    getPrograms: getPrograms
  }
})

app.service('bookingDataSrvc', function(sideBarSrvc){
  var finalPrice = '';
  var roomdata = [];
  var roomdataelem = {};
  var totalroomprice = 0;

  var actdata = [];
  var actdataelem = {};
  var activityData = [];

      
  angular.forEach(sideBarSrvc.getRooms(), function(ob, index){    
    totalroomprice = totalroomprice + parseInt(ob.rates.rate[0]._price) + parseInt(ob.rates.rate[0]._tax);    
    roomdataelem.id = ob._id;
    roomdataelem.room_name = ob._title;
    roomdataelem.rate = {
      "id": ob.rates.rate[0]._id,
      "key": ob.rates.rate[0]._key,
      "price": ob.rates.rate[0]._price,
      "tax": ob.rates.rate[0]._tax 
    };
    roomdataelem.room_count =  ob.room_count;    
    roomdata.push(roomdataelem);      
  })


  angular.forEach(sideBarSrvc.getProgram(), function(ob, index){
    actdataelem.id = ob.id;
    actdataelem.package_title = ob.title,
    actdataelem.unit_sold = ob.forPerson,
    actdataelem.total_price = ob.totalPrice
    actdata.push(actdataelem);      
  })  

  var allData = {
    "where": {"resort_id": sideBarSrvc.getWhere().resort.id, "resort_name": sideBarSrvc.getWhere().resort.name},
    "when": {"start_date":sideBarSrvc.getWhen().start, "end_date":sideBarSrvc.getWhen().end, "duration":sideBarSrvc.getWhen().diff},
    "person": {"adult": sideBarSrvc.getPerson().adult.number, "child": sideBarSrvc.getPerson().adult.number},
    "rooms": roomdata,
    "package": sideBarSrvc.getProgram(),
    "user": {"email": localStorage.getItem('email'), "sign": localStorage.getItem('sign'), "room_price": totalroomprice, "name": localStorage.getItem('name'), "userid": localStorage.getItem('userid'), "mobile": localStorage.getItem('mobile')}
  };
  console.log(allData);

  var getAllData = function(){    
    return allData;
  }
  var setTotalPrice = function(prc){
    setTotalPrice = prc;
  }
  return{
    getAllData: getAllData,
    setTotalPrice: setTotalPrice
  }  
});

app.service('stateCheckSrvc', function(sideBarSrvc, $state){
  
  var checkAndStart = function(){  
    if(sideBarSrvc.getWhere() == 0){
      $state.go('booking.where');
    }  
  }
  return{
    checkAndStart: checkAndStart
  }
});