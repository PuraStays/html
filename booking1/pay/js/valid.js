(function(){
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    $('#submit').on('click', function(event){
		var valid = true,
		errorMessage = "";
		var captTmp = $('#txtCaptcha').text();
		var captchaVal = captTmp.split(' ').join('');

		
		
		//is empty
		if ($('#name').val() == '') {
		   errorMessage  = "Name required, \n";
		   $('#name').addClass('error');
		   valid = false;
		}
		if ($('#email').val() == '') {
		  	errorMessage += " Email id required,\n";
		    $('#email').addClass('error');
		   valid = false;					   		
		}
		if ($('#mobile').val() == '') {
		   errorMessage += " Mobile Number required,\n";
		   $('#mobile').addClass('error');
		   valid = false;
		} 
		
		/*if ($('#txtInput').val() == '') {
		   errorMessage += " captcha required,\n";
		   $('#txtInput').addClass('error');
		   valid = false;
		} */else{
			//captcha
			if($('#txtInput').val()==captchaVal){
				$('#txtInput').removeClass('error');
				valid = true;	
			}else{
				errorMessage += " Invalid captcha\n";
				$('#txtInput').addClass('error');
				valid = false;	
			}	
		}

		
		
		if( !valid && errorMessage.length > 0){
		   $('#error-msg').text(errorMessage);
		   return false;
		}else{
			errorMessage = "";	
		}
		
		$.fn.serializeObject = function()
		{
			var o = {};
			var a = this.serializeArray();
			$.each(a, function() {
				if (o[this.name] !== undefined) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}
					o[this.name].push(this.value || '');
				} else {
					o[this.name] = this.value || '';
				}
			});
			return o;
		};
		
		var formData = JSON.stringify($('form').serializeObject());
		
		//var formData = JSON.stringify($("#contact").serializeObject());	
		console.log(formData);
		$.ajax({
			type: 'POST',
			url: 'http://api.flygrades.com/contactus',
			data: formData,
			dataType: "json",
			cache: false,
		    crossDomain: true,
	 	    processData: true,
			beforeSend: function(res) {
				res.addRequestHeader("Access-Control-Allow-Origin", "http://api.flygrades.com");
				//$('.overlay').fadeIn(20);
			},
			success: function (data) {
			  //$('#escapingBallG').hide();
			  //$('#submitted').fadeIn(20);
			  //$('.overlay').fadeOut(20);
			  alert(data.status);
			},error: function (XMLHttpRequest, textStatus, errorThrown){
				//$('#escapingBallG').hide();
				//$('.overlay').fadeOut(20);
				//$('#error-msg').html('something went wrong');			
				alert("error");
				
			}
		  });							
    });
	$("input[type='text']").on('focus', function(){
		$(this).removeClass('error');
		$('.error-msg').text("");		
	})
	$('.overlay .close').on('click', function(){
		$('#submitted, .overlay').fadeOut(100);	
	})
})();	

	var rotate_factor = 0;   //Created / Generates the captcha function    
    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';    
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d;
        document.getElementById("txtCaptcha").innerHTML = code
    }

    // Validate the Entered input aganist the generated security code function   
    function ValidCaptcha(){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').innerHTML);
        var str2 = removeSpaces(document.getElementById('txtInput').value);
        if (str1 == str2) return true;        
        return false
        
    }

    // Remove the spaces from the entered and generated code
    function removeSpaces(string)
    {
        return string.split(' ').join('');
    }
	DrawCaptcha();