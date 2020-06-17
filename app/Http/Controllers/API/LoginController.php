<?php

namespace App\Http\Controllers\API;

use App\Events\LoginLogReport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validationRule = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $validation = Validator::make($request->input(), $validationRule);


        if ($validation->fails()) {
            // dd($validation);
            return redirect()->back()->withErrors($validation);
        } else {
            if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $admin = Admin::where('email', $request->input('email'))->firstOrFail();
                $token =  Auth::guard('admin')->user()->createToken('admin-token')->accessToken;
                event(new LoginLogReport($admin, 'Success Login (API call)'));
                $data = [
                    'token'=> 'Bearer ' . $token
                ];
                return response()->json([
                    'message' => 'Login Success',
                    'data' => $data
                ], 200);
            } else {
                $admin = Admin::where('email', $request->input('email'))->first();
                if($admin){
                    event(new LoginLogReport($admin, 'Failed Login (API call)'));
                }
                return response()->json([
                    'status'=>false,
                    'message'=>'Un-Authenticated Login attempt',
                ],401);
            }
        }
    }
}
