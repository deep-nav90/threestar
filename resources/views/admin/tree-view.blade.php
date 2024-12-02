@extends('admin.layout.layout')
@section('title','Tree View')
@section('content')

<style type="text/css">

.main-panel>.content {

    min-height: unset;
 
}

.tree__container__step__card p {
    
    box-shadow: 0 0 4px 1px rgb(87 180 202);
    background-color: #57b4ca;
    border-color: #ffffff;
    border: 2px solid #ffffff;
}

body[data-background-color=dark] .main-panel {
    color: rgb(0 0 0) !important;
}

div#my_tree {
    padding-left: 1rem;
}

</style>

<input type="hidden" id="arrayTree" arrayTree="{{$underTakeUsers}}">

		<div class="main-panel dashboard_panel">
			<div class="content">
				<div class="page-inner" style="padding-right: 12px;">
					<div class="navbar_bar">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item active"><a href="{{route('admin.userManagement')}}">User Management</a></li>
                                @if($admin->id != $userID)
                                <li class="breadcrumb-item active"><a href="{{route('admin.viewUserDetails',base64_encode($userID))}}">User Details</a></li>
                                @endif()
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


    function buildTreeAndParams(array, tree = {}, params = {}, sequence = { count: 1 }) {
        array.forEach((node) => {
            const currentId = sequence.count; // Generate a sequential ID
            tree[currentId] = {}; // Create an empty object for children
            params[currentId] = { trad: node.userDetail.name + "-" + node.userDetail.custom_user_id + " ("+node.peopleCount+")", name: node.userDetail.custom_user_id, isLevel: node.isLevel }; // Add to params object

            sequence.count++; // Increment the sequence

            // Recursively process children
            if (node.children && node.children.length > 0) {
                buildTreeAndParams(node.children, tree[currentId], params, sequence);
            } else {
                tree[currentId] = ""; // If no children, set value as empty string
            }
        });

        return { tree, params };
    }

    let inputArray = $("#arrayTree").attr("arraytree");
    inputArray = JSON.parse(inputArray)

    const { tree, params } = buildTreeAndParams(inputArray);
    

    // const tree = {
    //     1: {
    //         2: '',
    //         3: {
    //             6: '',
    //             7: ''
    //         },
    //         4: '',
    //         8: '',
    //         9: '',
    //         10: '',
    //         11: '',
    //         12: {
    //             28: '',
    //             29: {
    //                 30: '',
    //                 31: '',
    //                 32: {
    //                     35: '',
    //                     36: ''
    //                 },
    //                 33: '',
    //                 34: ''
    //             }
    //         },
    //         13: '',
    //         14: '',
    //         15: '',
    //         16: '',
    //         17: '',
    //         18: '',
    //         19: '',
    //         20: '',
    //         21: '',
    //         22: '',
    //         23: '',
    //         24: '',
    //         25: '',
    //         26: '',
    //         27: ''
    //     }
    // };

    // const params = {
    //     1: {trad: 'Card 1', name: 'First Card',},
    //     2: {trad: 'abc', name: 'First Card',},
    //     3: {trad: 'Card 3'},
    //     4: {trad: 'Card 4'},
    //     5: {trad: 'Card 5'},
    //     6: {trad: 'Card 6'},
    //     7: {trad: 'Card 7'},
    //     9: {trad: 'CARD 9'}
    // };

    treeMaker.default(tree, {
        id: 'my_tree',
        card_click: function (element) {
            //console.log(element)
            const cardIdString = element.id;  // e.g., "card_2"
            const cardId = cardIdString.split('_')[1];

            const cardData = params[cardId];
            if(cardData) {
                const cardName = cardData.name;
            
                console.log(cardName)
            }
            
            
        },
        treeParams: params,
        link_width: '4px',
        link_color: '#ffffff',
    });


    Object.keys(params).forEach((key) => {
        
        const cardElement = document.getElementById(`card_${key}`);
       // console.log("ssss", cardElement)
        if (cardElement) {
            if(params[key].isLevel) {
                cardElement.setAttribute('title', "Level " + params[key].isLevel + " Completed");
            }
            
        }
    });

</script>

@endsection()