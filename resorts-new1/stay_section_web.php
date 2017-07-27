<section class="sec package">
    	<div class="container">
        	<h2>Stay</h2>
        </div>

		<div class="two-block slider-left stay-parent">
            <div class="left-sec stay-list">
                <div class="sec-inner">
                    <div class="trans-div">
                        <div class="list-container" id="stay-container">
                            
                            <?php
                                $id = $_REQUEST['id'];
                                $qry = "select * from resorts_rooms where resort_id = $id && Status = 1 order by Position";
                                $result = $db->_query($qry);
                                $i=0;

                                while($rows = $result->fetch_assoc())
                                    {
                                        $i++;
                                        ?>
                                            <!-- list item start -->
                                                <div class="list-item" data-id="<?=$rows['Id']; ?>">
                                                    <div class="list-item-content">
                                                        <figure>
                                                            <?php
                                                                $room_images = explode(", ",$rows['image_id']);
                                                            ?>
                                                            <img src="<?= $room_images[0]; ?>" alt="gall<?= $i; ?>">
                                                               <a href="<?= $room_images[0]; ?>" class="open-gallery" aria-hidden="true" data-lightbox="gall<?=$i; ?>"><span class="glyphicon glyphicon-picture"></span></a>
                                                                <?php
                                                                    foreach ($room_images as $key => $value) {
                                                                        if($value!="")
                                                                        {
                                                                        ?>
                                                                            <a href="<?= $value; ?>" class="open-gallery not-visible" aria-hidden="true" data-lightbox="gall<?= $i; ?>"></a>
                                                                        <?php        
                                                                        }
                                                                    }
                                                                ?>
                                                             
                                                        </figure>
                                                        <div class="list-item-detail">
                                                            <h4><?= $rows['RoomType'];?></h4>
                                                            <p><?= $rows['Description'];?></p>
                                                            <div>
                                                                <a href="javascript:void(0)" class="btn btn-default btn-sm pull-right more">more</a>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="list-item-content list-item-content2">
                                                        <ul>
                                                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</li>
                                                            <li>Lorem ipsum dolor sit amet, consectetur </li>
                                                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, adipiscing elit,</li>
                                                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</li>
                                                            <li>Lorem ipsum dolor sit amet, consectetur </li>
                                                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, adipiscing elit,</li>
                                                        </ul>
                                                    </div>     

                                                    <div class="amine">
                                                        <ul>
                                                            <li><img src="../images/icons/meal.png" alt=""></li>
                                                            <li><img src="../images/icons/telephone.png" alt=""></li>
                                                            <li><img src="../images/icons/tv.png" alt=""></li>
                                                        </ul>
                                                        <a href="javascript:void(0)" class="btn btn-default btn-sm pull-right">less</a>
                                                    </div>                           
                                                </div>
                                                <!-- list item ends -->
                                        <?php
                                    }

                            ?>
                            
                        </div>
                    </div>
                    <div class="img-cntr"></div>
                </div>
            </div>

            <div class="resclearfix"></div>
            <div class="right-sec package-left stay-gallery">
                <div class="galleryTitle">
                    <h4>Sample Title</h4>
                </div>
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery-stay" class="gallery list-unstyled cS-hidden" data-gallery-id = "gallery0">
                        
                            <li data-thumb="gall1.jpg"> 
                                <img src="gall1.jpg" />
                            </li>
                            <li data-thumb="gall1.jpg"> 
                                <img src="gall1.jpg" />
                            </li>
                            <li data-thumb="gall1.jpg"> 
                                <img src="gall1.jpg" />
                            </li>
                            <li data-thumb="gall1.jpg"> 
                                <img src="gall1.jpg" />
                            </li>
                            <li data-thumb="gall1.jpg"> 
                                <img src="gall1.jpg" />
                            </li>                                          
                        </ul>
                    </div>
                </div>
            </div> 
            
        </div>
    </section>