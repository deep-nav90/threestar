<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Forgot Password</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{url('public/admin/assets/img/logo.png')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{url('public/admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../public/admin/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{url('public/admin/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('public/admin/assets/css/atlantis.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{url('public/admin/assets/css/custom.css')}}">
	<style>
		body {
			background: linear-gradient(0deg, rgba(0,0,0,1) 22%, rgba(145,112,5,1) 100%);
		}

		.alert_mesg, .alert_msg_red {
		    width: 420px;
		    margin-left: 10px;
		     margin-bottom: unset!important; 
		}

	</style>
</head>
<body>

	<div class="container">
		<section class="login_content input_label">
			<form method="POST" id="validate_form">
				{{@csrf_field()}}
				<div class="back_arrow">
                  <a href="{{route('admin.login')}}">
                    <img src="{{url('public/admin/assets/img/back.png')}}" alt="back">
                  </a>
                </div>
				<div class="logo-wrapper"><img src="{{url('public/admin/assets/img/logo.png')}}" alt="logo"/></div>
				<span class="new-life">Forgot Password</span>
				@include('admin.layout.notification')
				<div class="mt_form">
					<div>
						<div class="form-group">
							<label for="" class="pb-1">
								Email Address
							</label>
							<input type="text" class="form-control" name="email" id="email_address" placeholder="Enter Email Address" />

							<label id="email_address-error" class="error" for="email_address" style=""></label>

							@if($errors->first('email'))
							<span class="text-danger error">{{$errors->first('email')}}</span>
							@endif()
						</div>
					</div>
					<div>
<!-- 						<p class="forget">
							<a  href="forgot.html" class="reset_pass to_register">Forgot password?</a>
						</p> -->
						<button class="btn btn-success submit" id="submit_btn">Send</a>
					</div>
				</div>
			</form>
		</section>
	</div>
<!--   Core JS Files   -->
	<script src="{{url('public/admin/assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{url('public/admin/assets/js/core/popper.min.js')}}"></script>
	<script src="{{url('public/admin/assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{url('public/admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{url('public/admin/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{url('public/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{url('public/admin/assets/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{url('public/admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{url('public/admin/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{url('public/admin/assets/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<!-- <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

	<!-- jQuery Vector Maps -->
	<script src="{{url('public/admin/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{url('public/admin/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{url('public/admin/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

	<!-- Atlantis JS -->
	<script src="{{url('public/admin/assets/js/atlantis.min.js')}}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{url('public/admin/assets/js/setting-demo.js')}}"></script>
<!-- 	<script src="../assets/js/demo.js"></script> -->
	<!-- <script>
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});
	</script>	 -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>

 <script type="text/javascript">
    $(document).ready(function(){

    	$("#email_address-error").hide();

    	jQuery.validator.addMethod("valid_email", function(value, element) {
                console.log(value.indexOf("."))
                  if(value.indexOf(".") >= 0 ){
                    return true;
                  }else {
                    return false;
                  }
              }, "Please enter valid email address.");


        $("#validate_form").validate({
            rules : {
                email : {
                    email : true,
                    required : true,
                    valid_email: true
                }
            },
            messages : {
                email : {
                    email : "Please enter valid email address.",
                    required : "Please enter email address."
                }
            },
            submitHandler:function(form){

                $("#submit_btn").attr('disabled', true);



                let email_val = $("#email_address").val();

              	var data = {
                  '_token': "{{csrf_token()}}",
                  'email': email_val,
              	};

              	$.ajax({
                  	url:"{{url('admin/check-exist-email')}}",
                  	type:'POST',
                  	data:data,
                  	success: function(res){
                  		console.log(res);
                    	if(res == 0){
                      		$("#email_address-error").text("Please enter registered email address.").show();
                      		$("#submit_btn").attr("disabled",false);
                        }else{
                          	$("#email_address-error").text("").hide();
                          	form.submit();
                        }
                      },
                      error: function(data, textStatus, xhr) {
                        if(data.status == 422){
                          $("#submit_btn").attr("disabled",false);
                          var result = data.responseJSON;
                        } 
                      }
                });
            }
        });

        });
 </script>


<script>
      
     $(".alert-success").fadeTo(5000, 5000).slideUp(500, function(){
      $(".alert-success").slideUp(500);
    });
         
   </script>

   <script>
      
     $(".alert-danger").fadeTo(5000, 5000).slideUp(500, function(){
      $(".alert-danger").slideUp(500);
    });
         
   </script>

   

 <script type="text/javascript">
        $(document).ready(function(){
          $(".form-control").keyup(function(){
            var length = $.trim($(this).val()).length;
         
             if(length == 0){
               $(this).val("");
             }
          });
        });
    </script>

</body>