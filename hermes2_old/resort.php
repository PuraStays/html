<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <link href="bower_components/lightbox2/dist/css/lightbox.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <header>
        <!-- Login Modal -->
        <?php include_once("includes/login-modal.php");?>
    	
        <section class="pura-banner-inner">
        	<div class="top-shadow"></div>
        	
            <?php include_once("includes/nav.php");?>

            <?php
            $id = $_REQUEST['id'];
            $qry = "select * from resorts where id= $id && Status = 1";
            $result = $db->_query($qry);
            $row = mysqli_Fetch_array($result);
            ?>
            
            <div class="bann-txt-container inner">
            	<div class="container">
                    <h1><?= $row['Banner_Title']; ?></h1>
                    <p></p>
                </div>
            </div>
            <div class="pura-slider">
            	<img src="<?= $row['Banner_Image']; ?>" alt="<?= $row['Banner_Title']; ?>">
            </div>
        </section>
    </header>
    
    <section class="sec-resort">
    	<div class="container">
            <div class="icon-container">    
            	<div class="row">
                	<ul>
                        <?php
                            $features =  explode(", ", $row['feature_id']);
                            $qry_f = "select f.* from resorts as r INNER JOIN features as f ON (r.feature_id REGEXP CONCAT(' ?', f.Id)) where r.Id = $id && f.Status = 1";
                            $result_f = $db->_query($qry_f);

                            if(mysqli_num_rows($result_f)==0)
                            {
                                printf("<script>location.href='index.php'</script>");       
                                exit();
                            }
                            while ($row_f = mysqli_fetch_array($result_f)) {

                                echo '<li><img src="'.$row_f["Image"].'" alt="$row_f["Title"]"></li>';
                            }
                         ?> 
                    </ul>                   
                </div>
            </div>
            <?php
                $gallery =  explode(", ", $row['gallery_id']);

            ?>
            <div class="about-container clearfix">
                <div class="abt-sec">
                    <div class="abt-banner">
                        <img src="<?= $gallery[3]; ?>" alt="about pura">
                    </div>
                    <div class="abt-txt">
                        <h4>About <?= $row['About_Resort_Title']; ?></h4>
                        <p>
                            <?= $row['About_Resort_Description']; ?>
                        </p>
                    </div>
                </div>
                <div class="review-sec">
                    <div class="head">Reviews</div>
                	<div class="review-container">
                	<div class="review-content">
                    	<ul>
                        	<li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev less">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>
                            <li>
                            	<div class="rev-blk clearfix">
                                	<div class="left">
                                    	<div class="pic"><img src="images/review-default-user.jpg" alt="review pura user"></div>
                                    </div>
                                    <div class="right">
                                    	<h4>Awesome Expieriences</h4>
                                        <strong>Sanghdeep</strong>
                                        <div class="details">Reviewed <span>13 Jan 2016</span><div class="star-ratings" title=".500"></div></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="rev">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                </div>
                                <div class="more">more</div>
                            </li>                            
                        </ul>
                    </div>
                </div>
                </div>                
            </div>
        </div>
    </section>
    <?php
            $qry_t = "select r.Id,  a.About_Activity_Title, a.Activity_Name, a.About_Activity_Title, a.Icon, a.About_Activity_Description from resorts as r INNER JOIN activities as a ON (r.things_to_do_id REGEXP CONCAT(' ?', a.Id)) where r.Id = $id && a.Status = 1";

            $result_t = $db->_query($qry_t);
    ?>
    <section class="sec-todo">
    	<div class="container">
            <div class="row">
            	<div class="col-sm-4">
                	<div class="brown-bg">
                    	<div class="head">Things to do &nbsp;<span><img src="images/features-icons/things-to-do-icon.png" alt="pura"></span></div>
                        <div class="brown-container">
                        	<div class="brown-content">
                            	<ul>
                                    <?php
                                    while($row_t = mysqli_fetch_array($result_t))
                                    {
                                    ?>
                                	<li>
                                    	<div class="todo">
                                        	<div class="up"><span><img src="<?= $row_t['Icon']; ?>" alt="<?= $row_t['Activity_Name']; ?>"></span> <?= $row_t['Activity_Name']; ?></div>
                                            <div class="down"><?= substr($row_t['About_Activity_Description'], 0, 100); ?></div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                     $qry_nbp = "select n.*, n.Image, n.Title, n.Description from resorts as r INNER JOIN nearbyplaces as n ON (r.nearbyplaces_id REGEXP CONCAT(' ?', n.Id)) where r.Id = $id && n.Status = 1";
                        $result_nbp = $db->_query($qry_nbp);
                ?>
                <div class="col-sm-4">
                	<div class="brown-bg">
                    	<div class="head">Near by places &nbsp;<span><img src="images/features-icons/near-by-places.png" alt="pura"></span></div>
                        <div class="brown-container">
                        	<div class="brown-content">
                            	<ul>
                                <?php
                                    while($row_nbp = mysqli_fetch_array($result_nbp))
                                    {
                                    ?>
                                	<li>
                                    	<div class="places clearfix">
                                        	<div class="left"><img src="<?= $row_nbp['Image']; ?>" alt="<?= $row_nbp['Title']; ?>"></div>
                                            <div class="right"><strong><?= $row_nbp['Title']; ?></strong><?= $row_nbp['Description']; ?> </div>
                                        </div>
                                    </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                	<div class="ideal">
                    	<div class="head">Ideal time &nbsp;<span><img src="images/features-icons/ideal-icon.png" alt="pura"></span></div>
                        <div class="temp">25<sup>&deg; c</sup></div>
                        <div class="grey-container">
                        	<div class="content">
                                <h4>Jim Corbett</h4>
                                <p>Monday, 26 Jan, 2016</p>
                                <p>Partly cloudy</p>
                                <div class="gap10"></div>
                                <p>The best time to visit Jim corbett national park will be from Jan 1<sup>st</sup> to Apr 31<sup>st</sup></p>
                                <div class="gap20"></div>
                                <h4>How to reach?</h4>                                
                                <div class="map"><img src="images/resort-map.jpg" alt="map resort"></div>
                                <table>
                                	<tr>
                                    	<td align="left" class="a">Nearest railway station</td>
                                        <td align="right">Patanagar</td>
                                    </tr>
                                    <tr>
                                    	<td align="left" class="a">Nearest Airport</td>
                                        <td align="right">Ramnagar</td>
                                    </tr>
                                </table>
                            </div>
                    	</div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    
    <section class="sec gallery explore-home">
    	<div class="container">
        	<h2>Gallery</h2>
        </div>    
        <!--div class="gal clearfix">
        	<div class="gal-inner">
                    
               <div class="col-sm-6"><img src="<?= $gallery[0]; ?>" alt="gall"></div>
                <div class="col-sm-3"><img src="<?= $gallery[1]; ?>" alt="gall"></div>
                <div class="col-sm-3"><img src="<?= $gallery[2]; ?>" alt="gall"></div>
                
                <div class="clearfix"></div>
                <div class="col-sm-3"><img src="<?= $gallery[3]; ?>" alt="gall"></div>
                <div class="col-sm-6"><img src="<?= $gallery[4]; ?>" alt="gall"></div>
                <div class="col-sm-3"><img src="<?= $gallery[5]; ?>" alt="gall"></div>
                
                <div class="clearfix"></div>                
                <div class="col-sm-3"><img src="<?= $gallery[6]; ?>" alt="gall"></div>
                <div class="col-sm-3"><img src="<?= $gallery[7]; ?>" alt="gall"></div>
                <div class="col-sm-6"><img src="<?= $gallery[8]; ?>" alt="gall"></div>
	        </div>    
        </div-->      

        <?php
            $gallery =  explode(", ", $row['gallery_id']);
        ?> 
        <div class="sec-container">
                <div class="row">
                    <div class="col-sm-4">
                        <ul id="col1">
                            <li class="large">
                                <img src="<?= $gallery[0]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[0]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $gallery[1]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[1]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>                                        
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul id="col2">
                            <li class="small">
                                <img src="<?= $gallery[2]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[2]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $gallery[3]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[3]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>
                                    </div>                                
                                </div>
                            </li>  
                            <li class="small">
                                <img src="<?= $gallery[4]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[4]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul id="col3">
                            <li class="large">
                                <img src="<?= $gallery[5]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[5]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $gallery[6]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[6]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="roadtrip"></a>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>                    
                </div>
            </div>

    </section>
    
    <section class="sec package">
    	<div class="container">
        	<h2>Packages</h2>
        </div>    
		<div class="two-block">
        	<div class="left-sec package-left">
            	<div class="grey-bg half-blk-txt text-left">
                	<h3>Adventure level</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut lacus eu sem dapibus consectetur eget bibendum nibh. </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut lacus eu sem dapibus consectetur eget bibendum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut lacus eu sem dapibus consectetur eget bibendum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut lacus eu sem dapibus consectetur eget bibendum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut lacus eu sem dapibus consectetur eget bibendum nibh. </p>
                    <ul class="btn-sec package-btn nav-tabs">
                        <?php
                            $qry_sp = "select sp.* from resorts as r INNER JOIN stayprograms as sp ON (r.programs_id REGEXP CONCAT(' ?', sp.Id)) where r.Id = $id && sp.Status = 1";
                            $result_sp = $db->_query($qry_sp);
                            $count = 0;
                            $result_sp1 = array();
                            while($row_sp = mysqli_Fetch_array($result_sp))
                            {
                                $result_sp1[] = $row_sp;
                                if($count==0)
                                    echo '<li class="active"><a data-toggle="tab" href="#home" class="btn btn-default btn-block">'.$row_sp["Program_Title"].' <i class="fa fa-flag-checkered"></i> </a></li>';        
                                else
                                    echo '<li><a data-toggle="tab" href="#menu'.$count.'" class="btn btn-default btn-block">'.$row_sp["Program_Title"].' <i class="fa fa-flag-checkered"></i> </a></li>';

                                $count++;
                            } 
                        ?>
                    </ul>
                </div>
            </div>
            <div class="right-sec">
            	<img src="images/gall/pakage-right-bg.jpg" alt="">
                <div class="tab-content">
                    <?php
                        $count = 0;
                        foreach ($result_sp1 as $key => $value) {

                            ?>
                                <div id="<?php if($count == 0){ echo 'home';} else { echo 'menu'.$count;}?>" class="trans-div half-blk-txt tab-pane fade in <?php if($count == 0){ echo 'active';}?>">
                                    <h3><?= $value['Program_Title']; ?></h3>
                                    <p><?= $value['Program_Details']; ?></p>
                                    <h4>Features</h4>
                                    <ul>
                                    <?php
                                        $Features =  explode("\n", $value['Features']);
                                        foreach ($Features as $key1 => $value1) {
                                            echo ' <li><i class="fa fa-arrow-right"></i> '.$value1.' </li>';        
                                        }
                                    ?>
                                    </ul>
                                    <?php
                                    if($value['Speciality']!="")
                                    {
                                        ?>
                                            <h4>Speciality</h4>
                                            <p><?= $value['Speciality']; ?></p>
                                            <div class="btn-sec text-center">
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-pura">Book now</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                
                            <?php
                            $count++;
                        }
                    ?>
                    
                </div>
            </div>
        </div>                
    </section>
    
    <section class="sec package">
    	<div class="container">
        	<h2>Our Rooms</h2>
        </div>    
		<div class="two-block">        	
            <div class="left-sec">
            	<img src="images/gall/our-room-bg.jpg" alt="">
                <div class="trans-div half-blk-txt">
                	<h3>Our rooms</h3>
                    <p><?= $row['Our_Room_Description']?> </p>
                    <h4>Features</h4>
                    <ul>
                        <?php
                            $Our_Room_Features =  explode("\n", $row['Our_Room_Features']);
                            foreach ($Our_Room_Features as $key => $value) {
                                echo '<li><i class="fa fa-arrow-right"></i>'.$value.' </li>';        
                            }
                        ?>
                    </ul>
                    <?php
                        if($row['Our_Room_Speciality']!="")
                        {
                            ?>
                            <h4>Speciality</h4>
                            <p><?= $row['Our_Room_Speciality']; ?></p>        
                            <?php
                        }
                    ?>
                    
                    <div class="btn-sec text-center">
                    	<a href="javascript:void(0);" class="btn btn-pura">Book now</a>
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
            	<div class="grey-bg">
                	<div class="slider1">
                        <?php
                            $Our_Room_Gallery =  explode(", ", $row['Our_Room_Gallery']);
                            foreach ($Our_Room_Gallery as $key => $value) {
                                echo '<div><img src="'.$value.' " alt=""></div>';
                            }
                        ?>
                    </div>
                    <div id="bx-pager" class="bx-pager">
                        <?php
                            foreach ($Our_Room_Gallery as $key => $value) {
                                echo '<a data-slide-index="'.$key.'" href=""><img src="'.$value.'" alt=""></a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>                
    </section>
    
    <section class="sec package">
    	<div class="container">
        	<h2>Cafe</h2>
        </div>    
		<div class="two-block cafe">        	
            <div class="right-sec package-left">
            	<div class="grey-bg">
                	                    
                </div>
            </div>
            <div class="left-sec">            	
                <div class="trans-div half-blk-txt">
                	<h3><?= $row['Cafe_Title']; ?></h3>
                    <p><?= $row['Cafe_Description']; ?></p>
                    <h4>Features</h4>
                    <ul>
                    <?php
                        $Features =  explode("\n", $row['Cafe_Features']);
                        foreach ($Features as $key1 => $value1) {
                            echo '<li><i class="fa fa-arrow-right"></i> '.$value1.' </li>';
                        }
                    ?>
                    </ul>
                    <?php
                    if($row['Cafe_Speciality']!="")
                        {
                            ?>
                                <h4>Speciality</h4>
                                <p>Lorem ipsum dolor sit amet</p>                    
                            <?php    
                        }
                    ?>
                </div>
            </div>            
        </div>                
    </section>
    
    <section class="sec package">
    	<div class="container">

        	<h2>Testimonial</h2>
            <div class="test-blk">
                    <?php
                        $qry_test = "select * from testimonials where resort_id = $id && Status = 1";
                        $result_test = $db->_query($qry_test);
                        $count = 0;
                        $test_arr = [];

                    ?>

                    <?php
                      while ($row_test = mysqli_Fetch_array($result_test)) {
                            $test_arr[] = $row_test;
                      }

                                ?>
                                    <div class="col-sm-6">
                                    <?php
                                    foreach ($test_arr as $key => $value) {
                                        if($key%2==0)
                                        {
                                        ?>
                                            <div class="testi clearfix">
                                                <div class="testi-inn">
                                                    <p><?= $value['Summary']; ?></p>
                                                </div>
                                                <div class="foot">
                                                    <div class="pic"><img src="<?= $value['User_Image']; ?>" alt="<?= $value['User_Name']; ?>"></div>
                                                    <div class="details">
                                                        <div class="name"><?= $value['User_Name']; ?></div>
                                                        <div class="des">CEO, CORES</div>
                                                    </div>
                                                </div>
                                            </div>      
                                        <?php
                                    }
                                    }
                                    ?>
                                </div>
                                    <div class="col-sm-6">
                                    <?php
                                    foreach ($test_arr as $key => $value) {
                                        if($key%2==1)
                                        {
                                        ?>
                                            <div class="testi clearfix">
                                                <div class="testi-inn">
                                                    <p><?= $value['Summary']; ?></p>
                                                </div>
                                                <div class="foot">
                                                    <div class="pic"><img src="<?= $value['User_Image']; ?>" alt="<?= $value['User_Name']; ?>"></div>
                                                    <div class="details">
                                                        <div class="name"><?= $value['User_Name']; ?></div>
                                                        <div class="des">CEO, CORES</div>
                                                    </div>
                                                </div>
                                            </div>      
                                        <?php
                                    }
                                    }
                                    ?>
                                </div>

                                <?php
                    ?>
                <div class="clearfix"></div>            
             </div>               
        </div>    		               
    </section>
    
    <section class="social-sec">
    	<div class="container">
        	<ul>
            	<li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-google-plus"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
            </ul>
        </div>
    </section>
    
    <footer class="clearfix">
        <div class="container clearfix">
            <div class="col-sm-3 foot-sep">
                <div class="foot-logo"><img src="images/pura-logo-grey.png" alt="pura"></div>
            </div>
            <div class="col-sm-3 foot-sep">
                <div class="foot-in">        
                    <div class="foot-txt"><i class="fa fa-envelope"></i> <a href="mailto:contact@purastays.com">contact@purastays.com</a></div>
                    <div class="foot-txt"><i class="fa fa-phone"></i> <a href="tel:+9112412356789"><span>+91 124 123 567 89</span></a></div>   
                    <div class="gap30"></div>
                    <h4>Corporate office</h4>  
                    <div class="foot-txt">#<span>9</span>, building no. <span>10</span>,<br>cyber city, gurgaon<br>pin - <span>123456</span><br>India</div>   
                </div>    
            </div>
            <div class="col-sm-3 foot-sep">
                <div class="foot-in">
                    <h4>Quick links</h4>  
                    <ul>
                        <li><a href="about.php">About Pura</a></li>
                        <li><a href="javascript:void(0);">For Pura Membership</a></li>
                        <li><a href="javascript:void(0);">free Newsletter</a></li>
                        <li><a href="javascript:void(0);">Travel tips</a></li>
                        <li><a href="javascript:void(0);">Do's and Dont's</a></li>
                        <li><a href="javascript:void(0);">Terms &amp; conditions</a></li>
                        <li><a href="javascript:void(0);">Comfortable Holiday Stay Guarantee</a></li>
                    </ul>  
                </div>
            </div>
            <div class="col-sm-3">
                <div class="foot-in">
                    <h4>Packages</h4>  
                    <ul>
                        <li><a href="javascript:void(0);">Wildlife Getaway</a></li>
                        <li><a href="javascript:void(0);">Snow Holiday</a></li>
                        <li><a href="javascript:void(0);">Adventure Holiday</a></li>
                        <li><a href="javascript:void(0);">Heritage Tour</a></li>
                        <li><a href="javascript:void(0);">Women Holiday</a></li>
                    </ul>
                 </div>   
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <a href="contact.php">contact us</a> | copyright &copy; pura stays. all right reserved
            </div>
        </div>        
    </footer>

    

    <script src="bower_components/jquery/dist/jquery.min.js"></script>   
    <script src="libs/jquery.bxslider.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="bower_components/lightbox2/dist/js/lightbox.min.js"></script>
    <script src="js/common.js"></script>
    <script>
		$(document).ready(function() {
        	$('.slider1').bxSlider({
			  pagerCustom: '#bx-pager', controls: false
			});  

            lightbox.option({
              'resizeDuration': 100,
              'wrapAround': true
            })  
        });    	
    </script>
  </body>
</html>