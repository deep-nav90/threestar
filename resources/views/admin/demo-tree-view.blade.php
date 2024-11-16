@extends('admin.layout.layout')
@section('title','Tree View')
@section('content')

<style type="text/css">

.main-panel>.content {

    min-height: unset;
 
}

.tree__container__step__card p {
    
    box-shadow: 0 0 4px 1px rgb(218 169 6);
    background-color: #daa906;
    border-color: #ffffff;
    border: 2px solid #ffffff;
}

body[data-background-color=dark] .main-panel {
    color: rgb(0 0 0) !important;
}

</style>

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.userManagement')}}">User Management</a></li>
								<li class="breadcrumb-item remove_hover">Tree View</li>
								<!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
							</ol>
						</nav>

						@include('admin.layout.notification')
						
					</div>
					<h1>Tree View</h1>

                    

					
				</div>

                
                
			</div>


            <div id="my_tree"></div>
            

		</div>
		


       
@endsection()


@section('js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js" integrity="sha256-vb+6VObiUIaoRuSusdLRWtXs/ewuz62LgVXg2f1ZXGo=" crossorigin="anonymous"></script>


<script type="text/javascript">
    const tree = {
        1: {
            2: '',
            3: {
                6: '',
                7: ''
            },
            4: '',
            8: '',
            9: '',
            10: '',
            11: '',
            12: {
                28: '',
                29: {
                    30: '',
                    31: '',
                    32: {
                        35: '',
                        36: ''
                    },
                    33: '',
                    34: ''
                }
            },
            13: '',
            14: '',
            15: '',
            16: '',
            17: '',
            18: '',
            19: '',
            20: '',
            21: '',
            22: '',
            23: '',
            24: '',
            25: '',
            26: '',
            27: ''
        }
    };

    const params = {
        1: {trad: 'Card 1'},
        2: {trad: 'Card 2'},
        3: {trad: 'Card 3'},
        4: {trad: 'Card 4'},
        5: {trad: 'Card 5'},
        6: {trad: 'Card 6'},
        7: {trad: 'Card 7'},
        9: {trad: 'CARD 9'}
    };

    treeMaker.default(tree, {
        id: 'my_tree',
        card_click: function (element) {
            console.log(element);
        },
        treeParams: params,
        link_width: '4px',
        link_color: '#ffffff',
    });
</script>

@endsection()