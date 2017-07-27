<?php
include_once('includes/db.inc.php');
date_default_timezone_set('Asia/Kolkata');
$DOC = date('Y-m-d H:i:s');
$DOU = date('Y-m-d H:i:s');

session_start();
if(isset($_REQUEST["logout"]))
  {
    $_SESSION["login_status"] = 'logout';
  }

if(isset($_POST['submit']))
  {
  if($_POST['submit']=='Signup')
  {
   $Name = $_POST['Name'];
   $Mobile = $_POST['Mobile'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   $db = new DB();
   

   if($db->email_validate($email))
   {
      $Id = $db->next_id('Id', 'customers');
    echo  $qry = "insert into customers (Id, Name, Mobile, email, password, Status, DOC ) VALUES ('$Id', '$Name', '$Mobile', '$email', '$password', '1', '$DOC')";    
      if($db->_query($qry))
      {
         $_SESSION["userid"] = $Id;
         $_SESSION["login_status"] = 'login';
         $_SESSION["Name"] = $Name;


         $Name = "";
         $Mobile = "";
         $email = "";
         $password = "";

      }
      else
      {
        $message = '<div class="alert alert-danger">there is a problem</div>';   
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
      $message = '<div class="alert alert-danger">email already used</div>';
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
    if($_POST['submit']=='Login')
    {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $db = new DB();
      if(!$db->login($email, $password))
      {
        $signin_msg = '<div class="alert alert-danger">email id or password is incorrect. Please try again !</div>';
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



/*
require_once 'includes/facebook-php-sdk-v4-master/src/Facebook/autoload.php';
session_start();
$fb = new Facebook\Facebook([
  'app_id' => '897845286920788', // Replace {app-id} with your app id
  'app_secret' => '6e15682a76e861cfd7501c3679a757e6',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/purastays.com/site/profile.php', $permissions);

//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';


*/
?>

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
             <form action="" method="post" id="signinForm">   
                <div class="row">
                    <div class="col-sm-6">
             			<fieldset class="form-group">
                        	<label>Email Id</label>
                            <input type="email" name="email" placeholder="Your Email Id" class="form-control" required="required">
                        </fieldset>
                    </div>    
                    <div class="col-sm-6">    
                        <fieldset class="form-group">
                        	<label>Password</label>
                            <input type="password" name="password" placeholder="Your Password" class="form-control" required="required">
                        </fieldset>                              
                    </div>
                </div>    
               	<div class="row">   
                    <div class="col-sm-12">    
	                    <fieldset class="form-group">                        	
                            <input type="submit" name="submit" value="Login" class="btn btn-success pull-right">
                        </fieldset>
                    </div>                      
                </div>
                <div class="or">
                    <div><span>or</span></div>
                </div>  
                <div class="social-login">
					<ul>
                    	<li>
                        	<div><a class="btn btn-social btn-facebook" href="<?= htmlspecialchars($loginUrl); ?>">
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
            <div>You don&rsquo;t have any account yet? <a href="javascript:void(0);" id="signup">Signup Pura</a></div>
          </div>
       </div>
       <div class="signup">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New User? Sign Up</h4>
          </div>
          <div class="modal-body">

              <?= $message; ?>
             <form action="" method="post" id="signupForm">   
                <div class="row">
                    <div class="col-sm-6">
             			<fieldset class="form-group">
                        	<label>Name</label>
                            <input type="text" name="Name" placeholder="Your name" class="form-control" value="<?= $Name; ?>" required="required">
                        </fieldset>
                    </div>    
                    <div class="col-sm-6">    
                        <fieldset class="form-group">
                        	<label>Phone</label>
                            <input type="number" name="Mobile" placeholder="Your phone" class="form-control" value="<?= $Mobile; ?>" required="required">
                        </fieldset>                              
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
             			<fieldset class="form-group">
                        	<label>Email Id</label>
                            <input type="email" name="email" placeholder="Your Email Id" class="form-control" value="<?= $email; ?>" required="required">
                        </fieldset>
                    </div>    
                    <div class="col-sm-6">    
                        <fieldset class="form-group">
                        	<label>Password</label>
                            <input type="password" name="password" placeholder="Your Password" class="form-control"  value="<?= $password; ?>" required="required">
                        </fieldset>                              
                    </div>
                </div>
                <div class="row">    
                    <div class="col-sm-12">    
	                    <fieldset class="form-group">                        	
                            <input type="submit" name="submit" value="Signup" class="btn btn-success pull-right">
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
                              <span class="fa fa-facebook"></span> Sign up with Twitter
                            </a></div>
                        </li>
                        <li>
                        	<div><a class="btn btn-social btn-twitter">
                              <span class="fa fa-twitter"></span> Sign up with Twitter
                            </a></div>
                        </li>
                    </ul>
                    <div class="clearfix gap20"></div>
                </div>
             </form>  
          </div>
          <div class="modal-footer">
            <div>Already registered? <a href="javascript:void(0);" id="signin">Signin</a></div>
          </div>
       </div>
    </div>

  </div>
</div>