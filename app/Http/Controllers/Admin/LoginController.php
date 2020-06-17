<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.auth.login');
    }

    public function loginProcess(Request $request)
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
                event(new LoginLogReport($admin, 'Success Login'));
                return redirect('/');
            } else {
                $admin = Admin::where('email', $request->input('email'))->first();
                if($admin){
                    event(new LoginLogReport($admin, 'Failed Login'));
                }
                return redirect()->back()->withErrors(['Login failed']);
            }
        }
    }

    public function logout()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        event(new LoginLogReport($admin, 'Logout'));
        Auth::guard('admin')->logout();
        return redirect(url('login'));
    }
}
