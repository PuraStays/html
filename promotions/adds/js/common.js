(function ( $ ) {


    // put all that "wl_alert" code here
    var form = $('.form-float');
    form.width($('aside').width());

    var currentTopVal = form.offset().top + 0;
    function scrollFunction() {
      if($(window).width()>768){
        var scrollPos = document.body.scrollTop;
        if (scrollPos > currentTopVal) {
            document.getElementsByClassName("form-float")[0].style.position = "fixed";
            document.getElementsByClassName("form-float")[0].style.top = "0px";
        } else {
            document.getElementsByClassName("form-float")[0].style.position = "relative";
            document.getElementsByClassName("form-float")[0].style.top = "-66px";
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
  if($(window).width()<768){
    runBxSlider();
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
      }
    }

    $(window).load(function(){
       setImageWidth();
    });
    $(window).resize(function(){
      setImageWidth();
    });

    

}( jQuery ));
