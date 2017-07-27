<?php
include_once("vendor/S3/S3.php");
include_once("includes/db.inc.php");
session_start();

//upload password
if(isset($_POST['pass_btn']))
  {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if($password1!="" && $password2 !="")
    {
        if ($password1 == $password2)
        {
          $userid = $_SESSION['userid'];
          $qry = "update customers set password = '$password1' where id = '$userid'";
          $db = new DB();
          if($db->_query($qry))
          {
            $message = "Password successfully updated.";
          }
        }
    }
  }

//upload pic
  if(isset($_POST['pic_btn']))
    {
          //use S3;
          //AWS access info
          if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJXWJX4EXE3ZZPGMQ');
          if (!defined('awsSecretKey')) define('awsSecretKey', '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');
        
          //instantiate the class
          $s3 = new S3(awsAccessKey, awsSecretKey);

          //retreive post variables
          $fileName = $_FILES["Image"]['name'];
          $fileTempName = $_FILES["Image"]['tmp_name'];

          //create a new bucket
          $s3->putBucket("mybuccketsfdfsdfs", S3::ACL_PUBLIC_READ);
                        
          $file = $_FILES['Image']; 
          $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
          
          $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
          $setNewFileName = time() . "_" . rand(000000, 999999);                
          
          $fileName = $setNewFileName.'.'.$ext;
          if (in_array($ext, $arr_ext)) {
              //move the file
              if ($s3->putObjectFile($fileTempName, "mybuccketsfdfsdfs", $fileName, S3::ACL_PUBLIC_READ)) {
                  
                    $userid = $_SESSION["userid"];
                    //echo "<strong>We successfully uploaded your file.</strong>";
                    $Customer_Image = "http://mybuccketsfdfsdfs.s3.amazonaws.com/".$fileName;

                    $qry = "update customers set Customer_Image = '$Customer_Image' where id = '$userid'";
                    $db = new DB();
                    if($db->_query($qry))
                    {
                      $message = "Image updated successfully.";
                    }
                  }
                  else
                  {
                      echo "<strong>Something went wrong while uploading your file...</strong>";
                  }
          }
          
    }

