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
use App\Models\Level;
use Illuminate\Support\Arr;
use App\Models\Wallet;
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
                Session::flash('message', 'User has been logged in  successfully.');
                return redirect(route('admin.dashboard'));
            }else{
                Session::flash('danger','Please enter valid User ID or Password.');
                return back();
            }
        }
    }

    public function dashboard(Request $request) {
        $admin = auth()->guard('admin')->user();
        if(!$admin) {
            return redirect(route('admin.login'));
        }

        $underTakeUsersIds = UnderTakeUser::whereDeletedAt(null)->whereSponserId($admin->id)->pluck('user_id');
        $underTakeUsersIds2 = UnderTakeUser::whereDeletedAt(null)->whereUplineId($admin->id)->pluck('user_id');
        $mergeIds = collect($underTakeUsersIds)->merge($underTakeUsersIds2);

        $totalUsers = User::whereDeletedAt(null)->whereIn('id', $mergeIds)->where('id', '!=', $admin->id)->count();

        if($admin->is_super_admin == 1) {
            $totalUsers = User::whereDeletedAt(null)->where('id', '!=', $admin->id)->count();
        }
        $totalAmountInt = UnderTakeUser::sum('amount');
        $totalAmount = $this->formatToIndianRupees($totalAmountInt);
        $totalCreditUserAmount = Wallet::sum('credit_user_amount');
        $adminWalletAmountInt = $totalAmountInt - $totalCreditUserAmount;
        $adminWalletAmount = $this->formatToIndianRupees($adminWalletAmountInt);
        $totalCreditAmtFormat = $this->formatToIndianRupees($totalCreditUserAmount);

        $myWalletCreditInt = Wallet::whereCreditUserId($admin->id)->sum('credit_user_amount');
        $myWalletCreditFormat = $this->formatToIndianRupees($myWalletCreditInt);

        $balanceAmount = $this->formatToIndianRupees($admin->balance_amount);


        $myWalletDebitInt = Wallet::whereCreditUserId($admin->id)->sum('debit_amount');
        $myWalletDebitFormat = $this->formatToIndianRupees($myWalletDebitInt);

        $myWalletTreeAmountInt = Wallet::whereCreditUserId($admin->id)->whereTypeOfCredit('By Tree')->sum('credit_user_amount');
        $myWalletTreeAmountFormat = $this->formatToIndianRupees($myWalletTreeAmountInt);


        $myWalletDirectAmountInt = Wallet::whereCreditUserId($admin->id)->whereTypeOfCredit('By Sponser')->sum('credit_user_amount');
        $myWalletDirectAmountFormat = $this->formatToIndianRupees($myWalletDirectAmountInt);

        return view('admin.index', compact('totalUsers', 'totalAmount', 'adminWalletAmount', 'totalCreditAmtFormat', 'myWalletCreditFormat', 'balanceAmount', 'myWalletDebitFormat', 'myWalletTreeAmountFormat', 'myWalletDirectAmountFormat'));
    }

    function formatToIndianRupees($amountInPaisa) {
        // Convert paisa to rupees
        return $amountInRupees = '(INR) ' . $amountInPaisa / 100;

        // Format to human-readable format
        if ($amountInRupees >= 10000000) {
            // Format for crores
            return number_format($amountInRupees / 10000000, 2) . ' Cr';
        } elseif ($amountInRupees >= 100000) {
            // Format for lakhs
            return number_format($amountInRupees / 100000, 2) . ' L';
        } elseif ($amountInRupees >= 1000) {
            // Format for thousands
            return number_format($amountInRupees / 1000, 2) . ' K';
        } else {
            // Return as is for less than 1000
            return number_format($amountInRupees, 2) . ' Rs';
        }
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
            }else if($order == 5) {
                $column = "created_at";
            }



            

            //all user in superadmin case to show
            $data = User::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('(CASE WHEN is_block = 0 THEN "Unblock" ELSE "Block" END) AS is_block'), DB::raw('DATE_FORMAT(dob, "%d-%M-%Y") AS dob_show'), DB::raw('CONCAT(country_code, " ", mobile_number) AS complete_mobile_number'))->whereDeletedAt(null)->where('id', '!=', $admin->id)->orderBy($column,$asc_desc);

            if($admin->is_super_admin == 0) {
                $underTakeUsersIds = UnderTakeUser::whereDeletedAt(null)->whereSponserId($admin->id)->pluck('user_id');
                $underTakeUsersIds2 = UnderTakeUser::whereDeletedAt(null)->whereUplineId($admin->id)->pluck('user_id');
                $mergeIds = collect($underTakeUsersIds)->merge($underTakeUsersIds2);
                $data = User::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('(CASE WHEN is_block = 0 THEN "Unblock" ELSE "Block" END) AS is_block'), DB::raw('DATE_FORMAT(dob, "%d-%M-%Y") AS dob_show'), DB::raw('CONCAT(country_code, " ", mobile_number) AS complete_mobile_number'))->whereDeletedAt(null)->whereIn('id', $mergeIds)->where('id', '!=', $admin->id)->orderBy($column,$asc_desc);
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
                            $query->orWhere('custom_user_id', 'Like', '%' . $search . '%');
                            $query->orWhere('name', 'Like', '%' . $search . '%');
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

                

               
                
                // $btn .= '<button type="button" data-id="'.$row->id.'" ui="{{base64_encode($row->id)}}" class="btn btn-warning same_wd_btn delete">Delete</button>';
                    
                

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

            //return $this->calculateLevelAndAmount("1,62,69,70,71", 1, 71, 2000,null);
            $admin = auth()->guard('admin')->user();
            if(!$admin){
                return redirect(route('admin.login'));
            }

            if($admin->is_super_admin == 0) {
                $underTakeUsersIds = UnderTakeUser::whereDeletedAt(null)->whereSponserId($admin->id)->pluck('user_id');
                $underTakeUsersIds2 = UnderTakeUser::whereDeletedAt(null)->whereUplineId($admin->id)->pluck('user_id');
                $mergeIds = collect($underTakeUsersIds)->merge($underTakeUsersIds2);

                $allUserIds = User::select('*', DB::raw('CONCAT(custom_user_id, " (", name, ")") AS show_custom_user_id'))->whereDeletedAt(null)->whereIsBlock(0)
                                ->where(function($query) use($mergeIds) {
                                    $query->whereIn('id', $mergeIds);

                                })->orWhere(function($query) use ($admin) {
                                    $query->whereId($admin->id);
                                })->pluck('show_custom_user_id');
            }else{
                $allUserIds = User::select('*', DB::raw('CONCAT(custom_user_id, " (", name, ")") AS show_custom_user_id'))->whereDeletedAt(null)->whereIsBlock(0)->pluck('show_custom_user_id');
            }

            
            $disabledUserIds = UnderTakeUser::select('upline_id', DB::raw('COUNT(*) as count'), DB::raw('(SELECT (CONCAT(custom_user_id, " (", name, ")")) FROM users WHERE users.id = under_take_users.upline_id) AS show_custom_user_id'))
            ->groupBy('upline_id')
            ->having('count', '>=', 3)
            ->pluck('show_custom_user_id')->toArray();

            $admin = auth()->guard('admin')->user();
            return view('admin.add-user', compact('allUserIds', 'admin', 'disabledUserIds'));
        }

        if($request->isMethod('POST')) {
            $data = $request->all();
            $splitSponser = explode(' ', $data['sponser_id']);
            $data['sponser_id'] = $splitSponser[0];

            $splitUpline = explode(' ', $data['upline_id']);
            $data['upline_id'] = $splitUpline[0];
            

            
            if(auth()->guard('admin')->user() == null || !auth()->guard('admin')->user() || auth()->guard('admin')->user() == ""){
                Session::flash('danger',"Session has been timeout. Please login first to add user.");
                return redirect()->back();
            }
            
            $data['password'] = Hash::make($data['password']);

            $lastCustomUserIdInTable = User::orderBy('id','desc')->first();

            $getNumericVal = substr($lastCustomUserIdInTable->custom_user_id, 4);
            $getNumericVal = (int)$getNumericVal;
            $nextNumericVal = $getNumericVal + 1;
            $nextNumericVal = "TS00" . $nextNumericVal;
            $data['custom_user_id'] = $nextNumericVal;
            $data['amount'] = 200000; //this is static for every user can take 2000
            
            $checkExistsMobileNumber = User::whereDeletedAt(null)->whereMobileNumber($data['mobile_number'])->whereCountryCode($data['country_code'])->first();

            if($checkExistsMobileNumber){
                Session::flash('danger',"Mobile Number already exists. please try with different number.");
                return redirect()->back();
            }

            $findSponserId = User::whereCustomUserId($data['sponser_id'])->first();
            $findUplineId = User::whereCustomUserId($data['upline_id'])->first();

            $countNumberOfTimesUnderUplineID = UnderTakeUser::whereDeletedAt(null)->whereUplineId($findUplineId->id)->count();
            if($countNumberOfTimesUnderUplineID >= 3) {
                
                Session::flash('danger',"You can not add more than three in selected Upline ID.");
                return redirect()->back();
            }


            $findLastUnderTakeUserUserID = UnderTakeUser::whereUserId($findUplineId->id)->orderBy('id', 'desc')->first();

            if($findLastUnderTakeUserUserID) {
                $data['sequece_wise_user_added_record_ids'] = $findLastUnderTakeUserUserID->sequece_wise_user_added_record_ids . "," . $findUplineId->id;
            }else{
                $data['sequece_wise_user_added_record_ids'] = $findUplineId->id;
            }

            $saveRecord = new User();
            $saveRecord->fill($data);
            $saveRecord->save();


            

            $saveUnderTakeUser = new UnderTakeUser();
            $saveUnderTakeUser->sponser_id = $findSponserId->id;
            $saveUnderTakeUser->upline_id = $findUplineId->id;
            $saveUnderTakeUser->user_id = $saveRecord->id;
            $saveUnderTakeUser->sequece_wise_user_added_record_ids = $data['sequece_wise_user_added_record_ids'];
            $saveUnderTakeUser->amount = $data['amount'];
            $saveUnderTakeUser->save();



            $this->calculateLevelAndAmount($data['sequece_wise_user_added_record_ids'], $findSponserId->id, $findUplineId->id, $data['amount'], $saveRecord);

            // $records = UnderTakeUser::where(function ($query) use($findUplineId) {
            //     $query->where('sequece_wise_user_added_record_ids', 'LIKE', '%,'.$findUplineId->id)
            //           ->whereRaw("sequece_wise_user_added_record_ids NOT LIKE '%,
            //           ".$findUplineId->id.",%'");
            // })->count();

            // if($records >= 3) {
            //     User::whereId($findUplineId->id)->update(['user_level' => 1]);
            // }

            // return "s";

            Session::flash('message', "New User has been created successfully.");
            return redirect(route('admin.userManagement'));
            
        }
    }

    function calculateLevelAndAmount($sequence_ids, $sponser_id, $upline_id, $amount, $saveRecord) {

        $staticSponserAmount = 20000;
        //for sponser fee
        $saveWallet2 = new Wallet();
        $saveWallet2->credit_user_id = $sponser_id;
        $saveWallet2->upline_id = $upline_id;
        $saveWallet2->user_id = $saveRecord->id;
        $saveWallet2->percentage = 0;
        $saveWallet2->total_amount = ((int)$amount); //this should be flat 200 
        $saveWallet2->credit_user_amount = $staticSponserAmount;
        $saveWallet2->type_of_credit = "By Sponser";
        $saveWallet2->save();
        //END OF SPONSER USER WALLET
        

        $splitSequenceUserIds = explode(',', $sequence_ids);

        $getUsers = User::whereIn('id', $splitSequenceUserIds)->get();
        $levelsTable = Level::get()->toArray();
        
        $k = count($getUsers);
        foreach($getUsers as $user) {
            $userLevel = $user->user_level;
            $checkLevel = $userLevel + 1;

            $levelRecordArray = Arr::first($levelsTable, function ($item) use ($checkLevel) {
                return $item['level'] === $checkLevel;
            });

            $levelRecord = null;
            if(isset($levelRecordArray)){
                $levelRecord = $levelRecordArray;
            }

            if($checkLevel == 1) {
                $case1 = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ?", ["(,|^)$user->id$"])->get();

                if(count($case1) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }
            }else if($checkLevel == 2) {
                $case2 = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", 1])->get();

                // $case2 = UnderTakeUser::selectRaw('upline_id, GROUP_CONCAT(id) as ids, GROUP_CONCAT(sponser_id) as sponser_ids')
                // ->whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ?", ["(,|^)$user->id,", 1])
                // ->groupBy('upline_id')
                // ->get();

                if(count($case2) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 3) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 4) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 5) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 6) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 7) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 8) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 9) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 10) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 11) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 12) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }else if($checkLevel == 13) {
                $subtractOneLevel = $checkLevel - 1;
                $checkCase = UnderTakeUser::whereRaw("sequece_wise_user_added_record_ids REGEXP ? AND LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) = ? ", ["(,|^)$user->id,", $subtractOneLevel])->get();

                if(count($checkCase) >= $levelRecord['number_of_users']) {
                    User::whereId($user->id)->update(['user_level' => $checkLevel]);
                }else {
                    $records = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$user->id])
                    ->orderByRaw("LENGTH(sequece_wise_user_added_record_ids) - LENGTH(REPLACE(sequece_wise_user_added_record_ids, ',', '')) DESC")
                    ->get();
                    
                    $groupedRecords = $records->filter(function ($item) use ($user) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        // Check if the logged-in ID appears after the first two IDs
                        return array_search($user->id, array_slice($ids, 0, 2)) !== false;
                    })->groupBy(function ($item) {
                        $ids = explode(',', $item['sequece_wise_user_added_record_ids']);
                        return implode(',', array_slice($ids, 0, 2)); // Group by first two IDs
                    });

                    $result = $groupedRecords->map(function ($group) {
                        return $group->sortByDesc(function ($item) {
                            return strlen($item['sequece_wise_user_added_record_ids']);
                        })->first();
                    })->take(3)->values();

                    $uniqueIds = $result->flatMap(function ($item) {
                        return explode(',', $item['sequece_wise_user_added_record_ids']);
                    })->unique()->toArray();

                    
                    $finalUniqueIds = array_values(array_filter($uniqueIds, function ($value) use ($user) {
                        return $value !== (string)$user->id;
                    }));
                    
                    // Get total count of unique IDs
                    $totalCount = count($finalUniqueIds);

                    if($totalCount >= $levelRecord['number_of_users']) {
                        User::whereId($user->id)->update(['user_level' => $checkLevel]);
                    }
                }
            }

            /* //old code
            $findUserAgain = User::whereId($user->id)->first();


            $levelRecordArray2 = Arr::first($levelsTable, function ($item) use ($findUserAgain) {
                return $item['level'] === $findUserAgain->user_level;
            });
    
            $levelRecord2 = null;
            if(isset($levelRecordArray2)){
                $levelRecord2 = $levelRecordArray2;
            }
            */

            $levelID = $k;
            if(count($levelsTable) <= $levelID){
                $levelID = count($levelsTable);
            }
            $levelRecordArray2 = Arr::first($levelsTable, function ($item) use ($levelID) {
                return $item['level'] === $levelID;
            });
    
            $levelRecord2 = null;
            if(isset($levelRecordArray2)){
                $levelRecord2 = $levelRecordArray2;
            }

            if($levelRecord2) {
                //if($findUserAgain->user_level != 0) {
                    $calculateAmount = (((int)$amount) / 100) * $levelRecord2['percentage'];
                    $saveWallet = new Wallet();
                    $saveWallet->credit_user_id = $user->id;
                    $saveWallet->upline_id = $upline_id;
                    $saveWallet->user_id = $saveRecord->id;
                    $saveWallet->percentage = $levelRecord2['percentage'];
                    $saveWallet->total_amount = ((int)$amount);
                    $saveWallet->credit_user_amount = $calculateAmount;
                    $saveWallet->type_of_credit = "By Tree";
                    //return $saveWallet;
                    $saveWallet->save();
    
                    
                //}
            }

            $addBalAmtCalculate = $calculateAmount;
            if($sponser_id == $user->id){
                $addBalAmtCalculate = $staticSponserAmount + $addBalAmtCalculate;
            }

            $addBalance = $user->balance_amount + $addBalAmtCalculate;
            User::whereId($user->id)->update(['balance_amount' => $addBalance]);
            $k--;
            
        }

        return "success";

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
        Session::flash('message', 'User has been logout successfully.');
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
        //return UnderTakeUser::all();
        $countOfcompletedPeople = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$userID])->count();

        // $isLevel="";

        // if($countOfcompletedPeople >= 3){
        //     $isLevel = 1;
        // }

        $arrayChange = ['user_id' => $selfObject->id, 'userDetail' => $selfObject, 'children' => $getTreeRecords, 'peopleCount' => $countOfcompletedPeople, "isLevel" => $selfObject->user_level];

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

                $countOfcompletedPeople = UnderTakeUser::whereRaw("FIND_IN_SET(?, sequece_wise_user_added_record_ids) > 0", [$child->user->id])->count();
                //$countOfcompletedPeople = count($fetchChildren($child->user_id));

                // $isLevel="";

                // if($countOfcompletedPeople >= 3){
                //     $isLevel = 1;
                // }

                return [
                    'user_id' => $child->user_id,
                    'userDetail' => $child->user,
                    'children' => $fetchChildren($child->user_id),
                    'peopleCount' => $countOfcompletedPeople,
                    'isLevel' => $child->user->user_level
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


    public function walletManagement(Request $request){
        if($request->isMethod('GET')) {
            $admin = auth()->guard('admin')->user();
            return view('admin.wallet-management', compact('admin'));
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
                $column = "upline_user_id_with_name";
            }elseif($order == 2){
                $column = "under_user_id_with_name";
            }elseif($order == 3){
                $column = "percentag_or_flat_amount";
            }elseif($order == 4){
                $column = "credit_user_amount_in_rupees";
            }elseif($order == 5){
                $column = "debit_amount_show";
            }else if($order == 6) {
                $column = "date_show";
            }
            

            //all user in superadmin case to show
            

            if($admin->is_super_admin == 0) {
                $data = Wallet::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.upline_id), " (", (SELECT name FROM users WHERE users.id = wallets.upline_id), ")") AS upline_user_id_with_name'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.user_id), " (", (SELECT name FROM users WHERE users.id = wallets.user_id), ")") AS under_user_id_with_name'), DB::raw('CASE WHEN wallets.type_of_credit = "By Tree" THEN CONCAT(wallets.percentage," %") ELSE CONCAT("(INR)", " ", ROUND(wallets.credit_user_amount / 100, 2)) END AS percentag_or_flat_amount'), DB::raw('CONCAT("(INR) ", ROUND(wallets.total_amount / 100, 2)) AS total_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.credit_user_amount / 100, 2)) AS credit_user_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.debit_amount / 100, 2)) AS debit_amount_show'))->whereDeletedAt(null)->where('credit_user_id', '=', $admin->id)->orderBy($column,$asc_desc);
            }else{
                $data = Wallet::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.upline_id), " (", (SELECT name FROM users WHERE users.id = wallets.upline_id), ")") AS upline_user_id_with_name'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.user_id), " (", (SELECT name FROM users WHERE users.id = wallets.user_id), ")") AS under_user_id_with_name'), DB::raw('CASE WHEN wallets.type_of_credit = "By Tree" THEN CONCAT(wallets.percentage," %") ELSE CONCAT("(INR)", " ", ROUND(wallets.credit_user_amount / 100, 2)) END AS percentag_or_flat_amount'), DB::raw('CONCAT("(INR) ", ROUND(wallets.total_amount / 100, 2)) AS total_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.credit_user_amount / 100, 2)) AS credit_user_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.debit_amount / 100, 2)) AS debit_amount_show'))->whereDeletedAt(null)->where('credit_user_id', '=', $admin->id)->orderBy($column,$asc_desc);
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
                            $query->orWhere(DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.upline_id), " (", (SELECT name FROM users WHERE users.id = wallets.upline_id), ")")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.user_id), " (", (SELECT name FROM users WHERE users.id = wallets.user_id), ")")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CASE WHEN wallets.type_of_credit = "By Tree" THEN CONCAT(wallets.percentage," %") ELSE CONCAT("(INR)", " ", wallets.credit_user_amount) END'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(wallets.total_amount / 100, 2))'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(wallets.credit_user_amount / 100, 2))'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(wallets.debit_amount / 100, 2))'), 'Like', '%' . $search . '%');
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

                if(!$row->upline_user_id_with_name) {
                    $row->upline_user_id_with_name = "-----";
                }

                if(!$row->under_user_id_with_name) {
                    $row->under_user_id_with_name = "-----";
                }
                
                
                $btn .= '<a href="wallet-view/'.base64_encode($row->id).'"><button type="button" class="btn btn-warning same_wd_btn mr-2">View</button></a>';                

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

    public function viewWalletDetails(Request $request, $wallet_id) {
        $walletID = base64_decode($wallet_id);
        $walletDetails = Wallet::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.upline_id), " (", (SELECT name FROM users WHERE users.id = wallets.upline_id), ")") AS upline_user_id_with_name'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.user_id), " (", (SELECT name FROM users WHERE users.id = wallets.user_id), ")") AS under_user_id_with_name'), DB::raw('CASE WHEN wallets.type_of_credit = "By Tree" THEN CONCAT(wallets.percentage," %") ELSE CONCAT("(INR)", " ", ROUND(wallets.credit_user_amount / 100, 2)) END AS percentag_or_flat_amount'), DB::raw('CONCAT("(INR) ", ROUND(wallets.total_amount / 100, 2)) AS total_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.credit_user_amount / 100, 2)) AS credit_user_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.debit_amount / 100, 2)) AS debit_amount_show'))->whereId($walletID)->first();

        return view('admin.view-wallet', compact('walletDetails'));
    }

    public function usersWalletManagement(Request $request) {
        if($request->isMethod('GET')) {
            $admin = auth()->guard('admin')->user();
            if($admin->is_super_admin == 0) {
                return redirect(route('admin.dashboard'));
            }
            return view('admin.users-wallet-management', compact('admin'));
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
                $column = "user_name_with_id";
            }
            // elseif($order == 2){
            //     $column = "tree_amount";
            // }elseif($order == 3){
            //     $column = "direct_amount";
            // }
            elseif($order == 2){
                $column = "total_amount_credit";
            }elseif($order == 3){
                $column = "total_debit_amount";
            }else if($order == 4) {
                $column = "show_balance_amount";
            }else if($order == 5) {
                $column = "updated_date_show";
            }
            

            //all user in superadmin case to show
            

            
            $data = User::select("*",DB::raw('DATE_FORMAT(updated_at, "%d-%M-%Y") AS date_show'), DB::raw('CONCAT(custom_user_id, " (", name, ")") AS user_name_with_id'), DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Tree") / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Tree") / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS tree_amount'), DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Sponser") / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Sponser") / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS direct_amount'), DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS total_amount_credit'), DB::raw('CONCAT("(INR) ", ROUND(users.balance_amount / 100, 2)) AS show_balance_amount'), DB::raw('CASE WHEN (ROUND((SELECT SUM(debit_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(debit_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS total_debit_amount'))->whereDeletedAt(null)->orderBy($column,$asc_desc);
            


            $total = $data->get()->count();

            if(!empty($request->get("search")["value"])){
                $search = $request->get("search")["value"];
            }else{

                $search = $request->search_txt;
            }
            $filter = $total;


            if($search){
                $data  = $data->where(function($query) use($search){
                            $query->orWhere(DB::raw('DATE_FORMAT(updated_at, "%d-%M-%Y")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT(custom_user_id, " (", name, ")")'), 'Like', '%' . $search . '%');

                            

                            // $query->orWhere(DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Tree") / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Tree") / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END'), 'Like', '%' . $search . '%');

                            // $query->orWhere(DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Sponser") / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Sponser") / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END'), 'Like', '%' . $search . '%');

                             $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(users.balance_amount / 100, 2))'), 'Like', '%' . $search . '%');

                            $query->orWhere(DB::raw('CASE WHEN (ROUND((SELECT SUM(debit_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(debit_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END'), 'Like', '%' . $search . '%');
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

                
                
                $btn .= '<a href="users-wallet-view/'.base64_encode($row->id).'"><button type="button" class="btn btn-warning same_wd_btn mr-2">View</button></a>';                

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

    public function usersViewWalletDetails(Request $request, $user_id) {
        if($request->isMethod('GET')) {
            $userID = base64_decode($user_id);
            $admin = auth()->guard('admin')->user();

            if($admin->is_super_admin == 0) {
                return redirect(route('admin.dashboard'));
            }
            
            $encodeID = $user_id;
            $userDetails = User::select("*",DB::raw('DATE_FORMAT(updated_at, "%d-%M-%Y") AS date_show'), DB::raw('CONCAT(custom_user_id, " (", name, ")") AS user_name_with_id'), DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Tree") / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Tree") / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS tree_amount'), DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Sponser") / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id AND type_of_credit = "By Sponser") / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS direct_amount'), DB::raw('CASE WHEN (ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(credit_user_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS total_amount_credit'), DB::raw('CONCAT("(INR) ", ROUND(users.balance_amount / 100, 2)) AS show_balance_amount'), DB::raw('CASE WHEN (ROUND((SELECT SUM(debit_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) > 0 THEN CONCAT("(INR)", " ", ROUND((SELECT SUM(debit_amount) FROM wallets WHERE wallets.credit_user_id = users.id) / 100, 2)) ELSE CONCAT("(INR)", " ", 0) END AS total_debit_amount'))->whereId($userID)->first();
            return view('admin.view-user-wallet-details', compact('admin', 'userID', 'encodeID', 'userDetails'));
        }

        if($request->isMethod('POST')) {
            $admin = auth()->guard('admin')->user();
            $userID = base64_decode($user_id);
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
                $column = "upline_user_id_with_name";
            }elseif($order == 2){
                $column = "under_user_id_with_name";
            }elseif($order == 3){
                $column = "percentag_or_flat_amount";
            }elseif($order == 4){
                $column = "credit_user_amount_in_rupees";
            }elseif($order == 5){
                $column = "debit_amount_show";
            }else if($order == 6) {
                $column = "date_show";
            }
            

            //all user in superadmin case to show
            

           
            $data = Wallet::select("*", DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS date_show'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.upline_id), " (", (SELECT name FROM users WHERE users.id = wallets.upline_id), ")") AS upline_user_id_with_name'), DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.user_id), " (", (SELECT name FROM users WHERE users.id = wallets.user_id), ")") AS under_user_id_with_name'), DB::raw('CASE WHEN wallets.type_of_credit = "By Tree" THEN CONCAT(wallets.percentage," %") ELSE CONCAT("(INR)", " ", ROUND(wallets.credit_user_amount / 100, 2)) END AS percentag_or_flat_amount'), DB::raw('CONCAT("(INR) ", ROUND(wallets.total_amount / 100, 2)) AS total_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.credit_user_amount / 100, 2)) AS credit_user_amount_in_rupees'), DB::raw('CONCAT("(INR) ", ROUND(wallets.debit_amount / 100, 2)) AS debit_amount_show'))->whereDeletedAt(null)->where('credit_user_id', '=', $userID)->orderBy($column,$asc_desc);
            


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
                            $query->orWhere(DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.upline_id), " (", (SELECT name FROM users WHERE users.id = wallets.upline_id), ")")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT((SELECT custom_user_id FROM users WHERE users.id = wallets.user_id), " (", (SELECT name FROM users WHERE users.id = wallets.user_id), ")")'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CASE WHEN wallets.type_of_credit = "By Tree" THEN CONCAT(wallets.percentage," %") ELSE CONCAT("(INR)", " ", wallets.credit_user_amount) END'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(wallets.total_amount / 100, 2))'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(wallets.credit_user_amount / 100, 2))'), 'Like', '%' . $search . '%');
                            $query->orWhere(DB::raw('CONCAT("(INR) ", ROUND(wallets.debit_amount / 100, 2))'), 'Like', '%' . $search . '%');
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

                
                if(!$row->upline_user_id_with_name) {
                    $row->upline_user_id_with_name = "-----";
                }

                if(!$row->under_user_id_with_name) {
                    $row->under_user_id_with_name = "-----";
                }

                
               // $btn .= '<a href="wallet-view/'.base64_encode($row->id).'"><button type="button" class="btn btn-warning same_wd_btn mr-2">View</button></a>';                

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

    public function getUserBySponser(Request $request, $customUserID) {
      //  return $customUserID;
        $findUser = User::whereCustomUserId($customUserID)->first();

        $underTakeUsersIds = UnderTakeUser::whereDeletedAt(null)->whereUplineId($findUser->id)->pluck('user_id');

        $allUserIds = User::select('*', DB::raw('CONCAT(custom_user_id, " (", name, ")") AS show_custom_user_id'))->whereDeletedAt(null)->whereIsBlock(0)
                        ->where(function($query) use($underTakeUsersIds) {
                            $query->whereIn('id', $underTakeUsersIds);

                        })->orWhere(function($query) use ($findUser) {
                            $query->whereId($findUser->id);
                        })->pluck('show_custom_user_id');
        return $allUserIds;

    }

    public function debitWalletAmount(Request $request){
        $data = $request->all();
        $admin = auth()->guard('admin')->user();
        if($admin->is_super_admin == 0) {
            return ['status' => 'failed', 'message' => 'Only Super Admin can be withdraw amount.'];
        }
        $decodeID = base64_decode($data['encodeID']);
        $debitAmount = $data['amount'] * 100;

        $findUser = User::whereId($decodeID)->first();
        
        if($findUser->balance_amount < $debitAmount) {
            return ['status' => 'failed', 'message' => 'Amount should be less than or equal to from balance amount.'];
        }
        
        $findUser->balance_amount = $findUser->balance_amount - $debitAmount;
        $findUser->update();


        $walletHistory = new Wallet();
        $walletHistory->credit_user_id = $decodeID;
        $walletHistory->type_of_credit = "By Debit";
        $walletHistory->debit_amount = $debitAmount;
        $walletHistory->total_amount = 0;
        $walletHistory->credit_user_amount = 0;
        $walletHistory->save();

        return ['status' => 'success', 'message' => 'Amount has been withdraw successfully.'];
    }

}
