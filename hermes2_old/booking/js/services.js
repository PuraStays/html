var app = angular.module("pura");

app.service('sideBarSrvc', function($http){	
  var whereData = {};
  var whenData = {};
  var personData = {};

  //where data
  var getWhere = function(){    
    return whereData;
  }

  var setWhere = function(where){    
    whereData = where;
    console.log(where);
  }

  //when data
  var getWhen = function(){    
    return whenData;
  }

  var setWhen = function(when){    
    whenData = when;
  }

  //person data
  var getPerson = function(){       
    return personData;
  }

  var setPerson = function(person){    
    personData = person;    
  }

  return {
    getWhere: getWhere,
    setWhere: setWhere,
    getWhen: getWhen,
    setWhen: setWhen,
    getPerson: getPerson,
    setPerson: setPerson
  };    
})

app.service('roomDataSrvc', function($http){
  var hotels = {};
  var setHotels = function(){
    var x2js = new X2JS();
    $http.get('data/search.xml')
      .success(function(data) {
        hotels = x2js.xml_str2json(data).hotelogix.response;
      })
  }

  var getHotels = function(){
    return hotels;
  }

  return{
    setHotels: setHotels,
    getHotels: getHotels
  }
})