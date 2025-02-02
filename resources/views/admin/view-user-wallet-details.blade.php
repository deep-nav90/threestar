@extends('admin.layout.layout')
@section('title','User Wallet Details')
@section('content')

<style>
	.table-responsive {
    overflow-x: auto; /* Enables horizontal scrolling */
    -webkit-overflow-scrolling: touch; /* Smooth scrolling on touch devices */
}

.table {
    min-width: 100%; /* Ensures the table takes up the minimum width required */
    white-space: nowrap; /* Prevents table cells from wrapping */
}

.my-tree button.btn.btn-warning.same_wd_btn {
    background-color: #ffffff !important;
    border-color: #ffffff !important;
}

.my-tree {
    position: absolute;
    margin-left: 120px;
    cursor: pointer;
}

.btn-tp {
    display: flex
;
}

.withdraw {
    display: flex;
    margin: 20px 0px 0px 20px;
}

.table-responsive.simple_table.ppa {
    margin: 0;
}

button.btn.btn-withdraw {
    color: #ffffff;
    background-color: green;
    font-weight: 600;
    font-size: 16px;
}

button.btn.btn-withdrawRewardBtn {
    color: #000000;
    background-color: #57b4ca;
    font-weight: 600;
    font-size: 16px;
}

.hidden {
  display: none;
}

div#lodaerModal {
    text-align: center;
    top: 50%;
}

label.error {
    color: #ff0000 !important;
    font-size: 100% !important;
    margin-top: 0px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    margin-top: 8px;
}

.select2-container .select2-selection--single {
    height: 46px;
}

span#select2-sponser_id-container {
    padding: .5rem 1rem;
    position: relative;
}
span#select2-upline_id-container {
    padding: .5rem 1rem;
    position: relative;
}

span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    font-weight: 600;
    line-height: 44px;
}