header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">

     <script src="bower_components/jquery/dist/jquery.min.js"></script>
  </head>
  <body>
    
  <div class="overlay"><img src="images/loading.gif" alt="pura" height="10"></div>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	<section class="pura-banner-inner profile-banner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("includes/nav2.php");?>
            <div class="pura-slider">
            	<img src="images/profile-banner.jpg" alt="pura profile">
            </div>
        </section>
    </header>    
    <?php
      if($_SESSION["login_status"] !="login")
        {
          $_SESSION["login_status"] = 'logout';
          printf("<script>location.href='index.php?logout'</script>");       
          exit();
        }
        $Id = $_SESSION["userid"];
        $db = new DB();
        $qry = "select * from customers where id  = $Id";
        $result = $db->_query($qry);
        $row =  $result->fetch_assoc();
    ?>    
    <section class="profile-details">
        <div class="strip">
            <div class="container">
                <div class="prof-pic">
                    <figure>
                        <img src="<?= $row['Customer_Image']?>" alt="<?= $row['Name']; ?>"/>
                    </figure>
                    <div class="edt-btn" data-toggle="modal" data-target="#updatePic"><i class="fa fa-pencil" aria-hidden="true"></i></div>                                        
                </div>
                <div class="name">Welcome <span><?= $row['Name']; ?></span></div>
            </div>
        </div>
        <div class="other-details">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="dtl-cntnr">
                            <div class="dtl">
                                <div class="lft"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                <div class="rht"><?= $row['email']; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="dtl-cntnr">
                            <div class="dtl">
                                <div class="lft"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                <div class="rht"><?= $row['Mobile']; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="dtl-cntnr">
                            <div class="dtl">
                                <div class="lft"><i class="fa fa-key" aria-hidden="true"></i></div>
                                <div class="rht">************ <div class="lnkIn" data-toggle="modal" data-target="#updatePass"><i class="fa fa-pencil" aria-hidden="true"></i></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

    <section class="sec history">
    	<div class="container">
        	<h2>Booking History</h2>
        </div>    

        <?php
        $requestStr = '{"userid":"'.$_SESSION['userid'].'"}';

        $actionUrl = "http://api.purastays.com/booking-history-user-profile";
        $request = curl_init($actionUrl);
        curl_setopt($request, CURLOPT_HEADER, 0);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
        $post_response = curl_exec($request);
        
        //print_r($post_response);
        
        $data = json_decode($post_response);
        if(!$data)
        {
          $data = json_decode($post_response.']}');
        }
        $db = new DB();
        $qry_clus = "select Title, Resorts from clusters where Status = 1";
        $result_clus = $db->_query($qry_clus);
        while ($row_c = mysqli_fetch_array($result_clus)) {
          $resorts =  explode(', ', $row_c['Resorts']);
            foreach ($resorts as $resort) {
              $resorts[$resort] = $row_c['Title'];
            }
        }
        

        curl_close ($request);
        ?>
        <div class="type clearfix">
        	<div class="container">
                <div class="panel-group booking-history" id="accordion">
                  <?php
                  $count = 0;
                  foreach ($data->bookings as $bookings) {
                    $count++;
                    $status=0;

                    foreach ($bookings as $booking) {
                      $status++;
                      if($status==1)
                      {
                    ?>
                      <div class="panel panel-success">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $count; ?>">
                            <?=  $resorts[$booking->where->resort_id].' - '.$booking->where->resort_name; ?>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse<?= $count; ?>" class="panel-collapse collapse<?php if($count== count($data->bookings)){ echo ' in';} ?>">
                        <div class="panel-body">
                          <?php // print_r($booking); ?>
                          <table class="table table-condensed custom">
                          <caption>Your Booking Details : <?= $booking->savebooking->response->order->id; ?></caption>						    
                          <caption>Booking Date & Time : <?= $db->utc_to_date($booking->savebooking->response->order->orderdate);?></caption>                
                          <caption>Booking Status : 
                          <?php 
                          if($db->clm_value('status' , 'orderid', 'hotelogix_details', $booking->savebooking->response->order->id)==1)
                           {
                              echo 'Confirmed';
                           }
                           else
                           {
                              if($db->clm_value('cancel' , 'orderid', 'hotelogix_details', $booking->savebooking->response->order->id)==1){

                                echo 'Cancelled';
                              }
                              else
                              {
                                echo 'Not Confirmed';  
                              }
                              
                           }
                           ?></caption>                
						    <tbody>
						      <tr>
						        <td colspan="2"><?= $booking->where->resort_name; ?></td>	
						        <td>
                    <?php
                     $Cancel_Status =  $db->clm_value('cancel', 'orderid', 'hotelogix_details', $booking->savebooking->response->order->id);
                     if($Cancel_Status==1)
                      {
                        echo '<a href="javascript:void(0);" class="btn btn-danger brn-block">Cancelled</a>';
                      }    
                      else
                      {
                        if($db->clm_value('status' , 'orderid', 'hotelogix_details', $booking->savebooking->response->order->id)==1)
                        {
                          ?>
                          <a href="javascript:void(0);" data-booking='<?= $booking->savebooking->response->order->id; ?>' class="btn btn-danger brn-block cancelbtn">Cancel</a>  
                          <?php
                        }
                        else
                        {
                          echo '<a href="javascript:void(0);" class="btn btn-danger brn-block">Not Confirmed</a>';  
                        }
                        ?>
                        
                        <?php    
                      }
                    ?>
                    
                    </td>
						      </tr>
						      <tr>
						        <td>From:  <?= $db->date_fromate($booking->when->start_date);?></td>
						        <td>To: <?= $db->date_fromate($booking->when->end_date); ?></td>
						        <td>Duration: <?= $booking->when->duration; ?></td>
						      </tr>
						      <tr>
						        <td>Adults: <?=$booking->person->adult; ?></td>
						        <td>Children: <?=$booking->person->child; ?></td>
						        <td>Total: <?=$booking->person->adult + $booking->person->child; ?></td>
						      </tr>						      
						    </tbody>
						  </table>

              <table class="table table-bordered custom">
                <caption>Stay</caption>
						    <thead>
						      <tr>
						        <th>Room Type</th>
						        <th>Unit</th>
                    <th>Rate</th>
                    <th>Tax</th>
						        <th align="right">Price (Rs.)</th>
						      </tr>
						    </thead>
						    <tbody>
                  <?php
                    foreach ($booking->rooms as $key => $value) {
                      ?>
                        <tr>
                          <td><?= $value->room_name; ?></td>
                          <td><?= $value->room_count; ?></td>
                          <td><?= $value->rate->price; ?></td>
                          <td><?= $value->rate->tax; ?></td>
                          <td><?= ($value->rate->price + $value->rate->tax)*$value->room_count; ?></td>
                        </tr>    
                      <?php
                    }
                  ?>
						      
						    </tbody>
						  </table>

						  
						     <?php
                    $package_price = 0;


                    foreach ($booking->package as $key => $value) {
                      $package_price = $package_price + $value->totalPrice;
                      ?>
                      <table class="table table-bordered custom">
                            <caption>Experience</caption>
                      </table>
                      <table class="table table-bordered custom">
                      <thead>
                        <tr>
                            <th>Description</th>
                            <th>Unit</th>
                            <th align="right">Price (Rs.)</th>
                            <th>Activities</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php

                      $act_count = 0;
                      ?>
                        <tr>
                          <td rowspan="5"><?= $value->title; ?></td>
                          <td rowspan="5"><?= $value->forPerson; ?></td>
                          <td rowspan="5"><?= $value->totalPrice; ?></td>
                        </tr>    
                      <?php
                      if(is_object($value->selectedActivity))
                      {
                        $value->selectedActivity = json_decode(json_encode($value->selectedActivity), true);
                      }
                      
                      foreach ($value->groups as  $group) {
                        foreach ($group as $subgroup) {
                          foreach ($subgroup->activities as $activity) {
                            if(isset($activity->seqId))
                            {
         //                     echo 'multiple choice';
                              if($value->selectedActivity[$activity->seqId]==1)
                              {
                                $act_count++;
                                ?>
                                <tr>
                                  <td><?= $activity->Activity_Name; ?></td>
                                </tr>
                                <?php
                              }
                            }
                            else
                            {
                                  $act_count++;
                            ?>
                                <tr>
                                  <td><?= $activity->Activity_Name; ?></td>
                                </tr>      
                              <?php 
                            }
                          }
                        }
                      }
                      ?>
                      </tbody>
                      </table>
                      <?php
                    }
                  ?>
        		    </tbody>
						  </table>

						  <table class="table table-bordered">                          
						    <tbody>						     
						      <tr>
                    <td colspan="3" align="right">Amount : <?= $price =  $package_price + $booking->savebooking->response->order->orderamount->amount; ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="right">Amount Deposited: <?= $price =  $package_price + $booking->savebooking->response->order->deposittotal->amount; ?></td>
                  </tr>

						    </tbody>
						  </table>

                        </div>
                      </div>
                    </div>
                    <?php
                    }
                  }
                  }
                  ?>
                  
                </div>

            </div>
        </div>        
    </section>
    
    <?php include_once("includes/social-sec.php");?>
    
    <?php include_once("includes/footer.php");?>

