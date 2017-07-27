
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
                                $qry1 = "select Id, Image from features";
                                $result1 = $db->_query($qry1);
                                while($rows1 = $result1->fetch_assoc())
                                    {
                                        $activities_arr[$rows1['Id']] = $rows1['Image'];
                                    }
                                
                                //$activities_arr list of activities 
                                
                                $id = $_REQUEST['id'];
                                $qry = "select * from resorts_rooms where resort_id = $id && Status = 1 order by Position";
                                $result = $db->_query($qry);
                                $i=0;
                                while($rows = $result->fetch_assoc())
                                    {
                                        $i++;
                                        if($i==1)
                                        {
                                            $defalt_room_type_title = $rows['RoomType']; 
                                            $defalt_room_images = explode(", ",$rows['image_id']);
                                        }
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
                                                                <a href="javascript:void(0)" class="btn btn-pura btn-sm pull-right more">more</a>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="list-item-content list-item-content2">
                                                        <ul>
                                                            <?php
                                                                $Specification =  explode("\n", $rows['Specification']);
                                                                foreach ($Specification as $key => $value) {
                                                                    echo '<li>'.$value.' </li>';  
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>     

                                                    <div class="amine">
                                                        <ul>
                                                            <?php
                                                                $feature_id =  explode(", ", $rows['feature_id']);
                                                                foreach ($feature_id as $key => $value) {
                                                                        if($activities_arr[$value]!="")
                                                                            echo '<li><img src="'.$activities_arr[$value].'" alt=""></li>';
                                                                }      
                                                            ?>
                                                        </ul>
                                                        <a href="javascript:void(0)" class="btn btn-pura btn-sm pull-right">less</a>
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
                    <h4><?= $defalt_room_type_title; ?></h4>
                </div>
                <div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery-stay" class="gallery list-unstyled cS-hidden" data-gallery-id = "gallery0">
                        
                        <?php
                            foreach ($defalt_room_images as $key => $value) {
                                if($value!="")
                                    {
                                        ?>
                                        <li data-thumb="<?= $value; ?>"> 
                                                <img src="<?= $value; ?>" />
                                        </li>
                                        <?php
                                    }
                                }
                        ?>
                        
                        </ul>
                    </div>
                </div>
            </div> 
            
        </div>
    </section>


