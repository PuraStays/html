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

<div id="reqCallBack" class="modal animated fade resort selection request-a-callback-dialog" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- Modal content-->
        <div class="modal-body">
            
            <div class="request-callback-content">
                <div class="callback-img-container"><img src="/images/request-a-callback.jpg" alt="purastays" /></div>
                <div class="callback-content-container">
                    <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
                    <h3>Request a callback</h3>
                    <h5>Please fill in the details below, we shall connect with you shortly.</h5>
                    <div class="status-message"></div>
                    <form>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Please enter your name here" name="name">
                            
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Please enter your email id here" name="email">
                            
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile" placeholder="Please enter your mobile number" name="mobile">
                            
                        </div>
                        <input type="submit" class="btn btn-pura" value="send">
                    </form>
                </div>
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
		window.resource.resortList = json;
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

        $('.req_callback').on('click', function() {
            $('#reqCallBack').modal({
                show: 'false'
            });
        })
    })

    var pura = (function() {
        var component = {
            "requestCallBack": jQuery('#reqCallBack'),
            "endpoint": "http://admin.purastays.com:3000/api/web/request_callback"
        }
        
        function reset() {
            var msg = component.requestCallBack.find('.status-message');
            if(msg.text()) {
                if(msg.hasClass('error'))
                    msg.removeClass('error');
                if(msg.hasClass('success'))
                    msg.removeClass('success');

                msg.text("");
            }
        }

        function formatData(data) {
            var updatedData = {};
            data.forEach(function(element) {
              updatedData[element.name] = element.value;
            });
            return updatedData;
        }

        function handleRequestCallback() {
            var form = component.requestCallBack.find('form');
            var btn = component.requestCallBack.find(".btn");
            var errorDiv = '<small class="form-text text-danger error"></small>'; 
            
            form.on('submit', function(e) {
                if(true) {
                    e.preventDefault(); 
                    var data = form.serializeArray();                  
                    $.ajax({
                      type: 'POST',
                      url: component.endpoint,
                      crossDomain: true,
                      data: JSON.stringify(formatData(data)),
                      dataType: "json",
                      headers: { 
                        "Content-type" : "application/json"
                      },
                      success: function(resultData) { 
                        if(resultData.status) {                            
                            component.requestCallBack.find('input[type=text], input[type=email]').val("");
                            component.requestCallBack.find('.status-message').addClass('success').html(resultData.message);
                            setTimeout(function() {
                                $('#reqCallBack').modal('hide');
                                reset();
                            },800)                        
                        }                        
                      }
                    });

                }                
            })            
        }

        function init() {
            handleRequestCallback();
        }

        init();

    })();
    
</script>
