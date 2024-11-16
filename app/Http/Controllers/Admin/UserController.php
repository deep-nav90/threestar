<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);


use App\Http\Controllers\Api\v1\ResponseController;

use App\Models\User;
use App\Models\AdminManage;
use Session;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\UnderTakeUser;
use Hash;
class UserController extends ResponseController
{

    protected $adminManage;

    public function __construct(AdminManage $adminManage){
        $this->adminManage = $adminManage;
    }

    public function login(Request $request) {
        if($request->isMethod('GET')) {
            return view('admin.login');
        }

        if($request->isMethod('POST')) {
            $data = $request->all();

            $Validator = $this->is_validationRuleWeb(User::loginValidation(), $request);

            if(!empty($Validator)){
                return $Validator;
            }

            $login = User::login($request);

            if($login == 1){
                return redirect(route('admin.dashboard'));
            }else{
                Session::flash('danger','Please enter valid mobile number or password.');
                return back();
            }
        }
    }

    public function dashboard(Request $request) {
        return view('admin.index');
    }

    public function userManagement(Request $request) {
        if($request->isMethod('GET')) {
            $admin = auth()->guard('admin')->user();
            return view('admin.user-management', compact('admin'));
        }

        if($request->isMethod('POST')) {
            $admin = auth()->guard('admin')->user();
            $column = "id";
            $asc_desc = $request->get("order")[0]['dir'];

            if($asc_desc == "asc"){
                $asc_desc = "desc";
            }else{
                $asc_desc = "asc";
            }

            $order = $request->get("order")[0]['column'];
            if($order == 0){
                $column = "id";
            }elseif($order == 1){
                $column = "custom_user_id";
            }elseif($order == 2){
                $column = "name";
            }elseif($order == 3){
                $column = "dob";
            }elseif($order == 4){
                $column = "mobile_number";
            }



            

            //all user in superadmin case to show
            $data = User::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('(CASE WHEN is_block = 0 THEN "Unblock" ELSE "Block" END) AS is_block'), DB::raw('DATE_FORMAT(dob, "%d-%M-%Y") AS dob_show'), DB::raw('CONCAT(country_code, " ", mobile_number) AS complete_mobile_number'))->whereDeletedAt(null)->where('id', '!=', $admin->id)->orderBy($column,$asc_desc);

            if($admin->is_super_admin == 0) {
                $underTakeUsersIds = UnderTakeUser::whereDeletedAt(null)->whereSponserId($admin->id)->pluck('user_id');
                $underTakeUsersIds2 = UnderTakeUser::whereDeletedAt(null)->whereUplineId($admin->id)->pluck('user_id');
                $data = User::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('(CASE WHEN is_block = 0 THEN "Unblock" ELSE "Block" END) AS is_block'), DB::raw('DATE_FORMAT(dob, "%d-%M-%Y") AS dob_show'), DB::raw('CONCAT(country_code, " ", mobile_number) AS complete_mobile_number'))->whereDeletedAt(null)->whereIn('id', $underTakeUsersIds)->where('id', '!=', $admin->id)->orderBy($column,$asc_desc);
            }


            $total = $data->get()->count();

            if(!empty($request->get("search")["value"])){
                $search = $request->get("search")["value"];
            }else{

                $search = $request->search_txt;
            }
            $filter = $total;


