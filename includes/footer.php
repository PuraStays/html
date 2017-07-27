<?php
   //url-rewrite function
       $qry_url = "select * from url_redirection where Status = 1"; 
       $result_url = $db->_query($qry_url);
       while($row_url = mysqli_fetch_array($result_url))
            $arr_url[$row_url['Old_Url']] = $row_url['New_Url'];
    //end of url-rewrite function

?>

<link href="https://plus.google.com/+PuraStaysGurgaon" rel="publisher" />

<script type="application/ld+json">
	{ 	
		"@context" : "https://schema.org",
		"@type" : "Organization",
		"name" : "Pura Stays",
		"description" : "A travel mood based collection of holiday stays, nature resorts, holiday homes, lodges and villas in travel destinations across India. Discover unique weekend getaways and travel experiences for a refreshing holiday.",
		"url" : "http://www.purastays.com",
		"logo" : "http://www.purastays.com/images/pura-stays-logo.png",
		"email" : "info@purastays.com",
		"telephone" : "+91-901-551-1551",
		"address": {
            "@type" : "PostalAddress",
            "addressCountry" : "IN",
            "addressLocality" : "Gurgaon",          
            "addressRegion" : "Haryana",            
            "postalCode" : "122002",        
            "streetAddress" : "N14/29, Lower Ground Floor, Bougainvillea Marg, DLF Phase 2"
        },
		"sameAs" : [
            "https://www.facebook.com/purastays",
            "https://twitter.com/PuraStays",
            "https://plus.google.com/+PuraStaysGurgaon",
            "https://www.linkedin.com/company/purastays", 
            "https://www.instagram.com/purastays/",
            "https://in.pinterest.com/purastays/"
        ]
	}
</script>

<footer class="clearfix">
    	<div class="container clearfix">
            <div class="col-sm-3 full-ht">
                <div class="foot-in">
                    <h4>Info</h4>  
                    <ul>
                        <li><a href="http://www.purastays.com/about-pura-stays">About Pura Stays</a></li>
                        <li><a href="http://blog.purastays.com" target="_blank">Blog</a></li>
                        <li><a href="http://www.purastays.com/travel-tips">Travel Tips</a></li>
                        <li><a href="http://www.purastays.com/help-faqs">Help/FAQs</a></li>
                        <li><a href="http://www.purastays.com/pura-stays-rollout">Pura Stays Rollout</a></li>
                        <li><a href="http://www.purastays.com/sitemap">Sitemap</a></li>
                        <li><a href="http://www.purastays.com/contact-us">Contact Us</a></li>
                    </ul>  
                </div>
            </div>
            <div class="col-sm-3 full-ht">
            	<div class="foot-in">        
                    <h4>Holiday Stays</h4>  
                    <ul>
                        <?php
                            $db = new DB();
                            $qry_f = "select Id, Resort_Name from resorts where Status = 1 order by Id DESC limit 7";
                            $result_f = $db->_query($qry_f);
                            while($row_f = mysqli_fetch_array($result_f))
                            {
                                $url = 'http://www.purastays.com/resorts/resort.php?id='.$row_f['Id'];
                                $url = $arr_url[$url];
                                
                                    if(strpos($row_f['Resort_Name'], ','))
                                    {
                                ?>

                                    <li><a href="<?= $url; ?>" data-toggle="tooltip" title="<?= $row_f['Resort_Name']; ?>"><?= substr($row_f['Resort_Name'], 0, strrpos($row_f['Resort_Name'],',') );?>
                                    </a></li>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <li><a href="<?= $url; ?>" data-toggle="tooltip" title="<?= $row_f['Resort_Name']; ?>"><?= $row_f['Resort_Name']; ?>
                                    </a></li>
                                    <?php
                                }        
                            }
                        ?>     
                    </ul>                  
                </div>    
            </div>
            <div class="col-sm-6">
            	<div class="row">
                    <div class="col-sm-6">
                        <div class="foot-in">
                            <h4>Connect</h4>  
                            <ul>
                                <li><a href="http://www.purastays.com/travel-tales">Travel Tales</a></li>
                                <li><a href="http://www.purastays.com/post-your-story">Post Your Story</a></li>
                                <li><a href="http://www.purastays.com/post-your-property">Post Your Property</a></li>                                
                            </ul>  
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="foot-in">
                            <h4>Guidelines</h4>  
                            <ul>
                                <li><a href="http://www.purastays.com/guest-policy">Guest Policy</a></li>
                                <li><a href="http://www.purastays.com/terms-conditions">Terms &amp; Conditions</a></li>
                            </ul>  
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="subs">
                            <div class="subs-inn" id="subscribe">
                                <h4>Stay in touch / Hear the latest</h4>
                                        <div class="alert alert-success">
                                          <strong>Info!</strong> Indicates a neutral informative change or action.
                                        </div>
                                <form id="subscribeForm">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">                                                  
                                              <input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="First Name" >
                                            </div>
                                        </div>    
                                        <div class="col-sm-6">
                                            <div class="form-group">                                                
                                              <input type="text" name="LastName" id="LastName" class="form-control" placeholder="Last Name" >
                                            </div> 
                                        </div>    
                                    </div>
                                    
                                    <div class="form-group">                                    
                                      <input type="text" name="Email_Id" id="Email_Id" class="form-control" placeholder="Email id" >
                                    </div>

                                    <div class="form-group">                                    
                                      <input name="submit" id="subscribe_btn" class="btn btn-pura btn-block" value="Subscribe">
                                    </div>                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="copyright">
        	<div class="container">
	        	&copy; 2016 Pura Stays. All rights reserved.
            </div>
        </div>  
        <div class="call_number_container" id="clickCall">
        	<div class="call"><i class="fa fa-phone" aria-hidden="true"></i></div>
        	<div class="num01">
        		<a href="tel:+919015511551">+91 90 1551 1551</a>
        	</div>
        </div>      
    </footer>
    <div class="footer-tools">
        <div class="footer-tools-inner">
            <a href="tel:+919015511551">Call Now</a>
            <a href="javascript:void(0);" class="book_a_stay" data-from="footer">Book a Stay</a>
        </div>
    </div>
