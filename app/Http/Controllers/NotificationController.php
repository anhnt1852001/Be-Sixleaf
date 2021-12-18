<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function index()
    {
        //vì chỉ gửi thông báo cho user có id là 1 lên chỉ có user id 1 mới nhìn thấY lên lấy id 1
        $user = User::find(1);
            return !empty($user->unreadNotifications)?$user->unreadNotifications:"" ;
    }

    // đánh dấu 1 thông báo đã đọc
     public function readed(Request $request){
        $user = User::find(1);
        $user->unreadNotifications->when($request->id,function($query) use ($request){
                return $query->where('id',$request->id);
        })->markAsRead();
     }
     // đánh dấu tất cả thông báo đã đọc
     public function readedall(){
        $user = User::find(1);
        $user->unreadNotifications->markAsRead();
     }
}