<div id="updatePic" class="modal fade signing" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="signin">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Profile Picture</h4>
          </div>
          <div class="modal-body">              
             <form action="" method="post" id="picForm" enctype="multipart/form-data">  
                <div class="form-group">
                    <label for="exampleInputFile">Update Profile Picture</label>
                    <input type="file" name="Image" id="Image" class="btn btn-default btn-block" required="required">
                    <p class="help-block">Choose a Picture to Upload</p>
                  </div>
                <div class="row">   
                    <div class="col-sm-12">    
                        <fieldset class="form-group">                           
                            <input type="submit" id="pic_btn" name="pic_btn" value="Update" class="btn btn-pura pull-right" required="required">
                        </fieldset>
                    </div>                      
                </div>               
             </form>  
          </div>
       </div>       
    </div>
  </div>
</div>

<div id="updatePass" class="modal fade signing" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="signin">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body">              
             <form action="" method="post" id="passForm" >   
                <div class="form-group">
                    <label for="password1">Enter New Password</label>
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter new Password" required="required">
                  </div>
                  <div class="form-group">
                    <label for="password2">Confirm New Password</label>
                    <input type="password" class="form-control" id="password2"  name="password2" placeholder="Confirm new Password" required="required">
                  </div>
                <div class="row">   
                    <div class="col-sm-12">    
                        <fieldset class="form-group">                           
                            <input type="submit" id="btn_pass" name="pass_btn" value="Update" class="btn btn-pura pull-right">
                        </fieldset>
                    </div>                      
                </div>               
             </form>  
          </div>
       </div>       
    </div>
  </div>