            if($search){
                $data  = $data->where(function($query) use($search){
                            $query->orWhere(DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('(CASE WHEN is_block = 0 THEN "Unblock" ELSE "Block" END)'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('DATE_FORMAT(dob, "%d-%M-%Y")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT(country_code, " ", mobile_number)'), 'Like', '%' . $search . '%');
                        });

                $filter = $data->get()->count();

            }

            $data = $data->offset($request->start);
            $data = $data->take($request->length);
            $data = $data->get();


            $start_from = $request->start;
            if($start_from == 0){
                $start_from  = 1;
            }
            if($start_from % 10 == 0){
                $start_from = $start_from + 1;
            }


            foreach ($data as $k => $row) {

                $btn ="";

                
                
                $btn .= '<a href="view/'.base64_encode($row->id).'"><button type="button" class="btn btn-warning same_wd_btn mr-2">View</button></a>';
                

                

                $block_show = "hidden";
                $unblock_show = "";
                if($row->is_block == "Unblock"){
                    $block_show = "";
                    $unblock_show = "hidden";
                }else{
                    $block_show = "hidden";
                    $unblock_show = "";
                }
                $btn .= '<a class="action-button blockUnblock" title="Block" data-id="'.$row->id.'" '.$block_show.' href="javascript:void(0);"><button type="button" class="btn btn-warning same_wd_btn border_btn mr-2">Block</button></a>';
                $btn .= '<a class="action-button blockUnblock" title="Unblock" data-id="'.$row->id.'" '.$unblock_show.' href="javascript:void(0<button type="button" class="btn btn-warning same_wd_btn border_btn mr-2">Unblock</button></a>';

                

               
                
                $btn .= '<button type="button" data-id="'.$row->id.'" ui="{{base64_encode($row->id)}}" class="btn btn-warning same_wd_btn delete">Delete</button>';
                    
                

                $row->action = $btn;

                $row->DT_RowIndex = $start_from++;



            }


            $return_data = [
                    "data" => $data,
                    "draw" => (int)$request->draw,
                    "recordsTotal" => $total,
                    "recordsFiltered" => $filter,
                    "input" => $request->all()
            ];
            return response()->json($return_data);
        }
        
    }

    public function addUser(Request $request) {
        if($request->isMethod('GET')) {
            $allUserIds = User::whereDeletedAt(null)->whereIsBlock(0)->pluck('custom_user_id');
            return view('admin.add-user', compact('allUserIds'));
        }

        if($request->isMethod('POST')) {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);

            $lastCustomUserIdInTable = User::orderBy('id','desc')->first();

            $getNumericVal = substr($lastCustomUserIdInTable->custom_user_id, 4);
            $getNumericVal = (int)$getNumericVal;
            $nextNumericVal = $getNumericVal + 1;
            $nextNumericVal = "TS00" . $nextNumericVal;
            $data['custom_user_id'] = $nextNumericVal;
            
            $checkExistsMobileNumber = User::whereDeletedAt(null)->whereMobileNumber($data['mobile_number'])->whereCountryCode($data['country_code'])->first();

            if($checkExistsMobileNumber){
                Session::flash('error',"Mobile Number already exists. please try with different number.");
                return redirect()->back();
            }

            $saveRecord = new User();
            $saveRecord->fill($data);
            $saveRecord->save();


            $findSponserId = User::whereCustomUserId($data['sponser_id'])->first();
            $findUplineId = User::whereCustomUserId($data['upline_id'])->first();

            $saveUnderTakeUser = new UnderTakeUser();
            $saveUnderTakeUser->sponser_id = $findSponserId->id;
            $saveUnderTakeUser->upline_id = $findUplineId->id;
            $saveUnderTakeUser->user_id = $saveRecord->id;
            $saveUnderTakeUser->save();

            Session::flash('success', "New User has been created successfully.");
            return redirect(route('admin.userManagement'));
            
        }
    }


    public function checkExistsMobileNumber(Request $request) {
        $data = $request->all();

        $checkExistsMobileNumber = User::whereDeletedAt(null)->whereMobileNumber($data['mobile_number'])->whereCountryCode($data['country_code'])->first();

        if($checkExistsMobileNumber) {
            return 1;
        }else{
            return 0;
        }
    }

    public function logout(Request $request){
        Session::flush();
        return redirect(route('admin.login'));
    }

    public function changePassword(Request $request){

    	if($request->isMethod('GET')){

    		return view('admin.change-password');
    	}

    	if($request->isMethod('POST')){

            $change_password = User::changePassword($request);

            if($change_password == "success"){
                return redirect(route('admin.login'));
            }else{
                return back();
            }
    	}
    }

    public function treeView(Request $request, $user_id) {
        $userID = base64_decode($user_id);
        $admin = auth()->guard('admin')->user();

        $getTreeRecords = $this->getUserTree($userID);

        $selfObject = User::find($userID);

        $blankArr = [];
        $countOfcompletedPeople = count($getTreeRecords);

        $isLevel="";

        if($countOfcompletedPeople >= 3){
            $isLevel = 1;
        }

        $arrayChange = ['user_id' => $selfObject->id, 'userDetail' => $selfObject, 'children' => $getTreeRecords, 'peopleCount' => $countOfcompletedPeople, "isLevel" => $isLevel];

        $blankArr[] = $arrayChange;

        //return $blankArr;
        $json = json_encode($blankArr, JSON_PRETTY_PRINT);
        $underTakeUsers = $json;
        
        return view('admin.tree-view', compact('admin','userID', 'underTakeUsers'));
    }

    public function getUserTree($userId) {
        $tree = [];

        // Recursive function to fetch child users
        $fetchChildren = function ($userId) use (&$fetchChildren) {
            $children = UnderTakeUser::where('upline_id', $userId)->with('user')->get();
            return $children->map(function ($child) use ($fetchChildren) {

                $countOfcompletedPeople = count($fetchChildren($child->user_id));

                $isLevel="";

                if($countOfcompletedPeople >= 3){
                    $isLevel = 1;
                }

                return [
                    'user_id' => $child->user_id,
                    'userDetail' => $child->user,
                    'children' => $fetchChildren($child->user_id),
                    'peopleCount' => $countOfcompletedPeople,
                    'isLevel' => $isLevel
                ];
            });
        };

        // Start with the given user
        $tree = $fetchChildren($userId);

        return $tree;
    }

    public function viewUserDetails(Request $request, $user_id) {
        $userID = base64_decode($user_id);
        $userDetails = User::whereId($userID)->with('sponserDetails', 'uplineDetails')->first();

        return view('admin.view-user', compact('userDetails'));

    }


    // public function userManagement(Request $request){

    //     $users = User::whereDeletedAt(null)->orderBy('id','desc')->get();
    // 	return view('admin.user-management',compact('users'));
    // }


    // public function addUser(Request $request){
    // 	if($request->isMethod('GET')){
    // 		return view('admin.add-user');
    // 	}

    // 	if($request->isMethod('POST')){

    //         $Validator = $this->is_validationRuleWeb(User::validateAddUserFromAdmin(), $request);

    //         if(!empty($Validator)){
    //             return $Validator;
    //         }

    //         $add_user = $this->adminManage->addUser($request);

    //         Session::flash('message','User added successfully.');
    //         return redirect(route('admin.userManagement'));
    // 	}
    // }


    // public function checkExistEmailUser(Request $request){
    //     $email = $request->email;
    //     $id = $request->id;


    //     if(!empty($id)){
    //         $user_found = User::whereEmail($email)->where('id','!=',$id)->first();
    //     }else{

    //         $user_found = User::whereEmail($email)->first();
    //     }

    //     if(!empty($user_found)){
    //         return 1;
    //     }else{
    //         return 0;
    //     }
    // }



    // public function editUser(Request $request){
    // 	if($request->isMethod('GET')){
    //         $user_id = base64_decode($request->user_id);
    //         $user_find = User::find($user_id);
    // 		return view('admin.edit-user',compact('user_find'));
    // 	}

    // 	if($request->isMethod('POST')){

    //         $user_id = base64_decode($request->user_id);
    //         $user_find = User::find($user_id);

    //         $Validator = $this->is_validationRuleWeb(User::validateEditUserFromAdmin($validation = "", $message = "",$user_id), $request);

    //         if(!empty($Validator)){
    //             return $Validator;
    //         }

    // 		$update_user = $this->adminManage->updateUser($request, $user_find);
    //         Session::flash('message','User details updated successfully.');
    //         return redirect(route('admin.userManagement'));
    // 	}
    // }

    // public function viewUser(Request $request){
    //     $user_id = base64_decode($request->user_id);

    //     $user_find = User::find($user_id);
    // 	return view('admin.view-user',compact('user_find'));
    // }

    // public function deleteUser(Request $request){
    //     $user_id = $request->user_id;

    //     $delete = User::whereId(base64_decode($user_id))->update(['deleted_at' => Carbon::now()]);

    //     Session::flash("message","User deleted successfully.");
    //     return redirect(route('admin.userManagement'));
    // }

}
