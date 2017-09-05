<script src="<?= STATIC_ROOT ?>/js/purastays_experience_module.js"></script>
<?php 
	if(ENV == 'prod') {
		echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9OLokmn9nhBuHYjk_v21oFNuF7tYys9Q&callback=pura_experience.initMap"></script>';
	}	
?>

<script>
      
  $(document).ready(function () {       
    $('.maplink').on('click', function(){    
        $('#mapModal').modal({
            show: 'true'
        });        
        var modalBodyHt = $(window).outerHeight() - 55;
        $('#mapModal .modal-body').height(modalBodyHt);

        })
    })      
</script>