</div>


<div id="cancelModal" class="modal fade signing" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
       <div class="signin">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Confirm</h4>
          </div>
          <div class="modal-body">
              <h5>Your Cancellation Charges would be <span id="canPrice"></span></h5>
              <p>Are you sure?</p>
              <div class="row">
                <div class="col-sm-12">
                  <input type="button" name="yes" id ="yes" value="Yes" class="btn btn-pura pull-left"> &nbsp;  &nbsp;
                  <input type="button" name="no" id="no" value="No" class="btn btn-link pull-left">
                </div>
              </div>
          </div>
       </div>
       
    </div>

  </div>
</div>    

      
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script src="js/common.js"></script>
    <script>
		$(document).ready(function() {
      var urlx = "http://api.purastays.com/hotelogix/getcancellationcharge";
      var id;
      var cancelCharge;
      $('.booking-history .panel').each(function(){
        id = $(this).find('.table a.cancelbtn').data('booking');
        var val = {"orderid": id};
        $(this).find('.table a.cancelbtn').on('click', function(){
          $(".overlay").fadeIn(500);
          console.log(val);
          console.log(urlx);
          $.ajax({
            contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(val),
            crossDomain: true,
            url: urlx,
            success: function(msg){
               $(".overlay").fadeOut();
               console.log(msg);
              if(msg.status == 1){
                //alert(msg.message);
                console.log(msg)
                $("#cancelModal").modal();
                cancelCharge = msg.cancellationcharge;
                $("#canPrice").text(cancelCharge);
              }
            },error: function(res){
                console.log(res);  
            }
          });
        
        })
      })

      $("#no").on('click', function(){
        $("#cancelModal").modal('hide');
      })

      $("#yes").on('click', function(){
        $(".overlay").fadeIn(500);
        var urly = "http://api.purastays.com//hotelogix/cancel";
        var data2 = {"orderid":id, "cancelCharge":cancelCharge};
        console.log(data2);
        $.ajax({
            contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data2),
            crossDomain: true,
            url: urly,
            success: function(msg1){
               $(".overlay").fadeOut();
              console.log(msg1);
              if(msg1.status == 1){
                  $('.table a.cancelbtn').html('Cancelled');

                  $("#cancelModal").modal('hide');
                  $(".overlay").fadeOut(500);
              
              }
              else
              {
                  $('.table a.cancelbtn').html('Tri Again');
                  $("#cancelModal").modal('hide');
                  $(".overlay").fadeOut(500);
                  $('.table a.cancelbtn').class('btn btn-danger brn-block');
              }
              if(msg1.status == 1){
                console.log(msg1)
              }
            },error: function(res){
                console.log(res);  
            }
          });
      })


      $('.slider1').bxSlider({
			  pagerCustom: '#bx-pager', controls: false
			});  
            $("#general_btn").on("click",function(){
                $('.overlay').fadeIn(500);
                var form=$("#generalForm");
                //data: JSON.stringify(form.serializeArray()),
                 $.ajax({
                    contentType: "application/json; charset=utf-8",
                    type: "POST",
                    dataType: 'json',
                    data: JSON.stringify(form.serializeArray()),
                    crossDomain: true,
                    url: '../api/contactus/general',
                    success: function(msg){
                        $('.overlay').fadeOut(500);
                        $("#general .alert.alert-success").fadeIn(300);    
                        $("#general .alert.alert-success").text(msg.message);   

                        console.log(msg);
                    },error: function(res){
                        alert('ajax post failed');  
                    }
                 }); 
            })
        });  
    </script>   
  </body>
</html>
