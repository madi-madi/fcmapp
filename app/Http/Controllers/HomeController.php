<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function save_fcm_token(Request $request)
    {
        $errors=NULL;
        $message = "Success";
        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required',
        ],
            [
                'title.fcm_token' => 'fcm token required',

            ]
        );

        if ($validator->fails()) {
            $status = false;
            $errors = $validator->errors();
            $message = " Error !! ";

        }
        $user = auth()->user()->update([
            'fcm_token'=>$request->fcm_token
        ]);
        $status = $user?true:false;
        return response()->json(
            [
                'message'=>$message,
                'status'=>$status,
                'errors'=>$errors,
                'fcm_token'=>$request->fcm_token
            ]
        );
    }
}
