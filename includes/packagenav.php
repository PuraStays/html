<?php
   include_once("includes/db.inc.php");
   $db= new DB();
   $qry = "select * from resorts where Status = 1 order by Resort_Name ASC";
   $result = $db->_query($qry);
?>

<nav role="navigation" class="navbar navbar-pura navbar-pura1">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand"><img src="images/logo.png" alt="Pura Stays"></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">                    
        <ul class="nav navbar-nav navbar-right">_
            <li class="active"><a href="booking/" class="book">Book a Stay</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Holiday Stays<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <?php
                        while($row_nev = mysqli_fetch_array($result))
                        {
                            ?>
                                <li><a href="resort.php?id=<?= $row_nev['Id'];?>"><i class="fa custom-home"></i><?= $row_nev['Resort_Name'];?></a></li>
                                <li class="divider"></li>
                            <?php        
                        }
                    ?>
                    
                </ul>
            </li>
            <li><a href="concepts.php">Insight</a></li>                        
            <li><a href="http://blog.purastays.com/" target="_blank">Blog</a></li>
            <?php

                
                if($_SESSION['login_status']=='login')
                {
                    echo '<li><a href="profile.php">Profile</a></li>    ';
                    echo '<li><a href="http://purastays.com/index.php?logout">Sign out</a></li>';        
                }
                else
                {
                    echo '<li><a href="#" onclick="return fasle;" data-toggle="modal" data-target="#myModal">Sign in</a></li>';        
                }

            ?>
            
        </ul>
    </div>
    </div>
</nav>