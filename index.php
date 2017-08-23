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
    
    <?php include_once("style.php") ?>

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
  
  <div class="overlay"><img src="images/loading.gif" alt="Pura Stays"></div>

    <?php include_once("includes/login-modal.php");?>

    <header>

	  

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

            <section class="sec quick-weekend">
                <div class="container">
                    <h2>For quick weekend getaways</h2>
                    <div class="sec-container">
                        <p>Our home-like living spaces have been enriched with local experiences, for you all, to open up a new chapter – filled in with excitement and adventures, throughout; whenever you plan to vacate from the city and shift your mind towards a resting weekend getaway! Pura Stays is not in existence just for comfort and qualitative standardized accommodation aspects, but also for a planned and organized vacation, for our visitors. To stand out from all the commercial stays; our villas/ cottages/ boutique resorts and holiday homes offer a unique holiday experience.</p>

                        <p>Our properties have been categorized on the basis of different travel moods. Focusing on different themes, we intend to place the right person in their mood, at the right stay! Depending on how an individual operates, throughout the year, our properties run by different offers (or seasonal deals).</p>

                        <p>To make your vacation, especially in two-day or long weekend period, we consider time-in-hand and make the best use out of your estimated schedule! From adventurous trails into the dense forests trails to a peaceful lunch, with a view of clear skies; we have it all!</p>

                    </div>
                </div>
            </section>

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

    <?php include_once("js.php") ?>

    <?php include("resorts/offers.php");?>  
    
    <?php include_once("includes/tagbody.php") ?>
    <script>
        var resource;
    </script>
    <?php include("includes/bodyexit.php"); ?>

  </body>
</html>


