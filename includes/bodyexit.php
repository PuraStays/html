<script>
    $(document).ready(function(){
        var resultObject, bookLink;
        var formTopPosition;
        if($(".floating-window").offset()){
            formTopPosition = $(".floating-window").offset().top;
        }
        
        var menuHeight = 60;
        var formNbr = $(".form-left-sec").outerHeight();
        var formBottomPosition = formTopPosition + formNbr - $(".floating-window").outerHeight();
        var floatingFormWidth = $(".floating-window").width();
        $('.form-right-sec').height(formNbr);

        function searchResult(nameKey, myArray){
            for (var i=0; i < myArray.length; i++) {
                if (myArray[i].resort_id === nameKey) {
                    return myArray[i];
                }
            }
        }

        if (!!resource) {
            //resource page            
            $('a.book_a_stay').bind('click', function() {                
                $('html,body').animate({scrollTop:formTopPosition}, 1000);
            })

            $.getJSON("/data/resort.json", function(json) {
                $(window).scroll(function() {
                    var scroll = $(window).scrollTop() + menuHeight;
                    if(scroll < formTopPosition) {
                        $(".floating-window").css({
                            'position': 'static',
                            'width': floatingFormWidth
                        });
                    } else if (scroll > formTopPosition && scroll <= formBottomPosition) {
                        $(".floating-window").css({
                            'position': 'fixed',
                            'top': '60px',
                            'width': floatingFormWidth
                        });
                    } else {
                        $(".floating-window").css({
                            'position': 'absolute',
                            'bottom': 0,
                            'width': floatingFormWidth,
                            'top': 'auto'
                        });
                    }
                });
                if($(window).width()<768) { //mobile
                    //call popup
                    $('a.book_a_stay').on('click', function(){
                        var select = $('.resort-selection-modal').find('select');
                        select.children().remove();
                        $.getJSON("/data/resort.json", function(json) {
                            select.append("<option value='-1' selected='selected'>Select Resort</option>");
                            $(json).each(function() {                        
                                select.append($("<option>").attr('value',this.resort_id).text(this.resort_name).data('url', this.resort_booking_link));
                            });
                        })
                        var currentUrl;
                        select.on('change', function(){
                            currentUrl = $(this[this.selectedIndex]).data('url');
                        })
                        $('.resort-selection-modal').find('button').on('click', function(){
                            if(!!currentUrl){
                            window.location.href = currentUrl;
                            }
                        })
                        
                        $('#chooseResort').modal({
                            show: 'false'
                        });
                    })
                } else {
                    $('body').animate({scrollTop:formTopPosition}, 1000);
                }
                //resultObject = searchResult(resource.id, json);
                //$('a.book_a_stay').attr('href', resultObject.resort_booking_link);
            });

        } else {
            //for other page
            $('a.book_a_stay').on('click', function(){
                var select = $('.resort-selection-modal').find('select');
                select.children().remove();
                $.getJSON("/data/resort.json", function(json) {
                    select.append("<option value='-1' selected='selected'>Holiday Stays</option>");
                    $(json).each(function() {                        
                        select.append($("<option>").attr('value',this.resort_id).text(this.resort_name).data('url', this.resort_booking_link));
                    });
                })
                var currentUrl;
                select.on('change', function(){
                    currentUrl = $(this[this.selectedIndex]).data('url');
                })
                $('.resort-selection-modal').find('button').on('click', function(){
                    if(!!currentUrl){
                      window.location.href = currentUrl;
                    }
                })
                
                $('#chooseResort').modal({
                    show: 'false'
                });
            })
        }
    })
    
</script>

<div id="chooseResort" class="modal animated fade resort selection" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <!-- Modal content-->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Select a Holiday Stay</h4>
        </div>
        <div class="modal-body">
            <div class="resort-selection-modal">
                <select></select>
                <button type="button" class="btn btn-pura">Book</button>
            </div>
        </div>
    </div>

  </div>
</div>
<style>
    .resort-selection-modal{
        padding: 30px 0;
        display: flex;
    }
    .resort-selection-modal select{
        flex: 1;
        width: 100%;
        margin-right: 10px;
        outline: none;
        border-radius: 0 !important;
    }

</style>