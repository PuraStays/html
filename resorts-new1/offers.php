
<script>
	$(document).ready(function(e) {		
		function openModal(){
      $('#offerModal').modal('show');   
    }
    function closeModal(){
      $('#offerModal').modal('hide');   
    }

		setTimeout(openModal, 4000);     

    $("#popup_btn").on("click", function(){
      var frm = $("#offerForm").serializeArray();
      console.log(frm);
      var email = $("#popup_email").val();
      var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; //email validation pattern
      var error1 = "Please enter your email id";
      var error2 = "Please enter correct email id";
      var error3 = "You are successfully subscribed";  

      var urltxt = "http://api.purastays.com/contactus/offer";    
      //default action
       $("#popup_error").removeClass('alert alert-danger').html(""); 
      if(email == ""){
        $("#popup_error").addClass('alert alert-danger').html(error1);        
      }else{
        console.log(pattern.test(email));
        if(pattern.test(email)){  
          $('.overlay').fadeIn(500);        
          console.log(email);
          var form = $("#offerForm");

          $.ajax({
            contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(form.serializeArray()),
            crossDomain: true,
            url: urltxt,
            success: function(msg){
              $("#popup_error").addClass('alert alert-success').html(error3);
              $('.overlay').fadeOut(500);
              setTimeout(closeModal, 1500);    
            },
            error: function (jqXHR, status, err) {
              $("#popup_error").addClass('alert alert-danger').html(err);
              $('.overlay').fadeOut(500);
            },
            complete: function (jqXHR, status) {
              $('.overlay').fadeOut(500);
            }
          })    
        }else{
          $("#popup_error").addClass('alert alert-danger').html(error2);  
        }
      }
    })
  });
</script>

<?php
  
  date_default_timezone_set('Asia/Kolkata');
  $Date = date('Y-m-d');

  $db = new DB();
  $qry_offer = "select p.* from promotions as p INNER JOIN resorts as r ON (p.Show_Resorts REGEXP CONCAT(' ?', r.Id)) where r.Id = '$id' && p.Status = 1 && Active_From <= '$Date' && Active_To >= '$Date'";
  $result_offer  = $db->_query($qry_offer);
  $row_offer = mysqli_fetch_array($result_offer);
  


  if(mysqli_num_rows($result_offer)>0)
  {

?>

<div id="offerModal" class="modal fade signing" role="dialog">
  <div class="modal-dialog modal-lg offerPopup">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="popup_container">
  		  <div class="popup_image_container"></div>
        <div class="popup_container_inner">
        	 <div class="popup_header popup_padding">
              <h2><?= $row_offer['Title']; ?><sup><sup></h2>
              <a class="close" data-dismiss="modal" aria-label="Close"></a> 
           </div>

           <div class="popup_container_body popup_padding">
              <div class="popup_content">
                <?= $row_offer['Offer'];?>
              </div>
              <p class="condition">*<?= $row_offer['Terms']; ?></p>
           </div>

           <div class="popup_footer popup_padding">
              <form id="offerForm">
                <div class="form-group">
                  <div id="popup_error"></div>
                  <label for="email">Join  "Pura Insider" and stay updated on offers!</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" placeholder="Your email here" id="popup_email" required>
                    <input type="hidden" class="form-control" name="resort" value="<?= $_REQUEST['id']; ?>"  id="popup_resort" required>
                    <input type="hidden" class="form-control" name="offer"  value="<?= $row_offer['Id']; ?>"  id="popup_offer" required>

                    <span class="input-group-btn">
                      <button class="btn btn-pura" type="button" id="popup_btn">Keep me updated</button>
                    </span>
                  </div>
                </div>
              </form>
           </div>           
        </div>
      </div>  
    </div>

  </div>
</div>

<?php
  }
?>