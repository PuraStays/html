<?php
    include_once("../includes/db.inc.php");
    ini_set("display_errors", 0);
    $db = new DB();

    $id = $_REQUEST['id'];
//    $id = "a|iU2sr7dZKmbZa";
    $requestStr = '{"accesskey":"'.$id.'"}';

    $actionUrl = "http://api.purastays.com/booking-history-user-profile-access";
    $request = curl_init($actionUrl);
    curl_setopt($request, CURLOPT_HEADER, 0);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, $requestStr);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
    $post_response = curl_exec($request);

    if(!is_object($post_response))
    {
        $post_response = $post_response . '}}';
    }

    $details = json_decode($post_response);

  $i = 0;
  foreach($details->bookings as $booking)
  {
    if($i==0)
    $bookings = $booking;
    $i++;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0056)file:///C:/Users/Sangh%20Deep/Downloads/index%20(1).html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Untitled Document</title>
</head>

<body style="padding:0; margin:0;">
<div style="border:0px solid #ededed; max-width:600px">
	<div style="border:0px solid #ededed; width:600px; display: block; overflow-x: auto">	
        <table width="600px" border="0" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <td style="border-bottom:1px solid #eca72e">
                    <div style="padding:10px 20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td align="left" width="30%"><img src="http://www.purastays.com/mailler/booking-confirmation_files/logo.png" alt="purastays" width="68" height="46"></td>
                                <td align="right" width="70%" valign="bottom" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; color:#3e2801;">Booking Confirmation <?= $bookings->savebooking->response->order->id; ?></td>
                            </tr>
                        </tbody></table>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div style="padding:30px 20px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody><tr>
                                <td align="left" width="50%" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:34px">Dear <strong style="font-size:13px"><?= $bookings->user->name; ?></strong></td>
                            </tr>
                            <tr>    
                                <td align="left" width="50%" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; line-height:20px;">We are pleased to confirm your reservation basis the details below. This holiday stay has been thoughtfully handpicked for you and assures a refreshing break:</td>
                            </tr>
                        </tbody></table>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top:2px solid #eca72e; margin-top:20px;">
                            <tbody><tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody><tr>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:18px; height:48px"><?= $bookings->where->resort_name;?></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody><tr>
                                            <td width="20px"></td>
                                            <td width="180px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:42px"><?= $bookings->user->name; ?></td>
                                            <td width="200px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:42px"><strong style="display:block; font-size:12px;">Phone</strong><?= $bookings->user->mobile; ?></td>
                                            <td width="200px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:42px"><strong style="display:block; font-size:12px;">Email</strong>
                                            <?= $bookings->user->email; ?></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody><tr>
                                            <td width="20px"></td>
                                            <td width="180px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Booking Details</strong><?= $bookings->savebooking->response->order->id; ?></td>
                                            <td width="200px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Booking Date &amp; Time</strong><?php echo $db->utc_to_date($bookings->savebooking->response->order->orderdate);?></td>
                                            <td width="200px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Booking Status</strong>          <?php 
                                                            echo 'Confirmed';
                                                                /*
                                                                  if($db->clm_value('status' , 'orderid', 'hotelogix_details', $bookings->savebooking->response->order->id)==1)
                                                                   {
                                                                      echo 'Confirmed';
                                                                   }
                                                                   else
                                                                   {
                                                                      if($db->clm_value('cancel' , 'orderid', 'hotelogix_details', $bookings->savebooking->response->order->id)==1){

                                                                        echo 'Cancelled';
                                                                      }
                                                                      else
                                                                      {
                                                                        echo 'Not Confirmed';  
                                                                      }
                                                                      
                                                                   }
                                                                */
                                                           ?>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                      
                                        <tr>
                                            <td width="20px"></td>
                                            <td width="70px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px">Travellers</td>
                                            <td width="50px" align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Adult</strong><?= $bookings->person->adult; ?></td>
                                            <td width="50px" align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Child</strong><?= $bookings->person->child; ?></td>
                                            <td width="10px" style="border-left:1px solid #b4b4b4;"></td>
                                            <td width="60px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px">Duration</td>
                                            <td align="center" width="80px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Check In</strong><?= $db->date_fromate($bookings->when->start_date);?></td>
                                            <td align="center" width="80px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Check Out</strong><?= $db->date_fromate($bookings->when->end_date); ?></td>
                                            <td align="center" width="80px" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:46px"><strong style="display:block; font-size:12px;">Nights</strong><?= $bookings->when->duration; ?></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                                                    
                        </tbody></table>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top:2px solid #eca72e; margin-top:20px;">
                            <tbody><tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody><tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px; border-bottom:1px solid #b4b4b4;">S. No.</td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px;  height:36px; width:120px; border-bottom:1px solid #b4b4b4;">Room Type</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;">Rooms</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:70px; border-bottom:1px solid #b4b4b4;">Nights</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px;  width:60px; border-bottom:1px solid #b4b4b4;">Rate/Night</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:50px; border-bottom:1px solid #b4b4b4;">Tax</td>
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px; border-bottom:1px solid #b4b4b4;">Amount(Rs.)</td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                        </tr>                                                                        
                                        <?php
                                          $SN= 0;
                                          $total_for_Stay = 0;
                                        foreach($bookings->rooms as $room)
                                                {
                                                    $total_for_Stay = $total_for_Stay + ($room->rate->price +$room->rate->tax)*$room->room_count;
                                          $SN++;
                                        ?>
                                        <tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px; border-bottom:1px solid #b4b4b4;"><?= $SN; ?></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px;  height:36px; border-bottom:1px solid #b4b4b4;"><?= $room->room_name; ?></td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:70px; border-bottom:1px solid #b4b4b4;"><?= $room->room_count; ?></td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:70px; border-bottom:1px solid #b4b4b4;"><?= $bookings->when->duration; ?></td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px; border-bottom:1px solid #b4b4b4;">
                                            <?= round($room->rate->price/$room->room_count); ?></td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px; border-bottom:1px solid #b4b4b4;"><?= round($room->rate->tax/$room->room_count); ?></td>
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px; border-bottom:1px solid #b4b4b4;"><?= round(($room->rate->price +$room->rate->tax)*$room->room_count); ?></td>
                                        </tr>                                                                        
                                        <?php

                                          }
                                          ?>
                                        
                                        <tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px;"></td>
                                            <td colspan="6" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px;">Total for Stay</td>
                                            
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px;"><?= round($total_for_Stay); ?></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px;"></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>                        
                                                    
                        </tbody></table>
                    <?php
                        $package_price = 0;
                        $package_price = 0;
                        $Activities = array();
                        $selectedActivity = array();
                        if($bookings->package>0)
                            {

                        
                    ?>


                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top:2px solid #eca72e; margin-top:20px;">
                            <tbody><tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody><tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:40px; border-bottom:1px solid #b4b4b4;">S. No.</td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px;  height:36px; width: 120px; border-bottom:1px solid #b4b4b4;">Experience</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:30px; border-bottom:1px solid #b4b4b4;">Person</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:150px; border-bottom:1px solid #b4b4b4;">Activities</td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px;  width:60px; border-bottom:1px solid #b4b4b4;">Rate/Person</td>
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px; border-bottom:1px solid #b4b4b4;">Amount(Rs.)</td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                        </tr>                                                                        
                                        <?php
                                            $SN = 0;
                                            $total_for_exp = 0;
                                            foreach ($bookings->package as $key => $value) {
                                               $SN++;
                                                $package_price = $package_price + $value->totalPrice;
                                                
                                                foreach ($value->groups as $group) {
                                                    foreach ($group as $sub_group) {
                                                        foreach ($sub_group->activities as $activity) 
                                                        {
                                                            $Activities[$activity->seqId] = $activity->Activity_Name.'<br />';
                                                        }
                                                    }
                                                }


                                                if ($value->selectedActivity[0] == true){ $selectedActivity[] = $Activities[0]; }
                                                if ($value->selectedActivity[1] == true){ $selectedActivity[] = $Activities[1]; }
                                                if ($value->selectedActivity[2] == true){ $selectedActivity[] = $Activities[2]; }
                                                if ($value->selectedActivity[3] == true){ $selectedActivity[] = $Activities[3]; }
                                                if ($value->selectedActivity[4] == true){ $selectedActivity[] = $Activities[4]; }
                                                if ($value->selectedActivity[5] == true){ $selectedActivity[] = $Activities[5]; }
                                                if ($value->selectedActivity[6] == true){ $selectedActivity[] = $Activities[6]; }
                                                if ($value->selectedActivity[7] == true){ $selectedActivity[] = $Activities[7]; }
                                                if ($value->selectedActivity[8] == true){ $selectedActivity[] = $Activities[8]; }
                                                if ($value->selectedActivity[9] == true){ $selectedActivity[] = $Activities[9]; }

                                                $total_for_exp = $total_for_exp + $value->totalPrice;

                                            ?>
                                        <tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; border-bottom:1px solid #b4b4b4;"></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; border-bottom:1px solid #b4b4b4;"><?= $SN;?></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px;  height:36px; border-bottom:1px solid #b4b4b4;"><?= $value->title; ?></td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; border-bottom:1px solid #b4b4b4;"><?= $value->forPerson; ?></td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; border-bottom:1px solid #b4b4b4;">
                                                <?php
                                                foreach ($selectedActivity as $act) {
                                                    echo $act;
                                                }
                                                ?>

                                            </td>
                                            <td align="center" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; border-bottom:1px solid #b4b4b4;"><?= $value->unit_price; ?></td>
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px;  border-bottom:1px solid #b4b4b4;"><?= $value->totalPrice; ?></td>
                                        </tr>                                                                        
                                        <?php
                                            }
                                        ?>
                                        <tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px;"></td>
                                            <td colspan="5" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px;">Total for Experiences</td>
                                            
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px;"><?= $total_for_exp;?></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px;"></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>                        
                                                    
                        </tbody></table>
                      <?php
                    }
                    $total =  $total_for_exp + $total_for_Stay;
                  ?>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top:2px solid #eca72e; margin-top:20px;">
                            <tbody><tr>
                                <td style="border:1px solid #b4b4b4; border-top:none">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        
                                        <tbody><tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                            <td colspan="5" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px; border-bottom:1px solid #b4b4b4;">Total</td>
                                            
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px; border-bottom:1px solid #b4b4b4;">
                                            <?= round($total); ?></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                            <td colspan="5" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px; border-bottom:1px solid #b4b4b4;">Amount Deposited</td>
                                            
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px; border-bottom:1px solid #b4b4b4;">
                                            <?php                                             
                                                   echo $bookings->savebooking->response->order->deposittotal->amount;?></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px; border-bottom:1px solid #b4b4b4;"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px;"></td>
                                            <td colspan="5" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:60px;"><strong>Balance</strong></td>
                                            
                                            <td align="right" valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:100px;"><strong><?= round($total-$bookings->savebooking->response->order->deposittotal->amount); ?></strong></td>
                                            <td valign="middle" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; height:36px; width:20px;"></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>                        
                                                    
                        </tbody></table>
                        
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div style="padding:0 20px 20px; border-bottom:1px solid #eca72e; margin-bottom:20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">                        
                            <tbody>
                            <tr>    
                                <td align="left" width="50%" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; line-height:20px;">We look forward to welcoming you!</td>
                            </tr>
                            <tr height="10px;"></tr>
                            <tr>    
                                <td align="left" width="50%" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; line-height:20px;">Should you require any further assistance or information prior to your arrival, please feel free to contact us on +91 90 1551 1551 or email us at <a href="mailto:info@purastays.com">info@purastays.com</a>.</td>
                            </tr>
                            <tr height="10px;"></tr>
                            <tr>    
                                <td align="left" width="50%" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; line-height:20px;">Best Regards,</td>
                            </tr>
                            <tr height="10px;"></tr>
                            <tr>    
                                <td align="left" width="50%" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px; line-height:20px;">Reservation Team<br>Pura Stays</td>
                            </tr>
                        </tbody></table>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #eca72e">
                    <div style="padding:0px 20px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom:10px;">
                            <tbody><tr>                        	
                                <td colspan="2" align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;"><strong>Inclusions</strong></td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Room accommodation is on continental plan (CP), includes breakfast</td>                            
                            </tr>
                            
                        </tbody></table>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom:10px;">
                            <tbody><tr>                        	
                                <td colspan="2" align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;"><strong>Check-In/Check-Out Policy</strong></td>                            
                            </tr>
                            <tr><td colspan="2" height="5px"></td></tr>
                            <tr>
                                <td colspan="2" align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Standard Check-in Time – <strong>12:30 pm</strong> | Standard Check-out Time – <strong>10:30 am</strong>.</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Early check-in between 09:00 a.m to 12:30 p.m. - Complimentary, subject to availability</td>                            
                            </tr>
                            
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Early check-in between 06:00 a.m. to 09:00 a.m. – 30% charge for one day does not include breakfast, subject to availibility </td>                            
                            </tr>
                            
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Early Check-In before 06:00 a.m. – 100% charge for one day, subject to availability </td>                            
                            </tr>
                            
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Late check-out between 12:30 p.m. to 04:00 p.m. – 30% charge for one day, subject to availability</td>                            
                            </tr>
                            
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Late check-out after 04:00 p.m. – 100% charge for one day, subject to availability</td>                            
                            </tr>
                            
                        </tbody></table>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom:10px;">
                            <tbody><tr>                        	
                                <td colspan="2" align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;"><strong>Booking Policy</strong></td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">The primary guest must be over the age of 18 to check-in to the hotel</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Proof of identity is required at the time of check-in. Valid photo ID’s include driver’s license, passport, national ID card (voter ID, Aadhar card, etc). PAN card is not accepted as a valid ID proof.</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Foreign nationals are required to carry their passport along with them at the time of check-in.</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">The holiday stay reserves the rights to admission.</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Extra Occupancy charges are not included in the booking amount above and shall be paid separately at the Holiday Stay.</td>                            
                            </tr>
                            
                        </tbody></table>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom:10px;">
                            <tbody><tr>                        	
                                <td colspan="2" align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;"><strong>Child Policy</strong></td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Children up to 5 years of age can stay in the parent’s room without additional charge.</td>
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Children between 6-12 years will be charged 50% of the adult rates for extra occupancy,  which includes breakfast and extra occupancy charges.</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">Children above 12 years will be charged as per adult rates for extra occupancy, whcih includes breakfast and extra occupancy charges.</td>                            
                            </tr>                        
                            
                        </tbody></table>
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom:10px;">
                            <tbody><tr>                        	
                                <td colspan="2" align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;"><strong>Cancellation Policy</strong></td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">20 days or more prior to Check-in time: Free cancellation (100% refund)</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">10-20 days prior to Check-in time: 50% refund</td>                            
                            </tr>
                            <tr>
                                <td width="12px" height="20px"><img src="http://www.purastays.com/mailler/booking-confirmation_files/arrow.png" alt="purastays"></td>
                                <td align="left" style="font-family:Tahoma, Geneva, sans-serif; font-size:11px;">10 days or less prior to Check-in time: 0% refund</td>                            
                            </tr>                        
                            
                        </tbody></table>
                    </div>
                </td>
            </tr>            
            
        </tbody></table>
    </div>    
</div>


</body></html>