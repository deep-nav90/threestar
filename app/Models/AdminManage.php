<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp;
use Hash;
use Mail;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\Support\Str;
use Session;
use App\User;
use App\Models\TrainingVideo;
use App\Models\Category;
use VideoThumbnail;
use App\Models\BuzzFeed;
use App\Models\BuzzFeedFile;
use App\Models\Challenge;

class AdminManage extends Model
{
    
    public static function uploadFile($file, $destinationPath){
        $fileName = date('mdYHis') . uniqid().'.'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    public static function responseWithErrorCode($message=null, $code)
    {

        http_response_code($code);
        $message = $message ? $message : "Something went wrong. Please try again later!";
        echo json_encode(['result' => 'Failure', 'message' => $message]); exit;
    }

    public function addUser($request){
    	$data = $request->all();

    	if($request->file('profile_picture')){

			$destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('IMG_STORAGE');
            $data['profile_picture'] = self::uploadFile($request->file('profile_picture'), $destinationPath);
		}

    	$data['password'] = Hash::make($data['password']);

    	$save_user = new User();
		$save_user->fill($data);
		$save_user->save();


		if(isset($save_user)){
            $http = new GuzzleHttp\Client;
            $url = url('oauth/token');

            $response = $http->post($url, [
                'form_params'   =>  [
                'grant_type'    =>  'password',
                'client_id'     =>  2,
                'client_secret' =>  'HexLGddsPpIHoklpv8AuklwXQrXG19o7TDXZ8UyR',
                'username'      =>  $save_user->email,
                'password'      =>  $request->password,
                'scope'         =>  '*'
                ]
            ]);
        }

        $return_data = json_decode($response->getBody(), true);

        $user_get = User::find($save_user->id);
        $user_get->refresh_token = $return_data['refresh_token'];
        $user_get->update();
        $user_get->access_token =  $return_data['access_token'];

        return "success";



    }

    public function updateUser($request, $user_find){
        $data = $request->all();

        if($request->file('profile_picture')){

            $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('IMG_STORAGE');
            $data['profile_picture'] = self::uploadFile($request->file('profile_picture'), $destinationPath);
        }elseif ($request->is_error_upload_img == 1) {
            $data['profile_picture'] = null;
        }
        
        $user_find->fill($data);
        $user_find->update();
        return "success";
    }


    //training management


    public function addTrainingVideo($request){

        $data = $request->all();

        if($request->file('video_url')){
            $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('VIDEO_STORAGE');
            $data['video_url'] = self::uploadFile($request->file('video_url'), $destinationPath);


            $video_url = storage_path(). '/' . env('VIDEO_STORAGE'). '/' . $data['video_url'];
            $storage_url = storage_path(). '/'. env('THUMBNAIL_VIDEO_STORAGE');
            $file_name = date('mdYHis') . uniqid().'.jpg';
            $second = 2;
            $width = 640;
            $height = 480;

            $thumbnail_create = VideoThumbnail::createThumbnail($video_url, $storage_url, $file_name, $second, $width, $height);

            $data['thumbnail_video'] = $file_name;
        }else{
            $data['video_url'] = null;
            $data['thumbnail_video'] = null;
        }

        $category_find = Category::find($data['category_id']);

        $training_video = new TrainingVideo();
        $training_video->category()->associate($category_find);
        $training_video->fill($data);
        $training_video->save();
        return "success";

    }


    public function editTrainingVideo($request, $training_video_find){

        $data = $request->all();

        if($request->file('video_url')){
            $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('VIDEO_STORAGE');
            $data['video_url'] = self::uploadFile($request->file('video_url'), $destinationPath);


            $video_url = storage_path(). '/' . env('VIDEO_STORAGE'). '/' . $data['video_url'];
            $storage_url = storage_path(). '/'. env('THUMBNAIL_VIDEO_STORAGE');
            $file_name = date('mdYHis') . uniqid().'.jpg';
            $second = 2;
            $width = 640;
            $height = 480;

            $thumbnail_create = VideoThumbnail::createThumbnail($video_url, $storage_url, $file_name, $second, $width, $height);
            
            $data['thumbnail_video'] = $file_name;
        }

        $category_find = Category::find($data['category_id']);

        $training_video_find->category()->associate($category_find);
        $training_video_find->fill($data);
        $training_video_find->update();
        return "success";
    }


    public function addBuzzFeed($request){

        $buzz_feed = new BuzzFeed();
        $buzz_feed->title = $request->title;
        $buzz_feed->description = $request->description;
        $buzz_feed->save();

        $acceptable_files = array_filter($request->acceptable);
        $non_acceptable_files = array_filter($request->non_acceptable);

        $explode_accepted_files = explode(',', $acceptable_files[0]);

        if(isset($non_acceptable_files[0]) && !empty($non_acceptable_files[0])){

            $explode_non_accepted_files = explode(',', $non_acceptable_files[0]);



            //#override and remove dupicate array
            $explode_accepted_files = array_diff($explode_accepted_files, $explode_non_accepted_files);

        }


        $files_uploded = $request->file("files");

        $files = [];

        foreach ($explode_accepted_files as $acceptable_file) {

            $exp_file = explode('_', $acceptable_file);

            $extension = $files_uploded[$exp_file[0]][$exp_file[1]]->getClientOriginalExtension();

            $file1_thumbname = "";
            if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "JPG" || $extension == "PNG" || $extension == "JPEG"){

                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('BUZZ_FEED_STORAGE');
                $file_name = self::uploadFile($files_uploded[$exp_file[0]][$exp_file[1]], $destinationPath);

                $files[] = ['file_url' => $file_name, 'thumbnail_url' => $file1_thumbname,'file_type' => "image"];
            }elseif ($extension == "mp4" || $extension == "MP4" || $extension == "mov" || $extension == "MOV") {
                

                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('BUZZ_FEED_STORAGE');
                $file_name = self::uploadFile($files_uploded[$exp_file[0]][$exp_file[1]], $destinationPath);

                $video_url = storage_path(). '/' . env('BUZZ_FEED_STORAGE'). '/' . $file_name;
                $storage_url = storage_path(). '/'. env('THUMBNAIL_VIDEO_STORAGE');
                $file1_thumbname = date('mdYHis') . uniqid().'.jpg';
                $second = 2;
                $width = 640;
                $height = 480;

                $thumbnail_create = VideoThumbnail::createThumbnail($video_url, $storage_url, $file1_thumbname, $second, $width, $height);


                $files[] = ['file_url' => $file_name, 'thumbnail_url' => $file1_thumbname,'file_type' => "video"];


            }elseif ($extension == "mp3" || $extension == "MP3") {
                
                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('BUZZ_FEED_STORAGE');
                $file_name = self::uploadFile($files_uploded[$exp_file[0]][$exp_file[1]], $destinationPath);

                $files[] = ['file_url' => $file_name, 'thumbnail_url' => $file1_thumbname,'file_type' => "audio"];


            }




        }

        foreach ($files as $file) {
            $file_buzz = new BuzzFeedFile();
            $file_buzz->buzzFeed()->associate($buzz_feed);
            $file_buzz->fill($file);
            $file_buzz->save();
        }

        return "success";

    }


