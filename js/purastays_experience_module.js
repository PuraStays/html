'use strict;'

var pura_experience = (function() {

	//experience section
	var resort_id = localStorage.getItem('id') || 21;
	function getData() {
		var apilink = 'http://admin.purastays.com:3000/api/experience/' + resort_id;
        $.ajax({
	        url: apilink,
	        type: "GET",
	        dataType: "json",
	        success: function (res, status, jqXHR) {
	        	render(res.data)
	        },
	        error: function(err) {
	        	console.log(err);
	        }
	    })
	}

	function render(res) {
		localStorage.setItem('activities', '');
		if(res) {
			$.each(res.programs, function(index, obj) {
                var programHTML = '<a href="javascript:void(0);" class="gotoprogram" data-id="'+obj.program_id+'" data-index="'+index+'">'+obj.program_title+'</a>';
                $('.experience-sec').css({"display": "block"}).find('.step21 .lnq-container ul').append($('<li></li>').html(programHTML));
            });
            $('.experience-sec').find('.step21 .lnq-container ul li a').on('click', function() {
            	getActivitiesList(res.programs[$(this).data('index')].activities_id, res.programs[$(this).data('index')]);
            	if($(window).width() < 767) {
            		$('.experience-sec').find('.step21').css({"display": "none"});
		        	$('.experience-sec').find('.step22').css({"display": "table-cell"});
		        	$('.experience-sec').find('.step31').css({"display": "none"});
		        	$('.experience-sec').find('.step32').css({"display": "none"});
            	}
            })            
            getActivitiesList(res.programs[0].activities_id, res.programs[0])       
		}
	}

	function getActivitiesList(ids, program) {
		$('.experience-sec').find('.step2 #programDetails h3').text(program.program_title);
		$('.experience-sec').find('.step2 #programDetails p').text(program.description);	
		var activity_container = $('.experience-sec').find('.step22 .lnq-container2 ul');
		activity_container.empty();
		if(!Array.isArray(ids)) {
			ids = stringToNumArray(ids);
		}
		ids.forEach(function(id, index, arr) {
			var apilink = 'http://admin.purastays.com:3000/api/activity/' + id;			
			$.ajax({
		        url: apilink,
		        type: "GET",
		        dataType: "json",
		        success: function (res, status, jqXHR) {
		        	var activityHTML = '<a href="javascript:void(0);" class="gotoprogram" data-id="'+res.data.id+'" >'+res.data.Activity_Name+'</a>';
		        	activity_container.append($('<li></li>').html(activityHTML));		        	
		        	if(!localStorage.getItem('activities')) {
			        	var tempActivityObj = {
			        		"data": []
			        	};
			        	tempActivityObj.data.push(res.data);
			        	localStorage.setItem('activities', JSON.stringify(tempActivityObj));     	
		        	} else {
		        		var tempActivityObj = JSON.parse(localStorage.getItem('activities'));
		        		tempActivityObj.data.push(res.data);
		        		localStorage.setItem('activities', JSON.stringify(tempActivityObj));
		        	}

		        	if((arr.length -1) == index) {
			        	$('.experience-sec').find('.step22 .lnq-container2 ul li a').bind('click', function() {
			        		if($(window).width() < 767) {
			            		$('.experience-sec').find('.step21').css({"display": "none"});
					        	$('.experience-sec').find('.step22').css({"display": "none"});
					        	$('.experience-sec').find('.step31').css({"display": "table-cell"});
					        	$('.experience-sec').find('.step32').css({"display": "none"});
			            	} else {
					        	$('.experience-sec').find('.step21').css({"display": "none"});
					        	$('.experience-sec').find('.step22').css({"display": "none"});
					        	$('.experience-sec').find('.step31').css({"display": "table-cell"});
					        	$('.experience-sec').find('.step32').css({"display": "table-cell"});
					        }
				        	renderActivityDetails($(this).data('id'), JSON.parse(localStorage.getItem('activities')).data)
				        })
			        }
		        },
		        error: function(err) {
		        	console.log(err);
		        },
		        complete: function() {
		        	
		        }
		    })
		})
	}

	function stringToArray(str) {
        var arr = (str.replace(/,\s*$/, '')).split(",").map(function(item) {
        	return item;
	    });
	    return arr;
	}

    function stringToNumArray(str) {
		var arr = (str.replace(/,\s*$/, '')).split(",").map(function(item) {
	        return parseInt(item, 10);
	    });
		return arr;
	}

	function renderActivityDetails(id, activity) {
		$('.experience-sec').find('.step3 #activityGallery .lnq-container3 ul').empty();
		activity.forEach(function(item, index, array) {
			if(item.id === id) {
				$('.experience-sec').find('.step3 #activityDetails h3').text(item.Activity_Name);
				$('.experience-sec').find('.step3 #activityDetails p.des').text(item.About_Activity_Description);
				$('.experience-sec').find('.step3 #activityGallery h3').text(item.Activity_Name);
				
				var gallArray = stringToArray(item.gallery_id);
				$.each(gallArray, function(index, obj) {
	                var galleryHTML = '<a href="'+obj+'" class="gotoprogram" data-lightbox="gall11"><img src="'+obj+'" /></a>';
	                $('.experience-sec').find('.step3 #activityGallery .lnq-container3 ul').append($('<li></li>').html(galleryHTML));
	            });
			}
		}) 
	}

	function init() {
		getData();
		manageBreakPoint();
		initMap();
	}

	$('.step31 .backlnk2.desktop').on('click', function() {
		$('.experience-sec').find('.step21').css({"display": "table-cell"});
    	$('.experience-sec').find('.step22').css({"display": "table-cell"});
    	$('.experience-sec').find('.step31').css({"display": "none"});
    	$('.experience-sec').find('.step32').css({"display": "none"});
	})

	function manageBreakPoint() {
		if($(window).width() >= 768) {
			$('.experience-sec').find('.step21').css({"display": "table-cell"});
        	$('.experience-sec').find('.step22').css({"display": "table-cell"});
        	$('.experience-sec').find('.step31').css({"display": "none"});
        	$('.experience-sec').find('.step32').css({"display": "none"});
		} else {
			$('.experience-sec').find('.step21').css({"display": "table-cell"});
        	$('.experience-sec').find('.step22').css({"display": "none"});
        	$('.experience-sec').find('.step31').css({"display": "none"});
        	$('.experience-sec').find('.step32').css({"display": "none"});
		}
	}

	$("#goToGallery").on('click', function() {
		$('.experience-sec').find('.step21').css({"display": "none"});
    	$('.experience-sec').find('.step22').css({"display": "none"});
    	$('.experience-sec').find('.step31').css({"display": "none"});
    	$('.experience-sec').find('.step32').css({"display": "table-cell"});
	})

	$("#goToActivityDetail").on('click', function() {
		$('.experience-sec').find('.step21').css({"display": "none"});
    	$('.experience-sec').find('.step22').css({"display": "none"});
    	$('.experience-sec').find('.step31').css({"display": "table-cell"});
    	$('.experience-sec').find('.step32').css({"display": "none"});
	})

	$("#goToActivity").on('click', function() {
		$('.experience-sec').find('.step21').css({"display": "none"});
    	$('.experience-sec').find('.step22').css({"display": "table-cell"});
    	$('.experience-sec').find('.step31').css({"display": "none"});
    	$('.experience-sec').find('.step32').css({"display": "none"});
	})

	$("#goToProgram").on('click', function() {
		$('.experience-sec').find('.step21').css({"display": "table-cell"});
    	$('.experience-sec').find('.step22').css({"display": "none"});
    	$('.experience-sec').find('.step31').css({"display": "none"});
    	$('.experience-sec').find('.step32').css({"display": "none"});
	})


	function initMap() {
        //map init
		var myLatLng = JSON.parse(localStorage.getItem('location'));

		var mapOptions = {
			zoom: 10,
			draggable: false,
			scrollwheel: false,
			disableDoubleClickZoom: false,
			panControl: false,
			streetViewControl: false,
			center: myLatLng
	    }

	    var markerOption = {
			position: myLatLng,
			map: map,
			title: 'Pura',
			icon: '../images/map-marker.png'
	    }

		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

	    var map2 = new google.maps.Map(document.getElementById('map2'), mapOptions);

	    var marker = new google.maps.Marker(markerOption);

	    var marker2 = new google.maps.Marker(markerOption
    }  

	return {
		init: init,
		manageBreakPoint: manageBreakPoint,
		initMap: initMap
	}
})();

(function() {
	$(window).load(function() {
		pura_experience.init();
	})
	$(window).resize(function() {
		pura_experience.manageBreakPoint();
	})

	//draw map resort page
	$('.maplink').on('click', function(){    
        $('#mapModal').modal({
            show: 'true'
        });        
        var modalBodyHt = $(window).outerHeight() - 55;
        $('#mapModal .modal-body').height(modalBodyHt);
        
        var map2 = new google.maps.Map(document.getElementById('map2'), {
            zoom: 10,
            center: myLatLng
        });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map2,
                title: 'Pura',
                icon: '../images/map-marker.png'
	        });
        })
})();