select#filter-wallet {
    display: flex;
    width: 15%;
    position: absolute;
    background-color: #57b4ca;
    color: #000000;
    font-weight: 500;
}

	</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.usersWalletManagement')}}">Users Wallet Management</a></li>
								<li class="breadcrumb-item remove_hover">Users Wallet Details</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>

                    <h1>User Wallet Details</h1>

                    <div class="card">
                      <div class="btn-tp">
                        <div class="withdraw">
                            <a href="javascript:void(0);" id="withdrawBtn">
                              <button type="button" class="btn btn-withdraw">Withdraw Amount</button>
                            </a>

                            
                        </div>

                        <div class="withdraw">
                            

                            <a href="javascript:void(0);" id="withdrawRewardBtn">
                              <button type="button" class="btn btn-withdrawRewardBtn">Withdraw Reward</button>
                            </a>

                        </div>
                      </div>

                        <div class="card-body add_imgae_box">

                        
                            
                            <div class="table-responsive simple_table ppa">
                                <table class="display table table-striped table-hover dataTable" >
                                    <!-- <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th class="text-left">Profile Image</th>
                                            <th>Name</th>
                                            <th>Email Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <tr>
                                            <th>User Name</th>
                                            <td>
                                                {{$userDetails->user_name_with_id}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Tree Amount</th>
                                            <td>
                                                {{$userDetails->tree_amount}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Direct Amount</th>
                                            <td>
                                                {{$userDetails->direct_amount}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Total Credit Amount</th>
                                            <td>
                                                {{$userDetails->total_amount_credit}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Total Extra Profit Amount</th>
                                            <td>
                                                {{$userDetails->total_extra_profit}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Total Debit Amount</th>
                                            <td>
                                                {{$userDetails->total_debit_amount}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Balance Amount</th>
                                            <td>
                                                {{$userDetails->show_balance_amount}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Winnig Rewards</th>
                                            <td>
                                                {{$userDetails->winnig_reward}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Claim Rewards</th>
                                            <td>
                                                {{$countClaimRewards}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Pending Rewards</th>
                                            <td>
                                                {{$userDetails->show_pending_claim}}
                                            </td>
                                        </tr>

                                        

                                        


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



					<h1>Wallet listing</h1>
					<div class="card">
						<div class="card-body">

              <div class="filter-select">
								<select id="filter-wallet" class="form-control form-group" placeholder="Select Filter By List">
									<option value="">All</option>
									<option value="By Tree">Tree Amount</option>
									<option value="By Sponser">Direct Amount</option>
									<option value="Extra Profit">Extra Profit</option>
									<option value="By Debit">Debit Amount</option>
										
								</select>

							</div>
							

							<div class="serch_icon">
								<i class="fas fa-search"></i>
							</div>
							<div class="table-responsive">
								<table style="width:100%" id="userList" class="table table-bordered table-hover">
								<thead>
									<tr>
									<th>Sr. No.</th>
									<th>Upline User</th>
									<th>Under User</th>
									<th>Percentage/Flat</th>
									<!-- <th>Total Amount</th> -->
                                    <th>Credit Amount</th>
                                    <th>Debit Amount</th>
									<th>Created At</th>

									<!-- <th>Action</th> -->

									</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>

						</div>
					</div>




          <h1>Claim listing</h1>
					<div class="card">
						<div class="card-body">
						
							<div class="serch_icon">
								<i class="fas fa-search"></i>
							</div>
							<div class="table-responsive">
								<table style="width:100%" id="rewardList" class="table table-bordered table-hover">
								<thead>
									<tr>
									<th>Sr. No.</th>
                  <th>Image</th>
                  <th>Reward Name</th>
									<th>User Name</th>
									<th>Created At</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>

						</div>
					</div>


				</div>
			</div>
		</div>




<div class="modal fade" id="lodaerModal" tabindex="-1" role="dialog" aria-labelledby="lodaerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     
      <img src="{{url('public/loading-buffering.gif')}}" style="width: 50px; height:50px;">
     
  </div>
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #57b4ca">
<!--         <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->
 <div class="text-center" style="width: 100%;">       
  <h4 class="modal-title" style="font-size: 18px; color: #fff;">Alert</h4>
</div>
      </div>
      <div class="modal-body">
      	<div class="text-center">
        <p style="font-size: 18px;">Are you sure you want to delete this user?</p>
    </div>
      </div>
      <form method="POST" action="{{route('admin.deleteUser')}}" id="deleteForm">
      	{{@csrf_field()}}
      	<input type="hidden" name="user_id" id="user_id">
	      <div class="modal-footer">
	      	<button type="button" id="ok" class="btn btn-default" data-dismiss="modal">Ok</button>
	        <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
	      </div>
  	</form>
    </div>

  </div>
</div>


<div id="withDrawModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #57b4ca">
<!--         <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->
 <div class="text-center" style="width: 100%;">       
  <h4 class="modal-title" style="font-size: 18px; color: #000000; font-weight:600">Withdraw Amount</h4>
</div>
      </div>
      <div class="modal-body">

      <div class="row">
										<!-- Name Field -->
          <div class="col-md-12">
            <label for="amount" style="font-weight:600;" class="pb-1">Amount</label>
            <span class="artisan-star">*</span>
            <div class="form-group p-0">
              <input style="background-color:#ffffff; border-color: #2f374b!important" id="amount" min="1" oncopy="return false;" oncut="return false;" onpaste="return false;" onkeypress="return isNumeric(event)"  type="number" class="form-control" placeholder="Enter Amount" name="amount">
              <label id="withdrawAmount-error" class="error hidden" for="withdrawAmount">Please enter amount.</label>
            </div>
          </div>

									
								
        </div>
      	
      </div>

      <div class="modal-footer">
        <button type="button" id="submitWithdraw" class="btn btn-danger" style="background-color: #57b4ca!important; border-color:#57b4ca!important;     color: #000000;
    font-weight: 600;" data-bs-dismiss="modal">Withdraw</button>
        <button type="button" id="cancelBtn" class="btn btn-danger" style="background-color: #575962 !important;
    border-color: #575962 !important; font-weight:600" data-bs-dismiss="modal">Cancel</button>
      </div>

      
    </div>

  </div>
</div>




<!-- REWARD MODAL -->

<div id="withDrawRewardModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #57b4ca">
<!--         <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->
 <div class="text-center" style="width: 100%;">       
  <h4 class="modal-title" style="font-size: 18px; color: #000000; font-weight:600">Withdraw Reward</h4>
</div>
      </div>
      <div class="modal-body">

      <div class="row">
										<!-- Name Field -->
          <div class="col-md-12">
            <label for="withdrawReward" style="font-weight:600;" class="pb-1">Rewards</label>
            <span class="artisan-star">*</span>
            <div class="form-group p-0">
                <select id="reward_id" class="form-control form-group select2" style="padding: .6rem 1rem; position: relative;"  placeholder="Select Reward">
                  <option value="">Select Reward</option>
                      
                  @foreach($rewards as $reward)
                  
                  <option value="{{$reward->id}}">{{$reward->reward_name}}</option>
                  
                  
                  @endforeach()
                      
                </select>
              <label id="withdrawReward-error" class="error hidden" for="withdrawReward">Please select reward.</label>
            </div>
          </div>

									
								
        </div>
      	
      </div>

      <div class="modal-footer">
        <button type="button" id="submitWithdrawReward" class="btn btn-danger" style="background-color: #57b4ca!important; border-color:#57b4ca!important;     color: #000000;
    font-weight: 600;" data-bs-dismiss="modal">Withdraw</button>
        <button type="button" id="cancelBtnReward" class="btn btn-danger" style="background-color: #575962 !important;
    border-color: #575962 !important; font-weight:600" data-bs-dismiss="modal">Cancel</button>
      </div>

      
    </div>

  </div>
</div>


<!-- ALERT MODAL -->

<div id="alertModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #57b4ca">
<!--         <button type="button" class="close" data-dismiss="modal">&times;</button>
 -->
 <div class="text-center" style="width: 100%;">       
  <h4 class="modal-title" style="font-size: 18px; color: #fff;">Alert</h4>
</div>
      </div>
      <div class="modal-body">
      	<div class="text-center">
        <p style="font-size: 18px;" id="alert_message"></p>
    </div>
      </div>
	      <div class="modal-footer">
	      	<button type="button" id="okAlert" class="btn btn-default" data-dismiss="modal">Ok</button>
	      </div>
  	
    </div>

  </div>
</div>


@endsection()

@section('js')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		
	<script>
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
	</script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>


	<script type="text/javascript">
		$(document).ready(function(){

			$(document).on("click",".delete",function(){

				let user_id = $(this).attr("ui");
				$("#myModal").modal("show");
				$("#user_id").val(user_id);
				$("#myModal").unbind("click");
			});


			$("#cancel").on("click",function(){
				$("#myModal").modal("hide");
			});

			$("#ok").on("click",function(){
        $("#myModal").modal("hide");
				//$("#deleteForm").submit();
			});
		});
	</script>



<script type="text/javascript">

    function dataTableHit(dataGET){
      $("#userList").dataTable().fnDestroy();
      $('#userList').dataTable({
             // /dom: "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('admin.usersViewWalletDetails', $encodeID) }}",
                "type": "POST",
                "data" : dataGET,
              complete:function(){

                // if($("#basic-datatables_wrapper").find(".wrap_all").length <= 0){

                //   $('#basic-datatables_info,#basic-datatables_paginate').wrapAll('<div class="wrap_all"></div>'); 
                // }

              }

            },
            createdRow: function( row, data, dataIndex ) {

              $( row ).find('td:eq(1)').attr('data-id', data['id']).attr('key_type','upline_user_id_with_name').addClass('td_click').addClass('white_space');
              $( row ).find('td:eq(2)').attr('data-id', data['id']).attr('key_type','under_user_id_with_name').addClass('td_click').addClass('white_space');
              $( row ).find('td:eq(3)').attr('data-id', data['id']).attr('key_type','percentag_or_flat_amount').addClass('td_click');
              //$( row ).find('td:eq(4)').attr('data-id', data['id']).attr('key_type','total_amount_in_rupees').addClass('td_click');
              $( row ).find('td:eq(4)').attr('data-id', data['id']).attr('key_type','credit_user_amount_in_rupees').addClass('td_click');
              $( row ).find('td:eq(5)').attr('data-id', data['id']).attr('key_type','debit_amount_show').addClass('td_click');
			        $( row ).find('td:eq(6)').attr('data-id', data['id']).attr('key_type','date_show').addClass('td_click');
			},
            "columns": [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'upline_user_id_with_name', name: 'upline_user_id_with_name'},
              {data: 'under_user_id_with_name', name: 'name'},
              {data: 'percentag_or_flat_amount', name: 'percentag_or_flat_amount'},
              //{data: 'total_amount_in_rupees', name: 'total_amount_in_rupees'},
			        {data: 'credit_user_amount_in_rupees', name: 'credit_user_amount_in_rupees'},
              {data: 'debit_amount_show', name: 'debit_amount_show'},
              {data: 'date_show', name: 'date_show'},
              //{data: 'action', name: 'action', orderable: false, searchable: false},
            ],
 
        });
    }

    $(document).ready(function() {
  
          let user_status = $("#user_status").val();
          let user_type = $("#user_type").val();

          let data = {
            '_token': "{{csrf_token()}}",
            'user_status' : user_status,
            'user_type' : user_type
          }

          dataTableHit(data);


          $(".apply-filter").on("click",function(){

            let __user_status = $("#user_status").val();
            let __user_type= $("#user_type").val();

            let __data = {
              '_token': "{{csrf_token()}}",
              'user_status' : __user_status,
              'user_type' : __user_type
            }

            
            dataTableHit(__data);

          });

          $("#filter-wallet").on("change", function() {
            let val = $(this).val();
            let ____user_status = $("#user_status").val();
            let ____user_type = $("#user_type").val();
            let ____data = {
              '_token': "{{csrf_token()}}",
              'user_status' : ____user_status,
              'user_type' : ____user_type,
              'type_of_credit' : val
            }

            dataTableHit(____data);
          })

          $(".reset-button").on("click",function(){

            $("#user_status").val("");
            $("#user_type").val("");

            let ____user_status = $("#user_status").val();
            let ____user_type = $("#user_type").val();

            let ____data = {
              '_token': "{{csrf_token()}}",
              'user_status' : ____user_status,
              'user_type' : ____user_type
            }

            
            dataTableHit(____data);

          });




      

    $(document).on('click','.show-user-advance-options',function(e){
        e.preventDefault();
        $('.advance-options-user').slideToggle();
      });



      $("#withdrawBtn").on("click", function(){

        $("#withDrawModal").modal({
          backdrop: 'static', // Prevent closing on outside click
          keyboard: false     // Optional: Prevent closing on "Escape" key press
        });
        $("#withDrawModal").modal("show");
      })

      $("#cancelBtn").on("click", function() {
        $("#withDrawModal").modal("hide");
      })

      $("#submitWithdraw").on("click", function() {
        if($('#amount').val().trim()) {
          $("#withdrawAmount-error").addClass("hidden");
        }else{
          $("#withdrawAmount-error").removeClass("hidden");
          return false;
        }

        if(parseFloat($('#amount').val()) <= 0) {
          alert("Amount should be greater than 0.");
          return false;
        }

        var dataPayload = {
          '_token': "{{csrf_token()}}",
          'encodeID': "{{$encodeID}}",
          'amount' : $("#amount").val().trim()
        };
        $("#lodaerModal").modal("show");
        $.ajax({
					url: "{{url('admin/debit-wallet-amount')}}",
					type:'POST',
					data:dataPayload,
					success: function(res){
            console.log("TRTTTTTTTTTTTT",res);
            $("#withDrawModal").modal("hide");
						
						setTimeout(() => {

              if(res.status == "success") {
               // alert(res.message)

                // $("#alertModel").modal("show");
                // $("#alert_message").text(res.message);
                // $("#alertModel").unbind("click");
                window.location.href="";

                 
              }else{
               // alert(res.message);

                $("#alertModel").modal("show");
                $("#alert_message").text(res.message);
                $("#alertModel").unbind("click");
                  
              }

							$("#lodaerModal").modal("hide");
						}, 500);
						
					},
					error: function(data, textStatus, xhr) {
					if(data.status == 422){
            $("#withDrawModal").modal("hide");
						setTimeout(() => {
							$("#lodaerModal").modal("hide");
						}, 500);
						var result = data.responseJSON;

            $("#alertModel").modal("show");
            $("#alert_message").text("Something went wrong");
            $("#alertModel").unbind("click");
						//alert('Something went worng.');
						
						return false;
					} 
					}
				});

        
        
      })


      $("#amount").on("keyup", function(){
        if($(this).val().trim()) {
          $("#withdrawAmount-error").addClass("hidden");
        }else{
          $("#withdrawAmount-error").removeClass("hidden");
        }
      })




      //reward case
      $('.select2').select2();

      $("#withdrawRewardBtn").on("click", function (){

        let pendingReward = "{{$userDetails->show_pending_claim}}";
        
        if(parseInt(pendingReward) <= 0) {
          $("#alertModel").modal("show");
          $("#alert_message").text("You have no rewards.");
          $("#alertModel").unbind("click");
          return false;
        }

        $("#withDrawRewardModal").modal({
          backdrop: 'static', // Prevent closing on outside click
          keyboard: false     // Optional: Prevent closing on "Escape" key press
        });

        $("#withDrawRewardModal").modal("show");
      })

      $("#cancelBtnReward").on("click", function() {
        $("#withDrawRewardModal").modal("hide");
      })

      $("#reward_id").on("change", function(){
        if($(this).val().trim()) {
          $("#withdrawReward-error").addClass("hidden");
        }else{
          $("#withdrawReward-error").removeClass("hidden");
        }
      })

      $("#submitWithdrawReward").on("click", function() {
        let rewardID = $("#reward_id").val();
        let encodeRewardID = btoa(rewardID);

        if(rewardID) {
          $("#withdrawReward-error").addClass("hidden");
        }else{
          $("#withdrawReward-error").removeClass("hidden");
          return false;
        }

        var dataPayload = {
          '_token': "{{csrf_token()}}",
          'encodeRewardID': encodeRewardID,
          'encodeUserId' : "{{$encodeID}}"
        };
        $("#lodaerModal").modal("show");

        $.ajax({
					url: "{{url('admin/reward-claim')}}",
					type:'POST',
					data:dataPayload,
					success: function(res){
            console.log("TRTTTTTTTTTTTT",res);
            $("#withDrawRewardModal").modal("hide");
						
						setTimeout(() => {

              if(res.status == "success") {
                //alert(res.message)

                // $("#alertModel").modal("show");
                // $("#alert_message").text(res.message);
                // $("#alertModel").unbind("click");
                window.location.href="";

                 
              }else{
                //alert(res.message);

                $("#alertModel").modal("show");
                $("#alert_message").text(res.message);
                $("#alertModel").unbind("click");

                  
              }
              $("#lodaerModal").modal("hide");
							$("#withDrawRewardModal").modal("hide");
						}, 500);
						
					},
					error: function(data, textStatus, xhr) {
					if(data.status == 422){
            $("#withDrawRewardModal").modal("hide");
						setTimeout(() => {
							$("#lodaerModal").modal("hide");
						}, 500);
						var result = data.responseJSON;

            $("#alertModel").modal("show");
            $("#alert_message").text("Something went wrong");
            $("#alertModel").unbind("click");

						//alert('Something went worng.');
						
						return false;
					} 
					}
				});
      })

      $("#okAlert").on("click", function() {
      
        $("#alertModel").modal("hide"); 
      })

    });

    function isNumeric(event) {
        const char = String.fromCharCode(event.which);
        if (!/[\d.]/.test(char)) {
            return false;
        }
        return true;
    }

      </script>




<script>
  function dataTableHitClaimRewards(dataGET){
      $("#rewardList").dataTable().fnDestroy();
      $('#rewardList').dataTable({
             // /dom: "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('admin.claimRecordListByID') }}",
                "type": "POST",
                "data" : dataGET,
              complete:function(){

                // if($("#basic-datatables_wrapper").find(".wrap_all").length <= 0){

                //   $('#basic-datatables_info,#basic-datatables_paginate').wrapAll('<div class="wrap_all"></div>'); 
                // }

              }

            },
            createdRow: function( row, data, dataIndex ) {

                $( row ).find('td:eq(1)').attr('data-id', data['id']).attr('key_type','defaultImage').addClass('td_click');
                $( row ).find('td:eq(2)').attr('data-id', data['id']).attr('key_type','reward_name').addClass('td_click').addClass('white_space');
				$( row ).find('td:eq(3)').attr('data-id', data['id']).attr('key_type','user_name').addClass('td_click').addClass('white_space');
				
				$( row ).find('td:eq(4)').attr('data-id', data['id']).attr('key_type','date_show').addClass('td_click');
			},
            "columns": [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'defaultImage', name: 'defaultImage', orderable: false, searchable: false, render: function(data, type, row) {
                return `<img src="${data}" alt="Image" style="width: 50px; height: auto;">`;
            	}},
                {data: 'reward_name', name: 'reward_name'},
				{data: 'user_name', name: 'user_name'},
				{data: 'date_show', name: 'date_show'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
            ],
 
        });
    }

    $(document).ready(function() {

      let data = {
      '_token': "{{csrf_token()}}",
      'encodeUserId' : "{{$encodeID}}"
      }

      dataTableHitClaimRewards(data);



      });
</script>
@endsection()


