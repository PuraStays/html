<?php
   include_once("includes/db.inc.php");
   $db= new DB();
   $cluster_name = 'Explore Jim Corbett';
   $Cluster_Id = $db->clm_value('Id', 'Title', 'clusters', $cluster_name);
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
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
        vid.oncanplay = function() {
            //alert(vid);
            //bannImg.setAttribute("class", "hide");
            //vid.setAttribute("class", "show");
        };
    </script>
    <!-- Login Modal -->
    <?php include_once("includes/login-modal.php");?>

    <header>
    	<section class="pura-banner">
        	
            <?php include_once("includes/nav.php");?>
            
            <div class="bann-txt-container">
            	<div class="container">
                    <h1>Your holidays, your mood...</h1>
                    <p>Unique travel experiences with a guarantee of a comfortable holiday stay</p>
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
                    	<div class="form-group">
                        	<select class="form-control" name="cluster" id="cluster">
                                <option value="0">where</option>
                                <?php
                                    $db = new DB();
                                    $result = $db->_query("select Id, Title from clusters where Status=1 order by Title ASC");
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['Id'].'">'.$row['Title'].'</option>';          
                                    }
                                ?>
                              </select>
                        </div>
                        <div class="form-group">
                        	<select class="form-control" name="mood" id="mood">
                                <option value="0">mood</option>
                                 <?php
                                    $db = new DB();
                                    $Mood_Id = $db->clm_value('Id', 'Title', 'tags', 'mood');
                                    $result = $db->_query('select Id, Title from tags where CONCAT(",", `Type`, ",") REGEXP ",('.$Mood_Id.'|'.$Mood_Id.')" order by Title ASC');
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['Id'].'">'.$row['Title'].'</option>';          
                                    }
                                ?>
                              </select>
                        </div>
                        <button class="form-control btn btn-pura" onclick="updateResult()">Find</button>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <?php
        $Default_Id = $db->clm_value('Id', 'Title', 'tags', 'default');
        $Gallery_Id = $db->clm_value('Id', 'Title', 'tags', 'gallery');
        
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


        //gallery
        $qry = "select r.Id, i.Image, i.Title, i.Alt, i.Meta, i.Description from resorts as r INNER JOIN images as i ON (r.gallery_id REGEXP CONCAT(' ?', i.Image)) where ";
        if($Cluster_Id!="0") { " r.Id IN ($resorts) && "; }
        //if($Mood_Id!="0") { $qry .= "(find_in_set ('".$Mood_Id."', i.Tags) > 0 || find_in_set (' ".$Mood_Id."', i.Tags) > 0) && "; }
        //$qry .= " ((find_in_set ('".$Portrait."', i.Tags) > 0 || find_in_set (' ".$Portrait."', i.Tags) > 0) ";
        //$qry .= " || (find_in_set ('".$Landscape."', i.Tags) > 0 || find_in_set (' ".$Landscape."', i.Tags) > 0))     ";
        $qry .= " r.Status = 1 order by r.Id DESC limit 7 ";
        //echo $qry;
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
    <section class="sec explore-home">
    	<div class="container">
        	<h2>Explore Jim Corbett</h2>
            <div class="sec-container">
            	<div class="row">
                	<div class="col-sm-4">
                    	<ul id="col1">
                        	<li class="large">
                            	<img src="<?= $row1[1]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                	<div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[1]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[1]['Title']; ?></h4>
                                        <p><?= $row1[1]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>
                        	<li class="large">
                            	<img src="<?= $row1[2]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[2]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[2]['Title']; ?></h4>
                                        <p><?= $row1[2]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                    	<ul id="col2">
                        	<li class="small">
                            	<img src="<?= $row1[3]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[3]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[3]['Title']; ?></h4>
                                        <p><?= $row1[3]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>
                        	<li class="large">
                            	<img src="<?= $row1[4]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[4]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[4]['Title']; ?></h4>
                                        <p><?= $row1[4]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>  
                            <li class="small">
                            	<img src="<?= $row1[5]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[5]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[5]['Title']; ?></h4>
                                        <p><?= $row1[5]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-sm-4">
                    	<ul id="col3">
                        	<li class="large">
                            	<img src="<?= $row1[6]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[6]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[6]['Title']; ?></h4>
                                        <p><?= $row1[6]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>
                        	<li class="large">
                            	<img src="<?= $row1[7]['Image']; ?>" alt="explore pura">
                                <div class="hover">
                                    <div class="txt-blk">
                                        <a href="resort.php?id=<?= $row1[7]['Id']; ?>" class="fa fa-link"></a>
                                        <h4><?= $row1[7]['Title']; ?></h4>
                                        <p><?= $row1[7]['Description']; ?></p>
                                    </div>                                
                                </div>
                            </li>                            
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    
    <section class="sec exp">
    	<div class="container">
        	<h2>Experiences</h2>

            <div class="sec-container">
            	 <?php
                   $qry1 = "select Id,  User_Image, User_Name, Testimonial_For_Image, Testimonial_For_Name, Title, Banner_Title, Banner_Description, Banner_Image, Summary from testimonials where ";
                    if($Cluster_Id!="0") { $qry1 .= " resort_id IN ($resorts) && "; }
                    $qry1 .= " Status = 1 order by Id ASC limit 2";
                    
                    //echo $qry1;
                    $result = $db->_query($qry1);
                    $i=0;
                    $row2 = array();
                    while($row = mysqli_fetch_array($result))
                    {
                        $i++;
                        ?>
                         <div class="exp-block">
                            <div class="img-bg-cont"><img src="images/exp-bg-1.jpg" alt="pura experience"></div>                    
                            <div class="exp-container">
                                <?php
                                    if($i%2!=0)
                                    {
                                        echo '<div class="col-sm-6"></div>';        
                                    }
                                ?>
                                <div class="col-sm-6">
                                    <div class="exp-act-block">                             
                                        <div class="exp-act-title"><h4>Safari with</h4></div>
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
                                            <p><?= $row['Title']?></p>
                                        </div>
                                        <div class="btn-blk">
                                            <a href="story-details.php?stroy=<?= $row['Id']; ?>" class="btn btn-pura2">full story</a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <div class="btn-sec">
                	<a href="stories.php" class="btn btn-lg btn-pura">more stories</a>
                </div>
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


    
  </body>
</html>
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
                var a = res;  
                console.log(res);                  
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
