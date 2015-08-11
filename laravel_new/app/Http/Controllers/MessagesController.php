<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Thujohn\Twitter\Facades\Twitter;
use Embed\Embed;
use Cloudder;

class MessagesController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => 'messageView']);
    }

    public function index() {
        $user = Auth::user();
        if ($user) {
           //Here for Embed
          $info = Embed::create('https://www.youtube.com/watch?v=AOIi9SjJvgU');
           $data['title'] = $info->title;
           $data['url'] = $info->url;
                $data['code'] = $info->code;
           return view('messages.send')->with('data',$data);
        }
        return redirect('/');
    }



    public function postSend(Request $request) {
        $user = Auth::user();
        if ($user) {
            // $message = $request->input('message');
            // if ($message == "") {
            //     return response()->json(['result' => false, 'message' => 'Message is required']);
            // }
            $emails = $request->input('emails');
            $invite_fb = $request->input('invite_fb');
            $invite_tw = $request->input('invite_tw');
            $layout = $request->input('layout');
          //  $type_block1 = $request->input('type_block1');
            $content_block1 = $request->input('content_block1');

            if($content_block1[0]){
              $content_block1 = $content_block1[0];
                $type_block1 = 0;
            }elseif($request->file('content_block1_file')){
              $content_block1 = $request->file('content_block1_file');
              Cloudder::upload($content_block1, null, null, null);
              $content_block1_temp = Cloudder::getResult();
              $content_block1 = $content_block1_temp['secure_url'];
                $type_block1 = 1;
            }elseif($content_block1[2]){
              $content_block1 = $content_block1[2];
                $type_block1 = 2;
            }elseif($content_block1[3]){
              $content_block1 = $content_block1[3];
                $type_block1 = 3;
            }

            // this works for updating the database    $layout = 1;
            $emailsList = explode(',', $emails);

            $data = [
                'user_id' => $user->id,
                // 'message' => $message,
                //'layout_type' => $layout,
                'type_block1' => $type_block1,
                'content_block1' => $content_block1,
                'status' => 1
            ];

            $messageObject = Message::create($data);

            $link = url('message/view', $messageObject->id);

            if (count($invite_tw) > 0) {
                $temp = " ";
                foreach ($invite_tw as $key => $value) {
                    $temp .= "@" . $value . " ";
                }
                $newMessage = $message . " " . $link . " " . $temp;
                Twitter::postTweet(['status' => $newMessage]);
            }

            if (count($emailsList) > 0) {
                foreach ($emailsList as $email) {
                    if ($email != "") {
                        Mail::send('emails.default', ['link' => $link], function ($m) use ($email) {
                            $m->to($email)->subject('You have new message!');
                        });
                    }
                }
            }
           return redirect($link);
            //return response()->json(['result' => true, 'data' => ['id' => $messageObject->id, 'link' => $link]]);
        }
    }

    public function messageView($id) {
        $message = Message::find($id);
        $user_id = $message->user_id;

        $user = User::find($user_id);
        $message_content1 = $message->content_block1;
        $message_type1 = $message->type_block1;

        //echo $message_content1;
        if($message_content1){
          if($message_type1 == 0){
            $data['type'] = "video";
        $info = Embed::create($message_content1);
         $data['title'] = $info->title;
         $data['url'] = $info->url;
              $data['code'] = $info->code;

            } else if($message_type1 == 1){
              $data['type'] = 'image';
              $data['content'] = $message->content_block1;

            }
}

        if ($message && $user) {
            return view('messages.view')->with('user', $user)->with('message',$message)->with('data',$data);
        } else {
            return redirect('/');
        }
    }

}
