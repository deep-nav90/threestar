<?php

namespace App\Http\Controllers\Api\v1;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResponseController extends Controller
{
    public function is_require($data, $field)
	{

		$response = [
			'result'  => 'Failure1',
			'message' => $field." field is required",
		];

		if($data){
			return $data;
		}

		http_response_code(400);
		echo json_encode($response); exit;
    }
   
	public function responseOk($message, $data = null)
	{

		$response = [
			'result'  => 'Success',
			'message' => $message,
		];

		$data ? $response['data'] = $data : null;

		http_response_code(200);
		echo json_encode($response); exit;
	}
   
	public function responseWithError($message=null)
	{

	    http_response_code(400);
	   	$message = $message ? $message : "Something went wrong. Please try again later!";
	    echo json_encode(['result' => 'Failure', 'message' => $message]); exit;
	}

	public function responseWithErrorCode($message=null, $code)
	{

	    http_response_code($code);
	   	$message = $message ? $message : "Something went wrong. Please try again later!";
	    echo json_encode(['result' => 'Failure', 'message' => $message]); exit;
	}


	public function uploadImage($image, $destinationPath)
    {
        $imageName = date('mdYHis') . uniqid().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);

        return $imageName;
    }

    public function is_validationRule($data, $request){
    	//return $data['validation'];
    	$validator = Validator::make($request->all(),$data['validation'], $data['message']);

    	if($validator->fails()){
            return $this->responseWithError($validator->errors()->first());
        }
    }

    public function is_validationRuleArray($data, $request){
    	//return $data['validation'];
    	$validator = Validator::make($request,$data['validation'], $data['message']);

    	if($validator->fails()){
            return $this->responseWithError($validator->errors()->first());
        }
    }

    public function is_validationRuleWeb($data, $request){
    	//return $data['validation'];
    	$validator = Validator::make($request->all(),$data['validation'], $data['message']);

    	if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
    }

    public function is_validationRuleWebAjax($data, $request){
    	//return $data['validation'];
    	$validator = Validator::make($request->all(),$data['validation'], $data['message']);


    	$validator = $this->validate($request,$data['validation'], $data['message']);

        return response()->json($validator, 422);
       
    }


    public static function send_iphone_notification($deviceToken,$message,$notifykey='',$id,$type='', $input_message,$profile_pic,$video_url = "", $thumbnail_video = "", $type_of_file = "") {

        $user = User::whereId($id)->select('name')->first();
        $user_name = $user->name;
        $PATH = public_path()."/pemfile/Brian.pem";
        $deviceToken = $deviceToken;  
        $passphrase = "";
        $ctx = stream_context_create();
             stream_context_set_option($ctx, 'ssl', 'local_cert', $PATH);
             stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        
        // $fp = stream_socket_client(
        //             'ssl://gateway.sandbox.push.apple.com:2195', $err,
        // $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); 
           
        $fp = stream_socket_client(
                     'ssl://gateway.push.apple.com:2195', $err,
         $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); 
          
        $body['message'] = $message;
        $body['id'] = $id;
        $body['Notifykey'] = $notifykey;
        $body['type'] = $type;
        $body['input_message'] = $input_message;
        $body['profile_pic'] = $profile_pic;
        $body['user_name'] = $user_name;
        $body['video_url'] = $video_url;
        $body['thumbnail_video'] = $thumbnail_video;
        $body['type_of_file'] = $type_of_file;
                if (!$fp)
                     exit("Failed to connect: $err $errstr" . PHP_EOL);

            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default',
                'ios_badgeCount' => 1,
                'details'=>$body
            );
               
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));

        fclose($fp);
        return $result;
        die;
    }


    public static function send_android_notification($deviceToken,$message,$notifykey='',$id,$type='', $input_message,$profile_pic,$video_url = "", $thumbnail_video = "", $type_of_file = "") {

        
        $user = User::whereId($id)->select('name')->first();
        $user_name = $user->name;

        if (!defined('API_ACCESS_KEY')){
                define('API_ACCESS_KEY','AAAAnvpP0YA:APA91bElNEwupCevxE5pibdSAXYXvmVJBTBhu99NeEN5EZ9V_5FTBzpT417uZZLlxy7LVPZMrBUe3CjmiL9ZRwRLswgry4EnkyJQRxDWjw-XGUAch--TjLrRN3qViQzi6MOKxjOCqsqS');
            }
        $registrationIds = array($deviceToken);
            /*echo "<pre>";
            print_r($msgsender_id);exit;
            $fields = array(
                'registration_ids' => $registrationIds,
                'alert' => $message,
                'sound' => 'default',
                'Notifykey' => $notmessage, 
                'data'=>$msgsender_id
            );*/
        
        $fields = array(
            'title'  => 'Baseball Bee',
            'registration_ids' => $registrationIds,
            'alert'     => $message,
            'sound'     => 'default',
            'Notifykey' => $notifykey, 
            'data'      =>   array("id" => $id,"type" => $type,"input_message" => $input_message, "profile_pic" => $profile_pic, "user_name" => $user_name, "video_url" => $video_url, "thumbnail_video" => $thumbnail_video, "type_of_file" => $type_of_file,"random_number" => mt_rand(0,9999)),
            "body"      =>  "sample body",
            "notification" => array('title' => "Baseball Bee",
                                     "body" =>  $message,
                                     "click_action" => "HOME_KEY"
                                    ),
                
        );
           /* return json_encode($fields);*/
        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );


        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
        $result = curl_exec($ch);

        if($result == FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
            
        curl_close( $ch );
        return  $result;
    }
}
