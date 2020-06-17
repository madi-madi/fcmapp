<?php

namespace App\Observers;

use App\Post;
use FCMAPP;
use DB;
class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $title ="Fcmapp";
        $body = "New Post : ".$post->title;
        $icon =null;
        $data = $post;
        $auth_id = auth()->id();
        $device_token = DB::table('users')->where('id','<>',$auth_id)->where('fcm_token','!=','')->pluck('fcm_token')->toArray();
        $ob = new FCMAPP;
         $result = $ob->sendTo($device_token,$title,$body,$icon,$data);
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
