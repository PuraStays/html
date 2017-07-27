<?php 
    include_once("includes/db.inc.php");
?>

                    <?php
                        if(isset($_REQUEST["aa"]))
                        {   
                            if(isset($_POST['email']))
                            {                               
                                $email = $_POST['email'];
                             
                                $Subject = "New User from pura coming soon page";
                                
                                //
                                $Var_Email_Id  = "mystictree01@gmail.com";
                                $Var_Password  = "smartAct@123";
                                $Var_Email_Name = 'Pura Website';
                                


                                //$Email_Id = "paritosh@flygrades.com";
                                $Email_Id = "info@purastays.com";


                               $Message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mystic Tree</title>
</head>
<body>
<table width="590" border="0" align="center" cellpadding="0" cellspacing="0" style=" background:#f2f2f2; padding:0 0 0 0;">
<tr>
<td>
<table width="590" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td><img src="http://www.htsapp.com/emailer/top.jpg" width="590" height="11" alt="" /></td>
</tr>
<tr>
<td style="border-left:1px solid #dbdde0; border-right:1px solid #dbdde0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#ffffff;">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="64%" height="126" style=" padding:20px 0 0 20px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="color:#f47f62; padding:0 10px; font-size:20px; font-weight:bolder; font-family:Arial, Helvetica, sans-serif;">You have received a new email from</td>
  </tr>
  <tr>
    <td style="padding:0 10px; "><a href="http://wwww.purastays.com" style="font-family:Arial, Helvetica, sans-serif; font-size:28px;;  color:#f47f62; text-decoration:none; font-weight:bolder;">http://Pura Stays</a></td>
  </tr>
</table>    
    </td>
    <td width="36%" rowspan="2" style=" padding:5px;"><img src="http://www.htsapp.com/emailer/envelop.jpg" style="display:block; " /></td>
  </tr>
</table>
</td>
</tr>
<tr>
<td><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding:0 0 60px 0;">
  <tr>
    <td><img src="http://www.htsapp.com/emailer/corner.jpg" width="532" height="8" /></td>
  </tr>
  <tr>
    <td style="border-left:2px solid #dbdde0; border-right:2px solid #dbdde0;" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="26%" style="background:#f4f5f6;padding:10px; font-size:16px; color:#000000; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:right;border-bottom: 1px solid #dbdde0">Email Id</td>
    <td width="74%" style="border-bottom: 1px solid #dbdde0; padding:10px 10px 10px 20px;font-family:Arial, Helvetica, sans-serif; font-size:16px;">'.$email.'</td>
  </tr>

</table>
</td>
  </tr>
</table>
 </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>';
                                $name = "hello";

                                $db = new DB();
																
                                
                                if($db->_mail($Email_Id, $name, $Message, $Subject, $Var_Email_Id, $Var_Email_Name, $Var_Password))
                                {
                                    
                                    header('Location: thank-you.html');  
                                    //echo '<h1>Thanks for connecting us. Out team will contact us soon !</h1>';
                                    //echo '<a href="index.php" class="btn btn-primary btn-lg">Back</a>  ';
                                }
                                else
                                {
                                    echo '<h1>Please try again !</h1>';        
                                }
                                
                            }
                        }
                        else
                        {
                            print('<script>location.href="index.php"</script>');
                        }


                    ?>
                    
             