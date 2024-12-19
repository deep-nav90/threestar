<style type="text/css">
    .alert-dismissable .close, .alert-dismissible .close {
    position: relative;
    top: -7px;
    right: -9px;
    color: #000;
    font-size: 35px;
}
.alert_mesg,
.alert_msg_red {
    background-color: #31ce36 !important;
    text-align: center !important;
    color: #fff !important;
    margin-bottom: -33px;
}
.alert_msg_red {
    background-color: #cc3b28 !important;
        border-left: 4px solid #cc3b28 !important;
}
.close_icon {
    height: 30px;
    width: 30px;
    border-radius: 50%;
    padding: 0 !important;
    margin-top: -14px !important;
    font-size: 22px !important;
    line-height: 1 !important;
}
</style>
@if(Session::has('message'))
  <div  class="alert alert-success alert-dismissible text-center alertz alert_mesg">
    <button type="button" class="close close_icon" data-dismiss="alert">×</button>
  {{ Session::get('message') }}</div>
@endif

@if(Session::has('danger'))
  <div class="alert alert-danger alert-dismissible text-center alertz alert_mesg alert_msg_red">
    <button type="button" class="close close_icon" data-dismiss="alert">×</button>
  {{ Session::get('danger') }}</div>
@endif

@if($errors->any())
    <!-- <div class="row alertz" id="alert1">
        <div class="alert alert-danger alert-dismissible fade in text-center">            
            <span>{!! $errors->first() !!}</span>
        </div>
        <div class="clearfix"></div>
    </div> -->
    <!-- <script type="text/javascript">
        $(function() {
            setTimeout(function(){
                $("#alert1").hide();
            }, 5000);
        });
    </script> -->
@endif

@if(Session::has('notification'))
    <div class="row alertz" id="alert2">
        <div class="alert alert-{{ Session::get('notification')['status'] == 'success' ? 'success' : 'danger'}} alert-dismissible fade in text-center">
            <span>{!! Session::get('notification')['message'] !!}</span>
        </div>
        <div class="clearfix"></div>
    </div>

    
@endif



