<?php
   include_once("includes/db.inc.php");
   $db= new DB();
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura Stays.com</title>
    <meta name="description" content="Pura Stays.com">
    <meta name="keywords" content="Pura Stays.com">

    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link href="css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <body>
  <div class="overlay"><img src="images/loading.gif" alt="pura" height="10"></div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script src="js/common.js"></script>
     <script>
        var vid = document.getElementById("PuraVideo");
        var bannImg = document.getElementById("slideVid");
        /*vid.oncanplay = function() {
            //alert(vid);
            //bannImg.setAttribute("class", "hide");
            //vid.setAttribute("class", "show");
        };*/
    </script>
    <!-- Login Modal -->
    <?php include_once("includes/login-modal.php");?>

    <header>
    	<section class="pura-banner">
        	
            <?php include_once("includes/nav.php");?>
            
            <div class="bann-txt-container">
            	<div class="container">
                    <h1>Explore | Connect | Revive</h1>
                    <p>Quench your thirst for serene holiday stay, adventure and more...</p>
                </div>
            </div>
            <div class="pura-slider" id="slideVid">
            	<img src="images/slide2.jpg" alt="pura slides">
            </div>
            <video id="PuraVideo" loop autoplay preload="auto" poster="images/slide2.jpg">
              <source src="videos/Croatia-P1-1.mp4" type="video/mp4">
              <source src="videos/Croatia-P1-0.webm" type="video/webm">
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
        </section>
    </header>
   
    <?php
        
        $qry = "select Image, Title, Alt, Meta, Description from images where ";
            if ($Default_Id!="") {$qry .= "(find_in_set ('".$Default_Id."', `Tags`) > 0 || find_in_set (' ".$Default_Id."', `Tags`) > 0) && ";}
            if ($Gallery_Id!="") {$qry .= "(find_in_set ('".$Gallery_Id."', `Tags`) > 0 || find_in_set (' ".$Gallery_Id."', `Tags`) > 0) && ";}
            $qry .= "Status = 1 order by Position ASC";
        $result = $db->_query($qry);

        $i=0;
        $row1 = array();
        while($row = mysqli_fetch_array($result))
        {
            $i++;
            $row1[$i] = $row;
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
                    if(count($gallery_res_img)<5){
                        if($arr[$i]!="")
                        {
                            $gallery_res_img[] = $arr[$i];
                            $gallery_res_id[] = $gallery_r_id[$j]; 
                            $gallery_res_title[] = $gallery_r_title[$j]; 
                            $gallery_res_desc[] = $gallery_r_desc[$j]; 
                            $gallery_res_type[] = 'resorts';
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

        for($i=0; $i<6; $i++)
        {
            
                $j = 0;
                foreach ($gallery_a_img as $key => $value) {
                    $arr = explode(', ', $value);
                    if(count($gallery_act_img)<5){
                        if($arr[$i]!="")
                        {
                            $gallery_act_img[] = $arr[$i];
                            $gallery_act_id[] = $gallery_a_id[$j]; 
                            $gallery_act_title[] = $gallery_a_title[$j]; 
                            $gallery_act_desc[] = $gallery_a_desc[$j]; 

                            $gallery_act_type[] = 'activity';
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


        //var_dump($gallery_title);
        //var_dump($gallery_type);
        
        $gallery = implode("', '", $gallery_img);
        //$gallery = substr($gallery_1, 0, -2);

        $gallery = "'".$gallery."'";
        $qry = "select * FROM images where Image in ($gallery)";
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
    <?php /*?>
    <section class="sec explore-home">
        <div class="container">
            <h2><?= $cluster_name;?></h2>
            <div class="sec-container">
                <div class="row">
                    <div class="col-sm-4">
                        <ul id="col1" class="gallRow">
                            <li class="large">
                                <img src="<?= $row1[1]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <?php
                                         if($gallery_type[array_search($row1[1]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[1]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[1]['Image'], $gallery_img)];  
                                         }

                                         $gallery_type[array_search($row1[1]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[1]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[1]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $row1[2]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                         <?php
                                         if($gallery_type[array_search($row1[2]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[2]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[2]['Image'], $gallery_img)];  
                                         }
                                         
                                         $gallery_type[array_search($row1[2]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[2]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[2]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul id="col2" class="gallRow">
                            <li class="small">
                                <img src="<?= $row1[3]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                         <?php
                                         if($gallery_type[array_search($row1[3]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[3]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[3]['Image'], $gallery_img)];  
                                         }
                                         
                                         $gallery_type[array_search($row1[3]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[3]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[3]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $row1[4]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                         <?php
                                         if($gallery_type[array_search($row1[4]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[4]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[4]['Image'], $gallery_img)];  
                                         }
                                         
                                         $gallery_type[array_search($row1[4]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[4]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[4]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>  
                            <li class="small">
                                <img src="<?= $row1[5]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                         <?php
                                         if($gallery_type[array_search($row1[5]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[5]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[5]['Image'], $gallery_img)];  
                                         }
                                         
                                         $gallery_type[array_search($row1[5]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[5]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[5]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul id="col3" class="gallRow">
                            <li class="large">
                                <img src="<?= $row1[6]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                         <?php
                                         if($gallery_type[array_search($row1[6]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[6]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[6]['Image'], $gallery_img)];  
                                         }
                                         
                                         $gallery_type[array_search($row1[6]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[6]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[6]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $row1[7]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                         <?php
                                         if($gallery_type[array_search($row1[7]['Image'], $gallery_img)]=='resorts')
                                         {
                                           $url = "resort.php?id=".$gallery_id[array_search($row1[7]['Image'], $gallery_img)];
                                         }
                                         else
                                         {
                                            $url = "map.php?id=".$gallery_id[array_search($row1[7]['Image'], $gallery_img)];  
                                         }
                                         
                                         $gallery_type[array_search($row1[7]['Image'], $gallery_img)];
                                        ?>
                                        <a href="<?= $url; ?>" class="fa fa-link"></a>
                                        
                                        <h4><?= $gallery_heading[array_search($row1[7]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[7]['Image'], $gallery_img)]; ?></p>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    </section>  
    <?php */?>
    
    <section class="sec gallery2 explore-gallery">
        <div class="container">
            <h2>Quick Look</h2>
            <div class="sec-container">
                <div class="galleryNew">
                    <ul>
                        <li class="col-sm-8">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[1]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[1]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[1]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[1]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[1]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[1]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[1]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[2]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[2]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[2]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[2]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[2]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[2]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[2]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[3]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[3]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[3]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[3]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[3]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[3]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[3]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>

                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[4]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[4]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[4]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[4]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[4]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[4]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[4]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[5]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[5]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[5]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[5]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[5]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[5]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[5]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[6]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[6]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[6]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[6]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[6]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[6]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[6]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>

                        <li class="col-sm-8">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[7]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[7]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[7]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[7]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[7]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[7]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[7]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[8]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[8]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[8]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[8]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[8]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[8]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[8]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[9]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[9]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[9]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[9]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[9]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[9]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[9]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $row1[10]['Image']; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <?php
                                             if($gallery_type[array_search($row1[10]['Image'], $gallery_img)]=='resorts')
                                             {
                                               $url = "resort.php?id=".$gallery_id[array_search($row1[10]['Image'], $gallery_img)];
                                             }
                                             else
                                             {
                                                $url = "map.php?id=".$gallery_id[array_search($row1[10]['Image'], $gallery_img)];  
                                             }
                                             
                                             $gallery_type[array_search($row1[10]['Image'], $gallery_img)];
                                            ?>
                                        <a href="<?= $url; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <h4><?= $gallery_heading[array_search($row1[10]['Image'], $gallery_img)]; ?></h4>
                                        <p><?= $gallery_desc[array_search($row1[10]['Image'], $gallery_img)]; ?></p>
                                    </div>    
                                </div>
                            </div>
                        </li> 
                    </ul>
                    <div class="clearfix"></div>
                </div>
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
                    if($Default_Id!="") { $qry1 .= " find_in_set($Default_Id, Tags) && "; }
                    $qry1 .= " Status = 1 order by Id ASC limit 2";
                    
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
                                        <div class="exp-act-title"><h4><?= $row['Title']?></h4></div>
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
                                            <a href="story-details.php?stroy=<?= $row['Id']; ?>" class="btn btn-pura2">Read more</a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <div class="btn-sec">
                	<a href="stories.php" class="btn btn-lg btn-pura">view more</a>
                </div>
            </div>
        </div>
    </section>
    
    <?php include_once("includes/social-sec.php");?>
    
    <?php include_once("includes/footer.php");?>


    
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $(".gallRow li").each(function(){
                var _this = this;
                var contWd = $(this).width();
                var contHt = $(this).height();
                var this_img = $(this).children('img');
                
                var fitImage = function(){
                  var img_ht = this_img.height();
                  var img_wd = this_img.width();
                   if(img_ht < img_wd){ //landsacape                      
                        if(contHt < contWd){                                        
                            this_img.width(contWd+100);
                        }else{                                                        
                            this_img.height(contHt);
                            this_img.css('width', 'auto');
                        }
                    }else{  //portrait image                        
                         if(contHt < contWd){                                                        
                            this_img.width(contWd);
                        }else{                        
                            this_img.height(contHt);      
                            this_img.css('width', 'auto');                          
                        }
                    }
                }

                fitImage();
                this_img.load(function(){                
                   fitImage();
                });
            }) 
    })
</script>
<script type = 'text/javascript'>
    var tab = new Array();
    function updateResult(){
        var mood = $("#mood").val()
        var cluster = $("#cluster").val()
        $('.overlay').fadeIn(300);
        console.log("http://api.purastays.com/cluster-mood-selection/cluster/"+ cluster +"/mood/"+mood+"?_=" + new Date().getTime());
        var data1 =  JSON.stringify({"cluster":cluster, "mood":mood});
        $.ajax({
            contentType:"application/json; charset=utf-8",
            type:"GET", 
            dataType :'json',
            url:" http://api.purastays.com/cluster-mood-selection/cluster/"+ cluster +"/mood/"+mood+"?_=" + new Date().getTime(),                
            crossDomain: true,
            cache: false,
            success: function(res){    
                var a = res;                   
                var col1 = [a.gallery[0], a.gallery[1]];
                var col2 = [a.gallery[2], a.gallery[3], a.gallery[4]]; 
                var col3 = [a.gallery[5], a.gallery[6]];
                if(res.gallery_title != null){
                    $('.sec.explore-home h2').text(res.gallery_title);
                }                            
                renderGallery(col1, col2, col3);
                renderTestimonial(res.testimonials);                          
            },
            error: function (err) {
                console.log(err);
            },
            complete: function(){
                $('.overlay').fadeOut(500); 
            }
        });
    }
    var renderGallery = function(col1, col2, col3){
        $( "#col1 li" ).each(function( index ) {
            var _this = this;             
            $(this).find('img').attr({'src': col1[index].Image, 'alt': col1[index].Alt});
            $(this).find('.txt-blk h4').text(col1[index].Title);
            $(this).find('.txt-blk p').text(col1[index].Description);                    
        });
  
        $( "#col2 li" ).each(function( index ) {
            var _this = this;                    
            $(this).find('img').attr({'src': col2[index].Image, 'alt': col2[index].Alt});
            $(this).find('.txt-blk h4').text(col2[index].Title);
            $(this).find('.txt-blk p').text(col2[index].Description);                    
        });

        $( "#col3 li" ).each(function( index ) {
            var _this = this;                    
            $(this).find('img').attr({'src': col3[index].Image, 'alt': col3[index].Alt});
            $(this).find('.txt-blk h4').text(col3[index].Title);
            $(this).find('.txt-blk p').text(col3[index].Description);                    
        });
    }

    var renderTestimonial = function(data){
        $('.exp-block').each(function(index){
            var _this = this;
            $(this).find('.img-bg-cont > img').attr('src',data[index].Banner_Image);
            $(this).find('.exp-container .exp-act-pics .usr1 img').attr('src',data[index].User1Image);
            $(this).find('.exp-container .exp-act-pics .usr2 img').attr('src',data[index].User2Image);
            $(this).find('.exp-container .exp-act-pics .usr1 p.name').text(data[index].User1Name);
            $(this).find('.exp-container .exp-act-pics .usr2 p.name').text(data[index].User2Name);
            $(this).find('.exp-container .exp-act-title h4').text(data[index].Title);
            $(this).find('.exp-container .exp-act-block .exp-txt p').text(data[index].Summary);
            
              
        })
        
    }

</script>