    public function updateBuzzFeed($request, $buzz_feed_find){

        $buzz_feed_find->title = $request->title;
        $buzz_feed_find->description = $request->description;
        $buzz_feed_find->update();


        $acceptable_files = array_filter($request->acceptable);
        $non_acceptable_files = array_filter($request->non_acceptable);


        $deleted_files = $request->file_deleted;

        if(!empty($deleted_files)){
            $explode_del_files = explode(',',$deleted_files);

            //delete files

            BuzzFeedFile::whereIn('id',$explode_del_files)->delete();
            //
        }


        if(count($acceptable_files) > 0){

            $explode_accepted_files = explode(',', $acceptable_files[0]);
        }else{
            $explode_accepted_files = [];
        }

        if(isset($non_acceptable_files[0]) && !empty($non_acceptable_files[0])){

            $explode_non_accepted_files = explode(',', $non_acceptable_files[0]);



            //#override and remove dupicate array
            $explode_accepted_files = array_diff($explode_accepted_files, $explode_non_accepted_files);

        }


        $files_uploded = $request->file("files");

        $files = [];

        foreach ($explode_accepted_files as $acceptable_file) {

            $exp_file = explode('_', $acceptable_file);

            $extension = $files_uploded[$exp_file[0]][$exp_file[1]]->getClientOriginalExtension();

            $file1_thumbname = "";
            if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "JPG" || $extension == "PNG" || $extension == "JPEG"){

                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('BUZZ_FEED_STORAGE');
                $file_name = self::uploadFile($files_uploded[$exp_file[0]][$exp_file[1]], $destinationPath);

                $files[] = ['file_url' => $file_name, 'thumbnail_url' => $file1_thumbname,'file_type' => "image"];
            }elseif ($extension == "mp4" || $extension == "MP4" || $extension == "mov" || $extension == "MOV") {
                

                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('BUZZ_FEED_STORAGE');
                $file_name = self::uploadFile($files_uploded[$exp_file[0]][$exp_file[1]], $destinationPath);

                $video_url = storage_path(). '/' . env('BUZZ_FEED_STORAGE'). '/' . $file_name;
                $storage_url = storage_path(). '/'. env('THUMBNAIL_VIDEO_STORAGE');
                $file1_thumbname = date('mdYHis') . uniqid().'.jpg';
                $second = 2;
                $width = 640;
                $height = 480;

                $thumbnail_create = VideoThumbnail::createThumbnail($video_url, $storage_url, $file1_thumbname, $second, $width, $height);


                $files[] = ['file_url' => $file_name, 'thumbnail_url' => $file1_thumbname,'file_type' => "video"];


            }elseif ($extension == "mp3" || $extension == "MP3") {
                
                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('BUZZ_FEED_STORAGE');
                $file_name = self::uploadFile($files_uploded[$exp_file[0]][$exp_file[1]], $destinationPath);

                $files[] = ['file_url' => $file_name, 'thumbnail_url' => $file1_thumbname,'file_type' => "audio"];


            }




        }

        foreach ($files as $file) {
            $file_buzz = new BuzzFeedFile();
            $file_buzz->buzzFeed()->associate($buzz_feed_find);
            $file_buzz->fill($file);
            $file_buzz->save();
        }

        return "success";

    }

    public function addChallenge($request){

        $data = $request->all();
        if($request->file('image')){
            $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('CHALLENGE_IMG_STORAGE');
            $data['image'] = self::uploadFile($request->file('image'), $destinationPath);
        }

        $challenge = new Challenge();
        $challenge->fill($data);
        $challenge->save();

        return "success";
    }


    public function challengeUpdate($request, $challenge_find){
        $data = $request->all();
        if($request->file('image')){
            $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('CHALLENGE_IMG_STORAGE');
            $data['image'] = self::uploadFile($request->file('image'), $destinationPath);
        }

        $challenge_find->fill($data);
        $challenge_find->update();

        return "success";
    }
}
