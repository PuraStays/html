<section class="sec package">
    	<div class="container">
        	<h2>Stay</h2>
        </div>    
		
		<div class="two-block slider-left">        	
            <div class="left-sec">
                <div class="sec-inner">
                    <div class="trans-div half-blk-txt">
                        <div class="actual-txt">
                            <p><?= $row['Our_Room_Description']?> </p>
                            <h3>Offerings</h3>
                            <ul>
                                <?php
                                    $Our_Room_Features =  explode("\n", $row['Our_Room_Features']);
                                    foreach ($Our_Room_Features as $key => $value) {
                                        echo '<li>'.$value.' </li>';  
                                    }
                                ?>
                            </ul>
                            <?php
                                if($row['Our_Room_Speciality']!="")
                                {
                                    ?>
                                    <h3>Highlights</h3>
                                    <ul>
                                        <?php
                                            $Our_Room_Speciality =  explode("\n", $row['Our_Room_Speciality']);
                                            foreach ($Our_Room_Speciality as $key => $value) {
                                                echo '<li>'.$value.' </li>';        
                                            }
                                        ?>
                                    </ul>
                                    <?php
                                }
                            ?>
                            
                            <div class="btn-sec text-center">
                            	<a href="http://purastays.com/booking/" class="btn btn-pura">Book Now</a>
                            </div>
                        </div>    
                    </div>
                    <div class="img-cntr">
                        <img src="../images/stay.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="right-sec package-left">
            	<div class="grey-bg">
                    <div class="clearfix customWd">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
						<!-- <?php
                            $Our_Room_Gallery =  explode(", ", $row['Our_Room_Gallery']);
							 $Our_Room_Galleryalt =  explode(", ", $row['Our_Room_Galleryalt']);
                            foreach ($Our_Room_Gallery as $key => $value) {
                                ?>
                                <li data-thumb="<?= $value; ?>"> 
                                    <img src="<?= $value; ?>" alt="<?= $Our_Room_Galleryalt[$key]; ?>"/>
                                </li>
                                <?php
                            }
                        ?> -->
                         <?php
                           
                        $qry_nbp = "select * from our_room_gallery where r_id= $id order by r_order Asc";
                        $result_nbp = $db->_query($qry_nbp);
                            while($row_nbp = mysqli_fetch_array($result_nbp))
                            {
                                ?>
                                <li data-thumb="<?= $row_nbp['image']; ?>"> 
                                    <img src="<?= $row_nbp['image']; ?>" alt="<?= $row_nbp['image']; ?>"/>
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