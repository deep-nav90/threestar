@extends('admin.layout.layout')
@section('title','Reward Management')
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

button.btn.btn-warning.same_wd_btn.delete {
    background-color: #fa3b3b !important;
    border: #fa3b3b	 !important;
    padding: 8px 0px 10px;
    font-size: 15px;
    letter-spacing: 0.7px;
    width: 129px;
    font-weight: 700;
    height: 47px;
}
	</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item remove_hover">Reward Management</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>
						@include('admin.layout.notification')
					</div>
					<h1>Reward Management</h1>
					<div class="card">
						<div class="card-body">
							
							<div class="add_btn">
								<a href="{{route('admin.addReward')}}">
									<button type="button" class="btn btn-warning same_wd_btn">Add</button>
								</a>
							</div>

							<div class="serch_icon">
								<i class="fas fa-search"></i>
							</div>
							<div class="table-responsive">
								<table style="width:100%" id="rewardList" class="table table-bordered table-hover">
								<thead>
									<tr>
									<th>Sr. No.</th>
									<th>Image</th>
									<th>Name</th>
									<th>Level</th>
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
        <p style="font-size: 18px;">Are you sure you want to delete this reward?</p>
    </div>
      </div>
      <form method="POST" action="{{route('admin.deleteReward')}}" id="deleteForm">
      	{{@csrf_field()}}
      	<input type="hidden" name="reward_id" id="reward_id">
	      <div class="modal-footer">
	      	<button type="button" id="ok" class="btn btn-default" data-dismiss="modal">Ok</button>
	        <button type="button" id="cancel" style="background: #686e86 !important;" class="btn btn-default" data-dismiss="modal">Cancel</button>
	      </div>
  	</form>
    </div>

  </div>
</div>


@endsection()

@section('js')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

		
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

				let reward_id = $(this).attr("ui");
				$("#myModal").modal("show");
				$("#reward_id").val(reward_id);
				$("#myModal").unbind("click");
			});


			$("#cancel").on("click",function(){
				$("#myModal").modal("hide");
			});

			$("#ok").on("click",function(){
        		$("#myModal").modal("hide");
				$("#deleteForm").submit();
			});
		});
	</script>



<script type="text/javascript">

function dataTableHit(dataGET){
      $("#rewardList").dataTable().fnDestroy();
      $('#rewardList').dataTable({
             // /dom: "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('admin.rewardManagement') }}",
                "type": "POST",
                "data" : dataGET,
              complete:function(){

                // if($("#basic-datatables_wrapper").find(".wrap_all").length <= 0){

                //   $('#basic-datatables_info,#basic-datatables_paginate').wrapAll('<div class="wrap_all"></div>'); 
                // }

              }

            },
            createdRow: function( row, data, dataIndex ) {

				$( row ).find('td:eq(1)').attr('data-id', data['id']).attr('key_type','image').addClass('td_click').addClass('white_space');
				$( row ).find('td:eq(2)').attr('data-id', data['id']).attr('key_type','reward_name').addClass('td_click').addClass('white_space');
				$( row ).find('td:eq(3)').attr('data-id', data['id']).attr('key_type','reward_level').addClass('td_click');
				$( row ).find('td:eq(4)').attr('data-id', data['id']).attr('key_type','date_show').addClass('td_click');
			},
            "columns": [
				{data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'defaultImage', name: 'defaultImage', orderable: false, searchable: false, render: function(data, type, row) {
                return `<img src="${data}" alt="Image" style="width: 50px; height: auto;">`;
            	}},
				{data: 'reward_name', name: 'reward_name'},
				{data: 'reward_level', name: 'reward_level'},
				{data: 'date_show', name: 'date_show'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
            ],
 
        });
    }

    $(document).ready(function() {

		let data = {
		'_token': "{{csrf_token()}}",
		}

		dataTableHit(data);

		$(document).on('click','.show-user-advance-options',function(e){
			e.preventDefault();
			$('.advance-options-user').slideToggle();
		});


    });
</script>
@endsection()


