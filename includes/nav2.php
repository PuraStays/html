<?php
   include_once("includes/db.inc.php");
   $db= new DB();
   $qry = "select * from resorts where Status = 1 order by Id DESC";
   $result = $db->_query($qry);
?>

<?php
   //url-rewrite function
       $qry_url = "select * from url_redirection where Status = 1"; 
       $result_url = $db->_query($qry_url);
       while($row_url = mysqli_fetch_array($result_url))
            $arr_url[$row_url['Old_Url']] = $row_url['New_Url'];
    //end of url-rewrite function
?>



<nav class="navbar navbar-pura2 shrink" data-menutype="<? echo pageType ?>">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="slide-collapse" class="navbar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="http://www.purastays.com/" class="navbar-brand"><img src="http://www.purastays.com/images/logo.png" alt="Pura Stays"></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse slideMenu"> 
          <span class="abs-num">+91 90 1551 1551</span>
          <div class="res-menu-header"></div> 
          <div class="navbar-container">              
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" onclick="return false;">Holiday Stays<b class="caret"></b></a>
                    <div role="menu" class="dropdown-menu"> 
                        <div class="dropdown-inner">   
                            <ul>
                                
                                 <?php
                                        while($row_nev = mysqli_fetch_array($result))
                                        {
                                            $url = 'http://www.purastays.com/resorts/resort.php?id='.$row_nev['Id'];
                                            $url = $arr_url[$url];
                                            ?>
                                                <li><a href="<?= $url; ?>"><i class="fa custom-home"></i><?= $row_nev['Resort_Name'];?></a></li>
                                                <li class="divider"></li>
                                            <?php        
                                        }
                                    ?>
                                
                            </ul>
                        </div>
                    </div>    
                </li>
                <li><a href="http://www.purastays.com/pura-stays-insight">Insight</a></li>                        
                <li><a href="http://blog.purastays.com/" target="_blank">Blog</a></li>
                <?php

                    /*
                    if($_SESSION['login_status']=='login')
                    {
                        echo '<li><a href="http://www.purastays.com/profile">Profile</a></li>    ';
                        echo '<li><a href="http://www.purastays.com/index.php?logout">Sign out</a></li>';        
                    }
                    else
                    {
                        echo '<li><a href="#" onclick="return false;" data-toggle="modal" data-target="#myModal">Sign in</a></li>';        
                    }
                    */
                ?>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="javascript:void(0);" class="book book_a_stay" data-from="menu">Book a Stay</a></li>
            </ul>
         </div>       
       </div>
    </div>
</nav>