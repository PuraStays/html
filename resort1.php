<?php

$id = $_REQUEST['id'];
if($id=="")
    {
        printf("<script>location.href='index.php'</script>");       
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pura</title>
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link href="css/custom.css" rel="stylesheet">    
    <link href="libs/lightslider-master/dist/css/lightslider.min.css" rel="stylesheet">
    <link href="bower_components/lightbox2/dist/css/lightbox.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="bower_components/jquery/dist/jquery.min.js"></script> 
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9OLokmn9nhBuHYjk_v21oFNuF7tYys9Q&callback=initMap"></script>
    
  </head>
  <body onload="loadPackage()">
    <div class="overlay"><img src="images/loading.gif" alt="pura" height="10"></div>
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
                            /*
                            if(mysqli_num_rows($result_f)==0)
                            {
                                printf("<script>location.href='index.php'</script>");       
                                exit();
                            }
                            */
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
                        <div class="abt-inner">
                            <h4>About <?= $row['About_Resort_Title']; ?></h4>
                            <p>
                                <?= $row['About_Resort_Description']; ?>
                            </p>
                        </div>    
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
                                        <div class="pic trip-advisor"><img src="images/trip-advisor-logo.png" alt="pura trip advisor"></div>
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
                    	<div class="head">Wander &nbsp;<span><img src="images/features-icons/near-by-places.png" alt="pura"></span></div>
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
                    	<div class="head">How to reach &nbsp;<!--span><img src="images/features-icons/ideal-icon.png" alt="pura"></span--></div>
                        <!--div class="temp">25<sup>&deg; c</sup></div-->
                        <div class="grey-container">
                        	<div class="content">
                                <h4>Jim Corbett</h4>
                                <p>Monday, 26 Jan, 2016</p>                                                    
                                <div class="gap20"></div>
                                <h4>How to reach?</h4>
                                <p>you can reach there by road lorem ipsum lorem ipsum, lorem ipsum lorem ipsum dolar isat</p>                                
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
                                <div class="map"><!--img src="images/resort-map.jpg" alt="map resort"--><div id="map"></div></div>
                                
                            </div>
                    	</div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    
    <?php /*?>
    <section class="sec gallery explore-home">
    	<div class="container">
        	<h2>Quick Look</h2>
      
        <?php
            $gallery =  explode(", ", $row['gallery_id']);
        ?> 
        <div class="sec-container">
                <div class="row">
                    <div class="col-sm-4">
                        <ul id="col1" class="gallRow">
                            <li class="large">
                                <img src="<?= $gallery[0]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[0]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $gallery[1]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[1]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>                                        
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul id="col2" class="gallRow">
                            <li class="small">
                                <img src="<?= $gallery[2]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[2]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $gallery[3]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[3]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>
                                    </div>                                
                                </div>
                            </li>  
                            <li class="small">
                                <img src="<?= $gallery[4]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[4]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul id="col3" class="gallRow">
                            <li class="large">
                                <img src="<?= $gallery[5]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[5]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>
                                    </div>                                
                                </div>
                            </li>
                            <li class="large">
                                <img src="<?= $gallery[6]; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="<?= $gallery[6]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall1"></a>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>  
    </section>
    <?pph */?>
    <?php
        $gallery =  explode(", ", $row['gallery_id']);
    ?>

    <section class="sec gallery2 explore-gallery">
        <div class="container">
            <h2>Quick Look</h2>
            <div class="sec-container">
                <div class="galleryNew">
                    <ul>
                        <li class="col-sm-8">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[0]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[0]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[1]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[1]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[2]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[2]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>

                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[3]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[3]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[4]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[4]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[5]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[5]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>

                        <li class="col-sm-8">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[6]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[6]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[7]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[7]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[8]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[8]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
                                    </div>    
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-4">
                            <div class="imgCntnr">
                                <figure>
                                    <img src="<?= $gallery[9]; ?>" alt="">
                                </figure>
                                <div class="hoverImg">
                                    <div class="txtBlk"> 
                                        <a href="<?= $gallery[9]; ?>" class="fa fa-search-plus" aria-hidden="true" data-lightbox="gall2"></a>
                                        <!--<h4>test title</h4>
                                        <p>lorem ipsum dolar isaat lorem ipsum dolar isaat lorem ipsum dolar isaat</p>-->
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
    
    <section class="sec package">
    	<div class="container">
        	<h2>Experience</h2>
        </div>    
		<div class="package-container">
            
                <div class="package-inner">
                    <div class="step step1 step11 left pura-package">
                        <div class="step-innner">
                            <h4>Pura Package title</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <div class="btn-sec"><a href="javascript:void(0);" id="getMood" class="btn btn-pura">What's your mood todays</a></div>
                        </div> 
                                                   
                    </div>
                    <div class="step step1 step12 right pura-moods">
                        <div class="step-innner"  id="mood">
                            <h4>What’s your travel mood</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="lnq-container">
                                <p>we have various programs for your as per your moods, choose one:</p>
                                <ul></ul>
                            </div>
                        </div>     

                        <a class="left resNav" href="javascript:void(0);" id="backToHome">back</a>
                    </div>


                    <div class="step step2 step21 left pura-program">
                        <div class="step-innner" id="program">
                            <h4>Choose below program for your mood <span id="moodTitleStep2"></span></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et</p>
                            <div class="lnq-container">
                                <ul></ul>
                            </div>
                        </div>
                         <a href="javascript:void(0)" class="backlnk" id="backToMood"><< change mood</a>
                         <a class="left resNav" href="javascript:void(0);" id="backToMood">back</a>
                    </div>

                    <div class="step step2 step22 right pura-activity">
                        <div class="step-innner" id="programDetails">
                            <h4>HEALING / DETOX / WELLBEING</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <div class="lnq-container2">
                                <ul></ul>
                            </div>
                        </div>
                        <a class="left yellowbg resNav" href="javascript:void(0);">back</a>
                        <a class="right yellowbg resNav" href="javascript:void(0);">next</a>
                    </div>


                    <div class="step step3 step31 left pura-activity">
                        <div class="step-innner" id="activityDetails">
                            <h4>Yoga details</h4>
                            <!-- <p class="cat">Health<span></span></p> -->
                            <p><span class="t t1">Min - <i>1</i> Hrs</span> <span class="t t2">Min - <i>1</i> Hrs</span></p>
                            <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et</p>
                            
                        </div>
                         <a href="javascript:void(0)" class="backlnk2 backToAct"><< back to activity</a>
                         <a class="left yellowbg resNav" href="javascript:void(0);">back</a>
                         <a class="right yellowbg resNav" href="javascript:void(0);">next</a>
                    </div>

                    <div class="step step3 step32 right pura-gallery">
                        <div class="step-innner" id="activityGallery">
                            <h4>Yoga Gallery</h4>                            
                            <div class="lnq-container3 gal2">
                                <ul>
                                    
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <a class="left resNav" href="javascript:void(0);">back</a>
                    </div>

                </div>
            
        </div>               
    </section>
    
    <section class="sec package">
    	<div class="container">
        	<h2>Stay</h2>
        </div>    
		<div class="two-block">        	
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt">
                        <div class="actual-txt">
                            <p><?= $row['Our_Room_Description']?> </p>
                            <h4>Offering</h4>
                            <ul>
                                <?php
                                    $Our_Room_Features =  explode("\n", $row['Our_Room_Features']);
                                    foreach ($Our_Room_Features as $key => $value) {
                                        echo ''.$value.' </li>';        
                                    }
                                ?>
                            </ul>
                            <?php
                                if($row['Our_Room_Speciality']!="")
                                {
                                    ?>
                                    <h4>Highlights</h4>
                                    <p><?= $row['Our_Room_Speciality']; ?></p>        
                                    <?php
                                }
                            ?>
                            
                            <div class="btn-sec text-center">
                            	<a href="javascript:void(0);" class="btn btn-pura">Book now</a>
                            </div>
                        </div>    
                    </div>
                    <div class="img-cntr">
                        <img src="images/gall/our-room-bg.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
            	<div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                        <?php
                            $Our_Room_Gallery =  explode(", ", $row['Our_Room_Gallery']);
                            foreach ($Our_Room_Gallery as $key => $value) {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" />
                                </li>
                                <?php
                            }
                        ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>                
    </section>


    <section class="sec package">
        <div class="container">
            <h2>Taste</h2>
        </div>    
        <div class="two-block slider-left">  
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt">
                        <div class="actual-txt">
                            <h3>Cafe</h3>
                            <p><?= $row['Cafe_Description']?> </p>
                            <h4>Offering</h4>
                            <ul>
                                <?php
                                    $Cafe_Features =  explode("\n", $row['Cafe_Features']);
                                    foreach ($Cafe_Features as $key => $value) {
                                        echo '<li>'.$value.' </li>';        
                                    }
                                ?>
                            </ul>
                            <?php
                                if($row['Cafe_Speciality']!="")
                                {
                                    ?>
                                    <h4>Highlights</h4>
                                    <p><?= $row['Cafe_Speciality']; ?></p>        
                                    <?php
                                }
                            ?>
                            
                            <div class="btn-sec text-center">
                                <a href="javascript:void(0);" class="btn btn-pura">Book now</a>
                            </div>
                        </div>    
                    </div>
                    <div class="img-cntr">
                        <img src="images/gall/cafe-bg.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="resclearfix"></div>
            <div class="right-sec package-left">
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery2" class="gallery list-unstyled cS-hidden">
                        <?php
                            $Cafe_Gallery =  explode(", ", $row['Cafe_Gallery']);
                            foreach ($Cafe_Gallery as $key => $value) {
                                ?>
                                <li data-thumb="<?= $value;?>"> 
                                    <img src="<?= $value;?>" />
                                 </li>
                                <?php
                            }
                        ?>                            
                        </ul>
                    </div>
                </div>
            </div>       
            
            <div class="clearfix"></div>  
        </div>                
    </section>
    
    
    <section class="sec package">
    	<div class="container">

        	<h2>Travel Arena</h2>
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
                                                    <div class="pic"><figure><img src="<?= $value['User_Image']; ?>" alt="<?= $value['User_Name']; ?>"></figure></div>
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
                                                    <div class="pic"><figure><img src="<?= $value['User_Image']; ?>" alt="<?= $value['User_Name']; ?>"></figure></div>
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
    
    <?php include_once("includes/social-sec.php");?>
    
    
     <style>
        ul{
            list-style: none outside none;
            padding-left: 0;
            margin: 0;
        }
        .demo .item{
            margin-bottom: 60px;
        }
        .content-slider li{
            background-color: #ed3020;
            text-align: center;
            color: #FFF;
        }
        .content-slider h3 {
            margin: 0;
            padding: 70px 0;
        }
        .demo{
            width: 800px;
        }
    </style>
    
    
    <script>
        var resSlider = function(){
            var brWd = $(".two-block").width();
            if(brWd>769){  
                $(".customWd").width(brWd/2);
            }else{
                $(".customWd").width(brWd);                
            }    

            $(".sec-inner").each(function(){
                var hgt = $(this).height();
                $(this).find(".img-cntr img").height(hgt+300);
            })
        }

        $(document).resize(function(){
            resSlider();
        })

         $(document).ready(function() {
            resSlider();
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
            $('#image-gallery2').lightSlider({
                gallery:true,
                item:1,
                thumbItem:7,
                slideMargin: 0,
                speed:1500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery2').removeClass('cS-hidden');
                }  
            });
        });
    </script>


    <?php include_once("includes/footer.php");?>
        
    <script type="text/javascript">
        $(document).ready(function(){
            $(".step.step2,.step.step3").hide(); 
            var totWid = $(window).width();
            if ( totWid > 768 ) {
                $(".gotoprogram").on('click', function(){
                    var currentPrgId = $(this).attr("data-id");
                    $(".step.step1").fadeOut(0);
                    $(".step.step2").fadeIn(500);
                })

                $("#backToMood").on("click", function(){
                    $(".step.step2").fadeOut(0);
                    $(".step.step1").fadeIn(500);
                })

                $(".changeProg").on("click", function(){
                    var currentPrgId = $(this).attr("data-id");
                    console.log(currentPrgId);
                })

                $(".goToDetails").on("click", function(){
                    var currentActId = $(this).attr("data-id");
                    $(".step.step2").fadeOut(0);
                    $(".step.step3").fadeIn(500);
                })

                $(".backToAct").on("click", function(){
                    $(".step.step3").fadeOut(0);
                    $(".step.step2").fadeIn(500);
                })

            } 
        })
    </script>
    <!--script src="libs/jquery.bxslider.min.js"></script-->
    
    <script type="text/javascript" src="bower_components/lightbox2/dist/js/lightbox.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="libs/lightslider-master/dist/js/lightslider.min.js"></script>
    
    <script src="js/common.js"></script>
    <script>
		$(document).ready(function() {

          
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
            
            lightbox.option({
              'resizeDuration': 100,
              'wrapAround': true
            }) 

        });    	
    </script>
    <script>
      function initMap() {
        $('.overlay').fadeIn(500);
        var myLatLng = {lat: <?= $row['Lat']; ?>, lng: <?= $row['Lng']; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Pura'
        });
      }
    </script>
    <script type="text/javascript">
        var loadPackage = function(){
            $('.overlay').fadeIn(500);
            var link = 'http://api.purastays.com/packages/id/' + "<?= $row['programs_id']; ?>";
            console.log(link);
            $.ajax({
              url: link,
              type: "GET",
              dataType: "json",
              success: function (data, status, jqXHR) {
                console.log(data);
                var packageData;            
                var currMoodId;
                var currMoodIndex;
                var currMoodName;
                var programData;
                var currPrgId;
                var currPrgName;
                var currPrgIndex;
                var currPrgDes;
                var activityData;
                var activityIndex;


                packageData = data.moods;
                $.each(packageData, function(index, obj) {
                    var moodHtml = '<a href="javascript:void(0);" class="gotoprogram" data-id="'+obj.Id+'" data-index="'+index+'">'+obj.Title+'</a>';
                    $('#mood ul').append($('<li></li>').html(moodHtml));
                });
                //desktop
                if($(window).width() > 768){
                    $('.gotoprogram').on('click',function(){                                        
                        currMoodId = $(this).attr('data-id');
                        currMoodName = $(this).text();
                        currMoodIndex = $(this).attr('data-index');
                        $('.step.step1').hide();
                        $('.step.step2').fadeIn(500);
                        $('#moodTitleStep2').text(currMoodName);
                        programData = packageData[currMoodIndex].programs;
                        $('#program ul').empty();
                        $.each(programData, function(index, obj) {
                            var programHtml = '<a href="javascript:void(0);" class="changeProg" data-id="'+obj.Id+'" data-index="'+index+'" data-det="'+obj.Program_Details+'">'+obj.Program_Title+'</a>';
                            $('#program ul').append($('<li></li>').html(programHtml));
                        });
                        $('#programDetails h4').text(programData[0].Program_Title);
                        $('#programDetails p').text(programData[0].Program_Details);  
                        $('#programDetails ul').empty();                      
                        $.each(programData[0].activities, function(index, obj) {
                            var programDetHtml = '<a href="javascript:void(0);" class="goToDetails" data-index="'+index+'">'+obj.Activity_Name+'</a>';
                            $('#programDetails ul').append($('<li></li>').html(programDetHtml));
                        });
                        currPrgIndex = 0;
                    })

                    $(document).on('click', '.changeProg', function(){ 
                        $('#programDetails ul').empty();                
                        currPrgId = $(this).attr('data-id');
                        currPrgName = $(this).text();
                        currPrgIndex = $(this).attr('data-index');                        
                        $('#programDetails h4').text(programData[currPrgIndex].Program_Title);
                        $('#programDetails p').text(programData[currPrgIndex].Program_Details); 
                        $.each(programData[currPrgIndex].activities, function(index, obj) {
                            var programDetHtml = '<a href="javascript:void(0);" class="goToDetails" data-index="'+index+'">'+obj.Activity_Name+'</a>';
                            $('#programDetails ul').append($('<li></li>').html(programDetHtml));
                        });                        
                    });
                    $(document).on('click', '.goToDetails', function(){
                        activityIndex = $(this).attr('data-index');
                        activityData = programData[currPrgIndex].activities[activityIndex];       

                        $('.step.step2').hide();
                        $('.step.step3').fadeIn(500);                        
                        $('#activityDetails h4').text(activityData.Activity_Name);
                        $('#activityDetails p.des').text(activityData.About_Activity_Description);
                        $('#activityDetails p .t.t1 i').text(activityData.Min_Time);
                        $('#activityDetails p .t.t2 i').text(activityData.Max_Time);
                        $('#activityGallery h4').text(activityData.Activity_Name);
                        $.each(activityData.gallery, function(index, obj) {                            
                            $('#activityGallery ul').append($('<li><a href="'+obj+'" data-lightbox="package"><img src="'+obj+'" alt=""></a></li>'));
                        });                           

                    });

                }else{ //mobile
                    $('.step12').hide();
                    $('#getMood').on('click', function(){
                        currMoodIndex = $(this).attr('data-index');
                        console.log(currMoodIndex);                        
                        $('.step11').hide();    
                        $('.step12').fadeIn(500);
                    })

                    $('.gotoprogram').on('click',function(){
                        $('.step12').hide();    
                        $('.step21').fadeIn(500);  
                    })


                    $('#backToHome').on('click', function(){
                        $('.step12').hide();    
                        $('.step11').fadeIn(500);                          
                    })
                    $('#backToMood').on('click', function(){
                        alert("hello");
                        $('.step.step21').hide();
                        $('.step.step12').fadeIn(500);
                    })
                }   
              },
              error: function (jqXHR, status, err) {
                console.log(err);
              },
              complete: function (jqXHR, status) {
                $('.overlay').fadeOut(500);
              }
            })
        }
    </script>
  </body>
</html>