<?php
   include_once("includes/db.inc.php");
   $db= new DB();
   
   //url-rewrite function
       $qry_url = "select * from url_redirection where Status = 1"; 
       $result_url = $db->_query($qry_url);
       while($row_url = mysqli_fetch_array($result_url))
            $arr_url[$row_url['Old_Url']] = $row_url['New_Url'];
    //end of url-rewrite function


   $Default_Id = $db->clm_value('Id', 'Title', 'tags', 'default');
   $Gallery_Id = $db->clm_value('Id', 'Title', 'tags', 'gallery');
   

   $qry = "select Id,Title from clusters where find_in_set ('".$Default_Id."', Tags) || find_in_set (' ".$Default_Id."', Tags)";
   $resort = $db->_query($qry);
   $row = mysqli_fetch_array($resort);
   $Cluster_Id = $row['Id'];
   $cluster_name = $row['Title'];
   
   if($Cluster_Id!="0")
    {
        $row = mysqli_fetch_array($db->_query("select Resorts from clusters where Id = '$Cluster_Id'"));    
        $resorts = rtrim(trim($row['Resorts']), ',');
    }
    
    header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weekend Getaways near Delhi| Book holiday Resorts| Packages-Pura Stays</title>
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="description" content="Resorts near Delhi for weekend getaways, Book a perfect holiday stay, cottages and resorts in Nainital. Level up your travel experience with Pura Stays hotels in Nainital">
    <meta name="keywords" content="weekend getaways packages, book holiday resorts, weekend getaways near delhi, holiday packages ">
  
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/elements.css" rel="stylesheet">
    <link href="css/popup-offer.css" rel="stylesheet"> 

    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@purastays"/>
    <meta name="twitter:title" content="Book Holiday Resorts, Weekend Getaways, Packages | Pura Stays"/>
    <meta name="twitter:description" content="Travel mood based collection of holiday stays, cottages and resorts. Book unique weekend getaways, travel experiences and holiday packages with Pura Stays."/>
    <meta name="twitter:creator" content="@purastays"/>
    <meta name="twitter:image:src" content="http://www.purastays.com/images/pura-stays-logo.png"/>
    <meta name="twitter:url" content="http://www.purastays.com/"/>

    <meta property="og:title" content="Book Holiday Resorts, Weekend Getaways, Packages | Pura Stays"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://www.purastays.com/"/>
    <meta property="og:image" content="http://www.purastays.com/images/pura-stays-logo.png"/>
    <meta property="og:description" content="Travel mood based collection of holiday stays, cottages and resorts. Book unique weekend getaways, travel experiences and holiday packages with Pura Stays."/>
    <meta property="og:site_name" content="Pura Stays" />
    <meta property="fb:admins" content="507345255"/>
    <meta property="fb:app_id" content="1152657561422465"/>

    <?php include_once("includes/taghead.php") ?>
  </head>

  <body>
  <?php include_once("includes/tagbody.php") ?>
  <div class="overlay"><img src="images/loading.gif" alt="Pura Stays"></div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css'/>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="js/common.js"></script>
    
    <script>
        var vid = document.getElementById("PuraVideo");
        var bannImg = document.getElementById("slideVid");
    </script>
  
    <?php include_once("includes/login-modal.php");?>

    <header>

	<?php include("resorts/offers.php");?>    

    	<div class="pura-banner">        	
            <?php include_once("includes/nav2.php");?>

            <div class="bann-txt-container">
            	<div class="container">
                    <h1>Yearning for a quick getaway?</h1>
                    <p>Find unique holiday stays as per your #TravelMood</p>
                </div>
            </div>
            <div class="pura-slider" id="slideVid">
            	
            </div>
            <video id="PuraVideo" loop autoplay preload="auto" poster="images/slide2.jpg">
              <source src="videos/Croatia-P1-1.mp4" type="video/mp4">
              <!--<source src="videos/Croatia-P1-0.webm" type="video/webm">-->
            </video>

            <div class="slider-comp">
            	<div class="container">
            		<div class="form-container" id="getCluster">
                    	<div class="form-group chs">
                        	<select class="form-control" name="cluster" id="cluster">
                                <option value="0">Where</option>
                                <?php
                                    $db = new DB();
                                    $result = $db->_query("select Id, Title from clusters where Status=1 order by Title ASC");
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['Id'].'">'.$row['Title'].'</option>';          
                                    }
                                ?>
                              </select>
                              <span></span>
                        </div>
                        <div class="form-group chs">
                        	<select class="form-control" name="mood" id="mood">
                                <option value="0">Travel Mood</option>
                                 <?php
                                    $db = new DB();
                                    $Mood_Id = $db->clm_value('Id', 'Title', ' tagtypes', 'mood');
                                    $qry = 'select Id, Title from tags where CONCAT(",", `Type`, ",") REGEXP ",('.$Mood_Id.'|'.$Mood_Id.')" order by Title ASC';
                                    $result = $db->_query($qry);
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['Id'].'">'.$row['Title'].'</option>';          
                                    }
                                ?>
                              </select>
                              <span></span>
                        </div>
                        <button class="form-control btn btn-pura" onclick="updateResult()">Find</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <?php
        
        $qry = "select Image, Title, Alt, Meta, Description from images where ";
            if ($Default_Id!="") {$qry .= "(find_in_set ('".$Default_Id."', `Tags`) > 0 || find_in_set (' ".$Default_Id."', `Tags`) > 0) && ";}
            if ($Gallery_Id!="") {$qry .= "(find_in_set ('".$Gallery_Id."', `Tags`) > 0 || find_in_set (' ".$Gallery_Id."', `Tags`) > 0) && ";}
            $qry .= "Status = 1 order by Position ASC";
        

        $result = $db->_query($qry);

        $i=0;
        $row1 = array();
        $mood_images = array();
        while($row = mysqli_fetch_array($result))
        {
            $i++;
            $row1[$i] = $row;
            $mood_images[] = $row['Image'];
        }

       $qry = "select Id, gallery_id, Resort_Name, Resort_Summary from resorts where Id IN ($resorts) && Status = 1";
        $result = $db->_query($qry);
        $gallery_r_img = [];
        $gallery_r_id = [];
        $gallery_r_title = [];
        $gallery_r_desc = [];

        $gallery_r_type = [];

        $gallery_res_img = [];
        $gallery_res_id = [];
        $gallery_res_title = [];
        $gallery_res_desc = [];

        $gallery_res_type = [];

        while($row = mysqli_fetch_array($result))
        {

                $gallery_r_img[] = $row['gallery_id'];
                $gallery_r_id[] = $row['Id'];
                $gallery_r_title[] = $row['Resort_Name'];

                $gallery_r_desc[] = $row['Resort_Summary'];
                $gallery_r_type[] = 'resorts';
        }

        
        for($i=0; $i<6; $i++)
        {
                $j = 0;
                foreach ($gallery_r_img as $key => $value) {
                    $arr = explode(', ', $value);
                    if(count($gallery_res_img)<7){
                        if($arr[$i]!="")
                        {
                            if(!in_array($arr[$i], $gallery_res_img))
                            {
                                if(in_array($arr[$i], $mood_images))
                                   {

                                        $gallery_res_img[] = $arr[$i];
                                        $gallery_res_id[] = $gallery_r_id[$j]; 
                                        $gallery_res_title[] = $gallery_r_title[$j]; 
                                        $gallery_res_desc[] = $gallery_r_desc[$j]; 
                                        $gallery_res_type[] = 'resorts';
                                    }
                            }
                        }
                        $j++;
                }
            }
        }

        $gallery_res_img;
        $gallery_res_id;
        $gallery_res_type;
        
        $activities = $db->clm_value('activities', 'Id', 'clusters', $Cluster_Id);
        $activities = substr($activities, 0, -2);

        $qry = "select Id, gallery_id, Activity_Name, Activity_Summary from activities where Id IN ($activities)";
        $result = $db->_query($qry);
        $gallery_a_img = [];
        $gallery_a_id = [];
        $gallery_a_title = [];
        $gallery_a_desc = [];
        $gallery_a_type = [];

        $gallery_act_img = [];
        $gallery_act_id = [];
        $gallery_act_title = [];
        $gallery_act_desc = [];

        $gallery_act_type = [];

        while($row = mysqli_fetch_array($result))
        {
                $gallery_a_img[] = $row['gallery_id'];
                $gallery_a_id[] = $row['Id'];
                $gallery_a_title[] = $row['Activity_Name'];
                $gallery_a_desc[] = $row['Activity_Summary'];

                $gallery_a_type[] = 'activity';
        }

        for($i=0; $i<2; $i++)
        {
            
                $j = 0;
                foreach ($gallery_a_img as $key => $value) {
                    $arr = explode(', ', $value);
                    if(count($gallery_act_img)<3){
                        if($arr[$i]!="")
                        {
                            if(!in_array($arr[$i], $gallery_act_img))
                            {
                                if(in_array($arr[$i], $mood_images))
                                   {
                                        $gallery_act_img[] = $arr[$i];
                                        $gallery_act_id[] = $gallery_a_id[$j]; 
                                        $gallery_act_title[] = $gallery_a_title[$j]; 
                                        $gallery_act_desc[] = $gallery_a_desc[$j]; 
                                        $gallery_act_type[] = 'activity';
                                    }
                            }
                        }
                        $j++;
                }
            }
        }

        $gallery_act_img;
        $gallery_act_id;
        $gallery_act_type;
        

        $gallery_img = array_merge($gallery_res_img, $gallery_act_img);
        $gallery_id= array_merge($gallery_res_id, $gallery_act_id);
        $gallery_heading= array_merge($gallery_res_title, $gallery_act_title);
        $gallery_desc= array_merge($gallery_res_desc, $gallery_act_desc);

        $gallery_type = array_merge($gallery_res_type, $gallery_act_type);


        
        
        $gallery = implode("', '", $gallery_img);
      

        $gallery = "'".$gallery."'";
        $qry = "select * FROM images where Image in ($gallery) order by Position ASC";
        $result1 = $db->_query($qry);
        $i=0;
        $row1 = array();
        while($row = mysqli_fetch_array($result1))
        {
            $i++;
            $row1[$i] = $row;
        }
        $gallery_title = $db->clm_value('Title', 'Id', 'clusters', $Cluster_Id);

    ?>
    
    <section class="sec gallery2 explore-gallery">

        <div class="container">
            
            <h2>Discover</h2>
            <h3 id="find_result" class="find_result"></h3>
            <div class="sec-container">
                <div class="galleryNew">
                    <ul>
                        <li class="col-sm-8">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[1]['Image']; ?>" alt="<?= $row1[1]['Alt']; ?>">
                                </figure>
                                <?php
                                             if($gallery_type[array_search($row1[1]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[1]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[1]['Image'], $gallery_img)];  
                                             }
                                             
                                             $url = $arr_url[$url];
                                             
                                             $gallery_type[array_search($row1[1]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                        
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[1]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[1]['Image'], $gallery_img)]; ?></p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[2]['Image']; ?>" alt="<?= $row1[2]['Alt']; ?>">
                                </figure>
                                 <?php
                                             if($gallery_type[array_search($row1[2]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[2]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[2]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[2]['Image'], $gallery_img)];
                                    ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                       
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[2]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[2]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[3]['Image']; ?>" alt="<?= $row1[3]['Alt']; ?>">
                                </figure>
                                 <?php
                                             if($gallery_type[array_search($row1[3]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[3]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[3]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[3]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                       
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[3]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[3]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>

                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[4]['Image']; ?>" alt="<?= $row1[4]['Alt']; ?>">
                                </figure>
                                <?php
                                             if($gallery_type[array_search($row1[4]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[4]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[4]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[4]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                        
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[4]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[4]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[5]['Image']; ?>" alt="<?= $row1[5]['Alt']; ?>">
                                </figure>
                                <?php
                                             if($gallery_type[array_search($row1[5]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[5]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[5]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[5]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                        
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[5]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[5]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[6]['Image']; ?>" alt="<?= $row1[6]['Alt']; ?>">
                                </figure>
                                <?php
                                             if($gallery_type[array_search($row1[6]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[6]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[6]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[6]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                        
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[6]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[6]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>

                        <li class="col-sm-8">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[7]['Image']; ?>" alt="<?= $row1[7]['Alt']; ?>">
                                </figure>
                                  <?php
                                             if($gallery_type[array_search($row1[7]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[7]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[7]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[7]['Image'], $gallery_img)];
                                    ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                      
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[7]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[7]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>
                        <?php
                        if(!$db->is_mobile())
                            {
                        ?>
                        <li class="col-sm-4 resImgGal">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[8]['Image']; ?>" alt="<?= $row1[8]['Alt']; ?>">
                                </figure>
                                 <?php
                                             if($gallery_type[array_search($row1[8]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[8]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[8]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[8]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                       
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[8]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[8]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>
                        <li class="col-sm-4 resImgGal">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[9]['Image']; ?>" alt="<?= $row1[9]['Alt']; ?>">
                                </figure>
                                 <?php
                                             if($gallery_type[array_search($row1[9]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[9]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[9]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[9]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                       
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[9]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[9]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li>
                        <li class="col-sm-4 resImgGal">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[10]['Image']; ?>" alt="<?= $row1[10]['Alt']; ?>">
                                </figure>
                                <?php
                                             if($gallery_type[array_search($row1[10]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "http://www.purastays.com/resorts/resort.php?id=".$gallery_id[array_search($row1[10]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "http://www.purastays.com/map.php?id=".$gallery_id[array_search($row1[10]['Image'], $gallery_img)];  
                                             }
                                             $url = $arr_url[$url];
                                             $gallery_type[array_search($row1[10]['Image'], $gallery_img)];
                                ?>
                                <a href="<?= $url; ?>" data-lightbox="gall2" class="hoverImg">
                                    <div class="txtBlk"> 
                                        
                                        <div class="linkIcon"><span class="fa fa-external-link" aria-hidden="true"></span></div>
                                        <h2><?= $gallery_heading[array_search($row1[10]['Image'], $gallery_img)]; ?></h2>
                                        <p><?= $gallery_desc[array_search($row1[10]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </a>
                            </div>
                        </li> 
                                <?php
                            }
                        ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>  
    <?php
    $db = new DB();
    if(!$db->is_mobile())
        {
            ?>
            <section class="sec exp">   
            	<div class="container">
                	<h2>Travel Tales</h2>

                    <div class="sec-container">
                    	 <?php
                           $qry1 = "select Id,  User_Image, User_Name, Testimonial_For_Image, Testimonial_For_Name, Title, Banner_Title, Banner_Description, Banner_Image, Summary from testimonials where ";
                            if($Cluster_Id!="0") { $qry1 .= " resort_id IN ($resorts) && "; }
                            if($Default_Id!="") { $qry1 .= " (find_in_set('".$Default_Id."', Tags) || find_in_set(' ".$Default_Id."', Tags )) && "; }
                            $qry1 .= " Status = 1 && Description != '' order by Id ASC limit 2";
                            
                            $result = $db->_query($qry1);
                            $i=0;
                            $row2 = array();
                            while($row = mysqli_fetch_array($result))
                            {
                                $i++;
                                ?>
                                 <div class="exp-block">
                                    <div class="img-bg-cont"><img src="<?= $row['Banner_Image']?>" alt="pura experience"></div>                    
                                    <div class="exp-container">
                                        <?php
                                            if($i%2!=0)
                                            {
                                                echo '<div class="col-sm-6"></div>';        
                                            }
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="exp-act-block">                             
                                                <div class="exp-act-title"><h2><?= $row['Title']?></h2></div>
                                                <div class="exp-act-pics clearfix">
                                                    <div class="col-sm-6 usr1">
                                                        <div class="pic">
                                                            <img src="<?= $row['User_Image']?>" alt="<?= $row['User_Name']?>">
                                                        </div>
                                                        <p class="name"><?= $row['User_Name']?></p>
                                                    </div>
                                                    <div class="col-sm-6 usr2">
                                                        <div class="pic">
                                                            <img src="<?= $row['Testimonial_For_Image']?>" alt="<?= $row['Testimonial_For_Name']?>">
                                                        </div>
                                                        <p class="name"><?= $row['Testimonial_For_Name']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="exp-txt">
                                                    <p><?= $row['Summary']?></p>
                                                </div>
                                                <div class="btn-blk">
                                                    <?php
                                                        $url = "http://www.purastays.com/stories/story-details.php?stroy=".$row['Id'];
                                                        $url = $arr_url[$url];
                                                    ?>
                                                    <a href="<?= $url; ?>" class="btn btn-pura2">Read More</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="btn-sec">
                        	<a href="travel-tales" class="btn btn-lg btn-pura">View More</a>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    ?>
    <?php include_once("includes/social-sec.php");?>
    
    <?php include_once("includes/footer.php");?>


	
    <script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();     
          
    });

    function setImageWidth(){
         /* fit image to center and bottom */
        $(".galleryNew li").each(function(index){
            var parentWid = $(this).find('figure').width();
            var parentHt = $(this).find('figure').height();

            var imgWid = $(this).find('figure img').width();
            var imgHt = $(this).find('figure img').height();

            /* set image to fit initially */
            if(parentWid > parentHt){ //landscape
                $(this).find('figure img').css({'width': '100%', 'height': 'auto'});
            }

            if(parentWid < parentHt){ //portrait
                $(this).find('figure img').css({'height': '100%', 'width': 'auto'});
            }

            var widDiff = imgWid - parentWid;
            var htDiff = imgHt - parentHt;


            /* translate image */
            if(widDiff > 2) {
                $(this).find('figure img').css("left",  -(widDiff/2));
            }

            if(htDiff > 2){
                $(this).find('figure img').css("bottom",  htDiff);
            }
        })  
    }

    $(window).load(function(){
       setImageWidth();
    });
    $(window).resize(function(){
        setImageWidth();
    });
</script>
<script type = 'text/javascript'>
    var tab = new Array();
    function updateResult(){

    	
        var mood = $("#mood").val()
        var cluster = $("#cluster").val()
        

        $('.overlay').fadeIn(300);

        var data1 =  JSON.stringify({"cluster":cluster, "mood":mood});
        $.ajax({
            contentType:"application/json; charset=utf-8",
            type:"GET", 
            dataType :'json',
            url:" http://api.purastays.com/cluster-mood-selection/cluster/"+ cluster +"/mood/"+mood+"?_=" + new Date().getTime(),                
            crossDomain: true,
            cache: false,
            success: function(res){                    
                if(res.gallery_title != null){
                    $('.sec.explore-home h2').text(res.gallery_title);
                    var find_res = "";
                    if(res.mood != null)
                    {
                    	//find_res =  res.mood + " in " + res.gallery_title;
                    	find_res = 'Holiday Stays '+ res.gallery_title +' for travel mood '+ res.mood;
                    }
                    else
                    {
                    	find_res = 'Holiday Stays '+ res.gallery_title;
                    }
                    $("#find_result").text(find_res).fadeIn(300);
                }                      
                renderGallery(res.gallery);
                renderTestimonial(res.testimonials);                          
            },
            error: function (err) {
                console.log(err);
            },
            complete: function(){
                $('.overlay').fadeOut(500); 
        		$('html,body').delay(200).animate({scrollTop: $('.explore-gallery').offset().top}, 1000);
            }
        });
    }
    var renderGallery = function(data){     	
    	console.log(data); 
        $( ".galleryNew ul li" ).each(function( index ) {
            var _this = this;             
            $(this).find('.imgCntnr figure img').attr({'src': data[index].img, 'alt': data[index].heading});
            $(this).find('.hoverImg .txtBlk a.linkIcon').attr('href', data[index].link);
            $(this).find('.hoverImg .txtBlk h2').text(data[index].heading);
            $(this).find('.hoverImg .txtBlk p').text(data[index].desc);                    
        });
    }

    var renderTestimonial = function(data){    	     
    	if(data.length>0){
	        $('.exp-block').each(function(index){
	            var _this = this;
	            $(this).find('.img-bg-cont > img').attr('src',data[index].Banner_Image);
	            $(this).find('.exp-container .exp-act-pics .usr1 img').attr('src',data[index].User1Image);
	            $(this).find('.exp-container .exp-act-pics .usr2 img').attr('src',data[index].User2Image);
	            $(this).find('.exp-container .exp-act-pics .usr1 p.name').text(data[index].User1Name);
	            $(this).find('.exp-container .exp-act-pics .usr2 p.name').text(data[index].User2Name);
	            $(this).find('.exp-container .exp-act-title h4').text(data[index].Title);
	            $(this).find('.exp-container .exp-act-block .exp-txt p').text(data[index].Summary); 
	            $(this).find('.exp-container .exp-act-block .btn-blk a').attr('href', data[index].Url);
	            //$(this).find('.exp-container .exp-act-block .btn-blk a').attr('href','story-details.php?stroy=' + data[index].Id);

	        })   
        }     
    }

</script>

  </body>
</html>


