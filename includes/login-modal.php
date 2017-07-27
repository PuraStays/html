<?php
//include_once('includes/db.inc.php');
//require_once 'src/Facebook/autoload.php';


//require_once '../src/Facebook/autoload.php';

date_default_timezone_set('Asia/Kolkata');
$DOC = date('Y-m-d H:i:s');
$DOU = date('Y-m-d H:i:s');
session_start();

//var_dump($_SERVER);

if(isset($_REQUEST["logout"]))
  {
    $_SESSION["login_status"] = 'logout';
    printf("<script>localStorage.clear();</script>");  
    printf("<script>location.href='http://www.purastays.com'</script>");  
    exit();
  }

if(isset($_POST['submit']))
  {
  if($_POST['submit']=='Sign up')
  {
   $Name = $_POST['Name'];
   $Mobile = $_POST['Mobile'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   $db = new DB();

   if($db->email_validate($email))
   {
      $Id = $db->next_id('Id', 'customers');
      $qry = "insert into customers (Id, Name, Mobile, email, password, Status, DOC ) VALUES ('$Id', '$Name', '$Mobile', '$email', '$password', '1', '$DOC')";    
      if($db->_query($qry))
      {
         $_SESSION["userid"] = $Id;
         $_SESSION["login_status"] = 'login';
         $_SESSION["name"] = $Name;
         $_SESSION["mobile"] = $Mobile;
         $_SESSION["email"] = $email;

         $Name = "";
         $Mobile = "";
         $email = "";
         $password = "";

      }
      else
      {
        $message = '<div class="alert alert-danger">There is a problem</div>';   
        ?>
         <script type="text/javascript">
           $(document).ready(function(){
              $('#myModal').modal('show');
              $('.signin').hide();
              $('.signup').show();

           });
         </script>
       <?php
      }
   }
   else
   {
      $message = '<div class="alert alert-danger">Account is active. If you wish to set a new password, email us at <a href="mailto:info@purastays.com">info@purastays.com </a> or call us at <a href="tel:+919015511551">+91 90 1551 1551</a> and we shall mail you a password reset link.</div>';
     ?>
       <script type="text/javascript">
         $(document).ready(function(){
            $('#myModal').modal('show');
            $('.signin').hide();
            $('.signup').show();

         });
       </script>
     <?php
   }
  }
}

if(isset($_POST['submit']))
  {
    if($_POST['submit']=='Sign in')
    {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $db = new DB();
      if(!$db->login($email, $password))
      {
        $signin_msg = '<div class="alert alert-danger">Email Id or Password is incorrect. Please try again.</div>';
        ?>
         <script type="text/javascript">
           $(document).ready(function(){
              $('#myModal').modal('show');
              $('.signup').hide();
              $('.signin').show();
           });
         </script>
         <?php
      }
  }
  }

?>
<!--google login start-->
<script type="text/javascript">
  (function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();
</script>

<script type="text/javascript">
	function GLogin() {
	  $(".overlay").fadeIn(500);	
      var myParams = {
        'clientid' : '914569477210-pe29flgfb97a3lv6gelreopsmr2kmvc0.apps.googleusercontent.com',
        'cookiepolicy' : 'single_host_origin',
        'callback' : loginCallback,
        'approvalprompt':'force',
        'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
      };
      gapi.auth.signIn(myParams);
      localStorage.setItem("LOGGEDIN", 1);
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
		            
		            $.ajax({
				        contentType: "application/json; charset=utf-8",
				        type: "POST",
				        dataType: 'json',
				        data: JSON.stringify(reqData),
				        crossDomain: true,
				        url: link,
				        success: function(res){
				        	$(".overlay").fadeOut();
				        	if(res.status==1){
								otherData = {"userid": res.userid, "name": res.name, "mobile": res.mobile, "email": res.email, "fid": res.fid, "gid": res.gid}
				                // post this data on same page simple post
				                var lnk2 = "http://www.purastays.com/includes/social-login.php?fid=&gid="+res.gid;		                
				                $.ajax({
								  method: "GET",
								  url: lnk2,
								  error: function() {
								      
								  },
								  success: function(res) {									  						
									location.reload();
									$(".overlay").fadeOut();
								  },
								});
					        }
				        },
				        error: function(err){
				        }
				    });      
		        })
		    })
		}
	}	            

</script>
<!--google login end-->


