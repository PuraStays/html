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