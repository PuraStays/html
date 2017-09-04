'use strict;'

var pura_experience = (function() {
	var resort_id = localStorage.getItem('id') || 21;
	function getData() {
		var link = 'http://admin.purastays.com:3000/api/experience/' + resort_id;
		console.log(link)
        $.ajax({
	        url: link,
	        type: "GET",
	        dataType: "json",
	        success: function (data, status, jqXHR) {
	        	console.log(data);
	        },
	        error: function(err) {
	        	console.log(err);
	        }
	    })

	}

	function test() {
		alert("working");
	}	
	return {
		test: test,
		getData: getData
	}
})();

(function() {
	$(window).load(function() {
		pura_experience.getData();
	})	
})();