<!--facebook login start-->
<script type="text/javascript">
//fb login
	window.fbAsyncInit = function() {
		FB.init({
		  appId      : '1536724946635450',
		  cookie     : true,  // enable cookies to allow the server to access // the session							 
		  xfbml      : true,  // parse social plugins on this page
		  version    : 'v2.3' // use version 2.3
		});

		FB.getLoginStatus(function(response) {
		  statusChangeCallback(response);
		});	
	};

	// Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function statusChangeCallback(response) {	
		if (response.status === 'connected') {

		} else if (response.status === 'not_authorized') {
			console.log("status changed called: not authorized");
		} else {
			console.log("status changed called: not logged in");
		}
	}


  function FBLogin(){
  	$(".overlay").fadeIn(500);
	FB.login(function(response) {
		 if (response.authResponse){            
			 getUserInfo(); //Get User Information.	         	        
		 } else{
			alert('Authorization failed.');
		 }
	},{scope: 'public_profile,email'});
 }

	function getUserInfo() {
		FB.api('/me', function(response) {
	        var profile_image = "http://graph.facebook.com/"+ response.id +"/picture?type=large";
	        var mail_id;
	        if ('email' in response) { mail_id = response.email; } else { mail_id = ""; }	

	        var link = 'http://api.purastays.com/login/social';	        
            var reqData = {
              "fid": response.id,
              "gid": "",
              "name": response.name,
              "mobile": "",
              "email": mail_id
            } 	
	    	$.ajax({
		        contentType: "application/json; charset=utf-8",
		        type: "POST",
		        dataType: 'json',
		        data: JSON.stringify(reqData),
		        crossDomain: true,
		        url: link,
		        success: function(res){
		        	if(res.status==1){
						otherData = {"userid": res.userid, "name": res.name, "mobile": res.mobile, "email": res.email, "fid": res.fid, "gid": res.gid}		               		                
		                var lnk2 = "http://www.purastays.com/includes/social-login.php?fid="+res.fid+"&gid=";		                
		                $.ajax({
						  method: "GET",
						  url: lnk2,
						  error: function() {
						      
						  },
						  success: function(res) {							
							location.reload();
							$(".overlay").fadeOut();
						  },
						});
			        }
		        },
		        error: function(err){
		        }
		    });    
		});
	}



</script>

<!--facebook login end-->

<div id="myModal" class="modal fade signing" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

       <div class="signin">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sign In</h4>
          </div>
          <div class="modal-body">
              <?= $signin_msg; ?>
             <form method="post" id="signinForm">   
                <div class="row">
                    <div class="col-sm-6">
             			<fieldset class="form-group">
                        	<label>Email Id</label>
                            <input type="email" name="email" placeholder="Email Id" class="form-control" required="required">
                        </fieldset>
                    </div>    
                    <div class="col-sm-6">    
                        <fieldset class="form-group">
                        	<label>Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control" required="required">
                        </fieldset>                              
                    </div>
                </div>    
               	<div class="row">   
                    <div class="col-sm-12">    
	                    <fieldset class="form-group">                        	
                            <input type="submit" name="submit" value="Sign in" class="btn btn-pura pull-right">
                        </fieldset>
                    </div>                      
                </div>
                <div class="or">
                    <div><span>or</span></div>
                </div>  


                <div class="social-login">
        			<ul>
                    	<li>
                        	<div><a class="btn btn-social btn-facebook" href="#" onclick="FBLogin();return false;">
                              <span class="fa fa-facebook"></span> Sign in with Facebook
                            </a></div>
                        </li>
                        <li>
                        	<div><a class="btn btn-social btn-google" href="#" onclick="GLogin();return false;">
                              <span class="fa fa-google"></span> Sign in with Google
                            </a></div>
                        </li>
                    </ul>
                    <div class="clearfix gap20"></div>
                </div>
             </form>  
          </div>
          <div class="modal-footer">
            <div>No account yet? <a href="#" onclick="return false;" id="signup">Sign up</a></div>
          </div>
       </div>

       <div class="signup">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New User</h4>
          </div>
          <div class="modal-body">
             <form method="post" id="signupForm">   
                <div class="row">
                    <div class="col-sm-6">
             			<fieldset class="form-group">
                        	<label>Name</label>
                            <input type="text" name="Name" placeholder="Name" class="form-control" value="<?= $Name; ?>" required="required">
                        </fieldset>
                    </div>    
                    <div class="col-sm-6">    
                        <fieldset class="form-group">
                        	<label>Phone</label>
                            <input type="number" name="Mobile" placeholder="Phone" class="form-control" value="<?= $Mobile; ?>" required="required">
                        </fieldset>                              
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
             			<fieldset class="form-group">
                        	<label>Email Id</label>
                            <input type="email" name="email" placeholder="Email Id" class="form-control" value="<?= $email; ?>" required="required">
                        </fieldset>
                    </div>    
                    <div class="col-sm-6">    
                        <fieldset class="form-group">
                        	<label>Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control"  value="<?= $password; ?>" required="required">
                        </fieldset>                              
                    </div>
                </div>
                <div class="row">    
                    <div class="col-sm-12">    
	                    <fieldset class="form-group">  
	                    	<div class="pull-left terms-txt">By signing up you agree to our <a href="http://www.purastays.com/terms-conditions">Terms & Conditions</a></div>                      	
                            <input type="submit" name="submit" value="Sign up" class="btn btn-pura pull-right">
                        </fieldset>
                    </div>                      
                </div>
                <div class="or">
                    <div><span>or</span></div>
                </div>  
                <div class="social-login">
					<ul>
                    	<li>
                        	<div><a class="btn btn-social btn-facebook">
                              <span class="fa fa-facebook"></span> Sign in with Facebook
                            </a></div>
                        </li>
                        <li>
                        	<div><a class="btn btn-social btn-google">
                              <span class="fa fa-google"></span> Sign in with Google
                            </a></div>
                        </li>
                    </ul>
                    <div class="clearfix gap20"></div>
                </div>
             </form>  
          </div>
          <div class="modal-footer">
            <div>Already registered?<a href="#" onclick="return false;" id="signin"> Sign in</a></div>
          </div>
       </div>
    </div>

  </div>
</div>