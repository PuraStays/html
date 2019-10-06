(function ( $ ) {
  // put all that "wl_alert" code here
  var form = $('.form-float');
  var currentTopVal = form.offset().top - 40;
  function scrollFunction() {
    if($(window).width()>768){
      // var scrollPos = document.body.scrollTop;
      var scrollPos = document.documentElement.scrollTop || document.body.scrollTop;
      
      var formWid = $('.float-form-container').width();

      document.getElementsByClassName("form-float")[0].style.width = formWid + "px";
      if (scrollPos > currentTopVal) {
          
          document.getElementsByClassName("form-float")[0].style.position = "fixed";
          document.getElementsByClassName("form-float")[0].style.top = "40px";

      } else {
          document.getElementsByClassName("form-float")[0].style.position = "relative";
          document.getElementsByClassName("form-float")[0].style.top = "40px";
      }        
    }  
  }

  


  window.onscroll = scrollFunction;
  
  $(window).resize(function(){
      scrollFunction();
  })
  //var currentTopVal = $('.form-float').position();
  //$('.form-float').css({'position': 'fixed', 'top': '100px', 'right': currentTopVal.right+'px'});
  //console.log($('.form-float').offset().top +100)
  function runBxSlider(){
    $('.bxslider').bxSlider({
      autoControls: true,
      adaptiveHeight: true,
    });
  }


  function setImageWidth(){
         /* fit image to center and bottom */
    if($(document).width()>768){
        $(".gallery-container .gall").each(function(index){
            var parentWid = $(this).width();
            var parentHt = $(this).height();

            var imgWid = $(this).find('img').width();
            var imgHt = $(this).find('img').height();

            /* set image to fit initially */
            if(imgHt > parentHt){ //portrait
                $(this).find('img').css({'height': '100%', 'width': 'auto'});
            }

            var widDiff = imgWid - parentWid;
            var htDiff = imgHt - parentHt;
        })
      } else {
        $(".gallery-container .gall").each(function(index) {});
      }
    }

    $(window).load(function(){
       setImageWidth();
       changeFluid();
    });
    $(window).resize(function(){
      setImageWidth();
      changeFluid();
    });

    function changeFluid() {
      if ($(window).width() > 768) {
        $('.container-fluid').addClass('container').removeClass('container-fluid');
        $('.gallery-container').addClass('desk');
        
      } else {
        $('.container').removeClass('container').addClass('container-fluid');
        $('.gallery-container').removeClass('desk');
        runBxSlider();
      }
    }

}( jQuery ));
